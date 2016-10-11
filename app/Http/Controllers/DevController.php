<?php

namespace App\Http\Controllers;

use App\Clan;
use App\Jobs\SaveClanJob;
use App\Member;
use Carbon\Carbon;

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

    public function deleteClans() {
        $now = Carbon::now();
        Clan::where('created_at', '<=', $now->addDay(-30))->delete();
    }

    public function deleteMembers() {
        $now = Carbon::now();
        Member::where('created_at', '<=', $now->addDay(-30))->delete();
    }
}
