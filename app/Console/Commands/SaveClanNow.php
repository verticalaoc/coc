<?php

namespace App\Console\Commands;

use App\Jobs\SaveClanJob;
use Illuminate\Console\Command;

class SaveClanNow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:saveClanNow
                            {clanId : The clan ID (e.g. #LYVC8G9U)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'save the clan by clan ID into DB now';

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
        // reuse the AWS SMS object
        $job = new SaveClanJob($this->argument('clanId'));
        $job->handle();
    }
}
