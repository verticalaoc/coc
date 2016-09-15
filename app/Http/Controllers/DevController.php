<?php

namespace App\Http\Controllers;

use App\Clan;
use App\ClanRanking;
use App\Http\CocService;
use App\Jobs\SaveClanJob;
use App\MonitoredClan;

class DevController extends Controller
{
    /**
     * Query Top Clans and insert the records into monitoredClan table
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function collectClansToMonitor()
    {
        $cocService = new CocService();

        // Query the clans by location & level
        $queryPlans = array();
        $queryPlans[] = ["32000228", 5]; // Taiwan, level 5+
        $queryPlans[] = ["32000056", 7]; // China, level 7+
        $input = array();
        foreach ($queryPlans as $queryPlan) {
            $locationId = $queryPlan[0];
            $level = $queryPlan[1];
            $input['locationId'] = $locationId;
            $input['minClanLevel'] = $level;
            for ($members = 30; $members <= 50; $members++) {
                $input['minMembers'] = $members;
                $input['maxMembers'] = $members;
                $clans = $cocService->getClans($input);
                $this->addClansToMonitoredDbTable($clans);
            }
        }

        // Get the top ranking clans by location
        $locationIds = [
            "32000228", // Taiwan
            "32000006", // International
            "32000056", // China
        ];
        $input = array();
        foreach ($locationIds as $locationId) {
            $input['locationId'] = $locationId;
            $clans = $cocService->getClanRankings($input);
            $this->addClansToMonitoredDbTable($clans);
        }
    }

    /**
     * Add the clans into monitorClans table.
     *
     * @param $clans
     *
     * @return array
     */
    public function addClansToMonitoredDbTable($clans)
    {
        foreach ($clans as $clan) {
            /** @var ClanRanking $clan */
            $foundClan = MonitoredClan::where('tag', $clan->tag)->first();
            if (!$foundClan) {
                MonitoredClan::create($clan->getAttributes());
            }
        }
    }


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
        $monitoredClans = MonitoredClan::all();
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
