<?php

namespace App\Http\Controllers;

use App\Clan;
use App\ClanRanking;
use App\Http\CocService;
use App\Member;
use App\MonitoredClan;
use Carbon\Carbon;

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
    public function queryClanAndSaveForMonitoredClans()
    {
        $cocService = new CocService();
        $monitoredClans = MonitoredClan::all();
        foreach ($monitoredClans as $monitoredClan) {
            list($clan, $members) = $cocService->getClanByTag($monitoredClan->tag);
            /** @var Clan $clan */

            // sum donations
            $donations = $this->getDonationsFromMembers($members);
            $clan->donations = $donations;

            // create clan and get clanId
            $isSaved = $this->saveClanIfNotCreatedToday($clan);

            if (!$isSaved) {
                $createdClan = Clan::where([
                    'tag' => $clan->tag
                ])->orderBy('id', 'DESC')->first();

                // create members
                foreach ($members as $member) {
                    /** @var Member member */
                    $member->clanId = $createdClan->id;
                    Member::create($member->getAttributes());
                }
            }
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

    private function saveClanIfNotCreatedToday(Clan $clan)
    {
        if (!$this->isClanCreatedToday($clan)) {
            Clan::create($clan->getAttributes());
            return false;
        }
        return true;
    }

    /**
     * Check if the record is already saved.
     * We only save a record per day.
     *
     * @param Clan $clan
     *
     * @return bool
     * @internal param of $array clan info $item
     *
     */
    private function isClanCreatedToday(Clan $clan)
    {
        $foundClan = Clan::where([
            'tag' => $clan->tag
        ])->orderBy('id', 'DESC')->first();
        if ($foundClan == null) return false;

        $createTime = new Carbon($foundClan->created_at);
        if ($createTime->isSameDay(Carbon::now())) {
            return true;
        } else {
            return false;
        }
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
}
