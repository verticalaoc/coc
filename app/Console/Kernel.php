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
        Commands\DeleteClans::class,
        Commands\DeleteMembers::class,
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
        $schedule->command('dev:saveClans')->dailyAt('00:10');
        $schedule->command('queue:work sqs --daemon')->everyThirtyMinutes()->withoutOverlapping();
        $schedule->command('dev:deleteClans')->everyThirtyMinutes()->withoutOverlapping();
        $schedule->command('dev:deleteMembers')->everyThirtyMinutes()->withoutOverlapping();
    }
}
