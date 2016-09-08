<?php

namespace App\Console\Commands;

use App\Http\Controllers\DevController;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mockery\CountValidator\Exception;

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
        try {
            $this->comment("[$this->signature][start]");
            $this->comment(Carbon::now());
            $dev = new DevController();
            $dev->queryClanAndSaveForMonitoredClans();
            $this->comment("[$this->signature][end]");
            $this->comment(Carbon::now());
        } catch (Exception $e) {
            $this->error($e->getMessage())
        }
    }
}
