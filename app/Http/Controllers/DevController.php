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
        $input = array();

        $locationIds = [
            "32000228", // Taiwan
            "32000006", // International
            "32000056", // China
        ];

        foreach ($locationIds as $locationId) {
            $input['locationId'] = $locationId;
            $clans = $cocService->getClanRankings($input);
            foreach ($clans as $clan) {
                /** @var ClanRanking $clan */
                $foundClan = MonitoredClan::where('tag', $clan->tag)->first();
                if (!$foundClan) {
                    MonitoredClan::create($clan->getAttributes());
                }
            }
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
            $this->saveClanIfNotCreatedToday($clan);
            $createdClan = Clan::where([
                'tag' => $clan->tag
            ])->orderBy('created_at', 'DESC')->first();

            // create members
            foreach ($members as $member) {
                /** @var Member member */
                $member->clanId = $createdClan->id;
                $this->saveMemberIfNotCreatedToday($member);
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
        }
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
        ])->orderBy('created_at', 'DESC')->first();
        if ($foundClan == null) return false;

        $createTime = new Carbon($foundClan->created_at);
        if ($createTime->isSameDay(Carbon::now())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Save the member data to database if the data is not created today.
     *
     * @param $member
     */
    public function saveMemberIfNotCreatedToday(Member $member)
    {
        if (!$this->isMemberCreatedToday($member)) {
            Member::create($member->getAttributes());
        }
    }

    /**
     * Check if the record is already saved.
     * We only save a record per day.
     *
     * @param Member $member
     *
     * @return bool
     * @internal param of $array clan info $item
     *
     */
    private function isMemberCreatedToday(Member $member)
    {
        $foundMember = Member::where([
            'tag' => $member->tag
        ])->orderBy('created_at', 'DESC')->first();

        if ($foundMember == null) return false;

        $createTime = new Carbon($foundMember->created_at);
        if ($createTime->isSameDay(Carbon::now())) {
            return true;
        } else {
            return false;
        }
    }
}
