<?php

namespace App\Http\Controllers;

use App\Clan;
use App\Jobs\SaveClanJob;

class DevController extends Controller
{
    public function collectIgnoreClans()
    {
        $clans = Clan::where('donations', '<=', 0)->get();
        dd($clans);
        // TODO:
        // add these clans into ignored clan table
        // and also not query with the ignore filter for saving clan info
    }

    /**
     * Send event to save the Clans info asynchronous.
     */
    public function saveClans()
    {
        $monitoredClanController = new MonitoredClanController();
        $monitoredClans = $monitoredClanController->getAllMonitoredClans();
        foreach ($monitoredClans as $monitoredClan) {
            /** @var Clan $monitoredClan $job */
            $job = (new SaveClanJob($monitoredClan->tag))->onConnection('sqs')->onQueue('coc_save_clan_data');
            dispatch($job);
        }
    }

    public function adTest() {
        return view('adTest');
    }
}
