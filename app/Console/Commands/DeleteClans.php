<?php

namespace App\Console\Commands;

use App\Http\Controllers\DevController;
use Illuminate\Console\Command;

class DeleteClans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:deleteClans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete the clans created 30 days ago';

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
        $dev->deleteClans();
    }
}
