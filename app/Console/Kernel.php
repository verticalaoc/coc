<?php

namespace App\Console;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        Commands\CollectClanData::class,
        Commands\CollectVipClanData::class,
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
        $schedule->command('command:collect')->dailyAt('04:00')->withoutOverlapping()
            ->before(function () {
                echo "[command:collect][start]";
                echo Carbon::now()->toDateTimeString();

            })
            ->after(function () {
                echo "[command:collect][end]";
                echo Carbon::now()->toDateTimeString();
            })
            ->sendOutputTo("/tmp/laravel.schedule.log");
    }
}
