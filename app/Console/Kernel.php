<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        Commands\AddClanToMonitor::class,
        Commands\SaveClans::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // send event to sqs to save clan info
        $schedule->command('dev:saveclans')->dailyAt('00:10');

        // perform listener to consume the events
        $schedule->command('queue:work sqs --daemon')->everyThirtyMinutes()->withoutOverlapping();
    }
}
