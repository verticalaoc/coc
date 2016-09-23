<?php

namespace App\Console\Commands;

use App\Http\Controllers\DevController;
use App\Http\Controllers\MonitoredClanController;
use Illuminate\Console\Command;

class AddClanToMonitor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:collectClansToMonitor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add more clans to monitor';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $c = new MonitoredClanController();
        $c->collectClansToMonitor();
    }
}
