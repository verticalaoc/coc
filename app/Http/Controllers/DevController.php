<?php

namespace App\Http\Controllers;

use App\Clan;
use App\ClanRanking;
use App\Http\CocService;
use App\Jobs\SaveClanJob;
use App\Member;
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

        $locationIds = [
            "32000228", // Taiwan
            "32000056", // China
        ];
        // monitorTaiwanTopClans
        $input = array();
        foreach ($locationIds as $locationId) {
            $input['locationId'] = $locationId;
            $input['minClanLevel'] = "7";
            for ($members = 30; $members <= 50; $members++) {
                $input['minMembers'] = $members;
                $input['maxMembers'] = $members;
                $clans = $cocService->getCLans($input);
                $this->addClansToMonitoredDbTable($clans);
            }
        }

        $locationIds = [
            "32000228", // Taiwan
            "32000006", // International
            "32000056", // China
        ];
        // monitorTopClans
        $input = array();
        foreach ($locationIds as $locationId) {
            $input['locationId'] = $locationId;
            $clans = $cocService->getClanRankings($input);
            $this->addClansToMonitoredDbTable($clans);
        }
    }

    private function getDonationsFromMembers($members)
    {
        $sum = 0;
        foreach ($members as $member) {
            $sum += $member->donations;
        }
        return $sum;
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


    /**
     * Save the Clans info asynchronous.
     */
    public function saveClans()
    {
        //        $clan = MonitoredClan::find(1);
        //        $job = (new SaveClanJob($clan->tag))->onConnection('sqs')->onQueue('coc_save_clan_data');
        //        dispatch($job);

        $monitoredClans = MonitoredClan::all();
        foreach ($monitoredClans as $monitoredClan) {
            /** @var Clan $monitoredClan $job */
            $job = (new SaveClanJob($monitoredClan->tag))->onConnection('sqs')->onQueue('coc_save_clan_data');
            dispatch($job);
        }
    }
}
