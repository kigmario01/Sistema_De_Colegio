<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncAcademicCalendar extends Command
{
    protected $signature = 'sync:academic-calendar';

    protected $description = 'Recalcula los horarios y actualiza indicadores de disponibilidad';

    public function handle(): int
    {
        $conflicts = 0;
        Schedule::query()
            ->with('classroom')
            ->orderBy('classroom_id')
            ->chunk(100, function ($schedules) use (&$conflicts): void {
                foreach ($schedules as $schedule) {
                    $overlaps = Schedule::query()
                        ->where('id', '!=', $schedule->id)
                        ->where('classroom_id', $schedule->classroom_id)
                        ->where('day_of_week', $schedule->day_of_week)
                        ->whereBetween('starts_at', [$schedule->starts_at, $schedule->ends_at])
                        ->exists();

                    if ($overlaps) {
                        $conflicts++;
                        Log::warning('Conflicto de horario detectado', [
                            'schedule' => $schedule->id,
                            'classroom' => $schedule->classroom_id,
                        ]);
                    }
                }
            });

        $this->info("Sincronización completada. Conflictos detectados: {$conflicts}");

        return self::SUCCESS;
    }
}
