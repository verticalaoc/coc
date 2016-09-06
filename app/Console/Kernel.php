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
                Log::info("[command:collect][start]");
                Log::info(Carbon::now());

            })
            ->after(function () {
                Log::info("[command:collect][end]");
                Log::info(Carbon::now());
            });


        $schedule->command('command:collectVip')->everyMinute()->withoutOverlapping()
            ->before(function () {
                Log::info("[command:collectVip][start]");
                Log::info(Carbon::now());

            })
            ->after(function () {
                Log::info("[command:collectVip][end]");
                Log::info(Carbon::now());
            });;
    }
}
