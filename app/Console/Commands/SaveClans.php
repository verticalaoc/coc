<?php

namespace App\Console\Commands;

use App\Http\Controllers\DevController;
use Illuminate\Console\Command;

class SaveClans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:saveClans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send SQS event to save clan';

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
        $dev->saveClans();
    }
}
