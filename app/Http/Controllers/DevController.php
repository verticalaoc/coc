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
    public function monitorTopClans()
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
                $this->monitorClans($clans);
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
            $this->monitorClans($clans);
        }
    }

    /**
     * Query the clans information and save from monitoredClans.
     */
    public function saveVipClans()
    {
        $vipClansTag = array();
        $vipClansTag[] = "#Y2CP999Y"; // 絕地逆襲 3盟
        $vipClansTag[] = "#YV2P2VV8"; // 台灣Formosa

        $cocService = new CocService();
        foreach ($vipClansTag as $tag) {
            list($clan, $members) = $cocService->getClanByTag($tag);
            /** @var Clan $clan */

            // sum donations
            $donations = $this->getDonationsFromMembers($members);
            $clan->donations = $donations;
            Clan::create($clan->getAttributes());

            $createdClan = Clan::where(['tag' => $clan->tag])
                ->orderBy('id', 'DESC')->first();

            // create members
            foreach ($members as $member) {
                /** @var Member member */
                $member->clanId = $createdClan->id;
                Member::create($member->getAttributes());
            }
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
    public function monitorClans($clans)
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
