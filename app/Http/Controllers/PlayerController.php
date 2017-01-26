<?php

namespace App\Http\Controllers;

use App\Clan;
use App\Http\CocService;
use App\Member;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PlayerController extends Controller
{
    public function player($playerTag)
    {
        // get the info of the player from COC API
        $cocService = new CocService();
        $player = $cocService->getPlayerByTag($playerTag);
        $encodedClanTag = urlencode($player->clanTag);
        // get the history records of the player
        $playerHistory = Member::where('tag', $playerTag)->get();
        if (!$playerHistory->isEmpty()) {
            $playerHistory = $this->appendDonationRatio($playerHistory);
        }
        return view('clan.player', compact('player', 'encodedClanTag', 'playerHistory'));
    }

    function getRatio($donations, $donationsReceived)
    {
        if ($donationsReceived == 0) return $donations;
        return round($donations / $donationsReceived, 2);
    }

    private function appendDonationRatio($memberList)
    {
        $memberListWithDonationRatio = new Collection;
        foreach($memberList as $member) {
            /** @var \App\Member $member */
            $member->donationRatio = $this->getRatio($member->donations, $member->donationsReceived);
            $memberListWithDonationRatio->push($member);
        }
        return $memberListWithDonationRatio;
    }


}
