<?php

namespace App\Console;

use App\Console\Commands\SyncAcademicCalendar;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SyncAcademicCalendar::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('sync:academic-calendar')->dailyAt('02:00');
    }
}
