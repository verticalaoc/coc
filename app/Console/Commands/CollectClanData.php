<?php

namespace App\Console\Commands;

use App\Http\Controllers\DevController;
use Illuminate\Console\Command;

class CollectClanData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:collect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'collect clan and member data';

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
        $dev = new DevController();
        $dev->queryClanAndSaveForMonitoredClans();
    }
}
