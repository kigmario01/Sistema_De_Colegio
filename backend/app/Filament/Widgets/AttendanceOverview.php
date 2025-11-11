<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use Filament\Widgets\BarChartWidget;
use Illuminate\Support\Carbon;

class AttendanceOverview extends BarChartWidget
{
    protected static ?string $heading = 'Asistencia semanal';

    protected function getData(): array
    {
        $start = Carbon::now()->startOfWeek();

        $data = Attendance::query()
            ->selectRaw('DATE(date) as day, SUM(status = "presente") as presentes, SUM(status != "presente") as ausencias')
            ->whereDate('date', '>=', $start)
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        return [
            'labels' => $data->pluck('day')->map(fn ($day) => Carbon::parse($day)->format('d/m'))->toArray(),
            'datasets' => [
                [
                    'label' => 'Presentes',
                    'data' => $data->pluck('presentes')->toArray(),
                    'backgroundColor' => '#16a34a',
                ],
                [
                    'label' => 'Ausencias',
                    'data' => $data->pluck('ausencias')->toArray(),
                    'backgroundColor' => '#dc2626',
                ],
            ],
        ];
    }
}
