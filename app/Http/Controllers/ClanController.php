<?php

namespace App\Http\Controllers;

use App\Clan;
use App\Http\CocService;
use App\Member;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ClanController extends Controller
{
    const API_TOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6ImI5MWE2OWVmLWU5ZDgtNGY5Ni1iOTc2LWU2ZmM0NjEyY2VjNiIsImlhdCI6MTQ3MjE2OTU5OSwic3ViIjoiZGV2ZWxvcGVyLzMzYjI0NmNlLTg3MTMtNzllYi1iZTY0LWJlZjk3YWQwMzYwZiIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjIwMi44OS4xMjEuMTYiLCIxLjM0LjIxNS4xMSIsIjEuMzQuMjE1LjE1IiwiNTIuNzYuOTMuMTcyIl0sInR5cGUiOiJjbGllbnQifV19.dO67BRlJUXM4aWDd0RTD9ajRoIREOCocnftThTfMmOabEG57FrgHW2WPHdrS8G0IJ7rXZq771d57sUwnGiGX6g";

    public function index()
    {
        return view('clan.index');
    }

    public function queryClans()
    {
        $cocService = new CocService();
        $locations = $cocService->getLocations();
        return view('clan.queryClans', compact('locations'));
    }

    public function clans(\Illuminate\Http\Request $request)
    {
        $this->validate($request,
            [
                'name' => 'min:4',
                'name' => 'required',
            ],
            [
                'name.min' => '部落名稱長度不可小於 4',
                'name.required' => '請輸入部落名稱',
            ]
        );

        $input = $request->all();
        $cocService = new CocService();
        $clans = $cocService->getClans($input);
        if (sizeof($clans) == 1) {
            return redirect()->action('ClanController@clan', ['clanTag' => urlencode($clans[0]->tag)]);
        } else {
            $clanExistsInDb = array();
            $newClans = array();
            foreach ($clans as $clan) {
                $found = Clan::where('tag', $clan->tag)->orderBy('id', 'desc')->first();
                if ($found) {
                    $clanExistsInDb[$clan->tag] = true;
                    $clan->description = $found->description;
                    $clan->donations = $found->donations;
                } else {
                    $clanExistsInDb[$clan->tag] = false;
                }
                $newClans[] = $clan;
            }
            $clans = $newClans;
            return view('clan.clans', compact('clans', 'input', 'clanExistsInDb'));
        }
    }

    public function clan($clanTag)
    {
        $cocService = new CocService();
        list($clan, $memberList) = $cocService->getClanByTag($clanTag);
        if (sizeof($memberList)) {
            $memberList = $this->appendDonationRatio($memberList);
        }
        $clanHistory = Clan::where('tag', $clanTag)->orderBy('id', 'DESC')->get();
        return view('clan.clan', compact('clan', 'memberList', 'clanHistory'));
    }

    public function query()
    {
        $cocService = new CocService();
        $locations = $cocService->getLocations();
        return view('clan.query', compact('locations'));
    }

    public function queryMember()
    {
        return view('clan.queryMember');
    }

    public function queryMemberWithTag(\Illuminate\Http\Request $request)
    {
        $this->validate($request,
            [
                'memberTag' => 'required',
            ],
            [
                'memberTag.required' => '請輸入部落成員標籤',
            ]
        );

        $input = $request->all();
        return redirect()->action('PlayerController@player', ['playerTag' => urlencode($input['memberTag'])]);
    }

    public function members($clanId)
    {
        $clan = Clan::find($clanId);
        $memberList = Member::where(['clanId' => $clanId])->get();
        if (!empty($memberList)) {
            $memberList = $this->appendDonationRatio($memberList);
        }
        return view('clan.members', compact('clan', 'memberList'));
    }

    public function member($memberTag)
    {
        $memberList = Member::where('tag', $memberTag)->get();
        //PHP Fatal error:  Call to a member function isEmpty() on array in /var/app/current/storage/framework/views/2f7d08a77c4c676dd5d26118beac73813b6f2601.php on line 2, referer: http://coc.mynanako.com/clans/278367/members
        if (!$memberList->isEmpty()) {
            $memberList = $this->appendDonationRatio($memberList);
        }
        $clanList = array();
        foreach ($memberList as $member) {
            if (array_key_exists($member->clanId, $clanList)) {
                continue;
            }
            // TODO: handle the clan id is not existing case.
            $clan = Clan::find($member->clanId);
            $clanList[$member->clanId] = $clan;
        }
        return view('clan.member', compact('memberList', 'clanList'));
    }


    /**
     * Get the clans from DB
     *
     */
    public function clansFromDb()
    {
        $clans = Clan::orderBy('clanPoints', 'DESC')->limit(10)->get();
        return view('clan.clans', compact('clans'));
    }

    public function warlogs($clanTag)
    {
        return $clanTag;
    }

    public function locations()
    {
        $cocService = new CocService();
        return $cocService->getLocations();
    }

    /**
     * Transform member data from array to Member models.
     *
     * @param $array
     *
     * @return array
     */
    public function memberArrayToModels($array)
    {
        $members = array();
        foreach ($array as $data) {
            $member = new Member($data);
            $members[] = $member;
        }
        return $members;
    }

    /**
     * Transform clan data from array to Clan models.
     *
     * @param $array
     *
     * @return array
     */
    public function clanArrayToModels($array)
    {
        $clans = array();
        foreach ($array as $data) {
            $clan = new Clan($data);
            $clans[] = $clan;
        }
        return $clans;
    }


    /**
     *  Show faq page
     */
    public function faq()
    {
        return view('clan.faq');
    }

    /**
     *  Show about page
     */
    public function about()
    {
        return view('clan.about');
    }

    function getRatio($donations, $donationsReceived)
    {
        if ($donationsReceived == 0) return $donations;
        return round($donations / $donationsReceived, 2);
    }

    private function appendDonationRatio($memberList)
    {
        $memberListWithDonationRatio = new Collection;
        foreach ($memberList as $member) {
            /** @var \App\Member $member */
            $member->donationRatio = $this->getRatio($member->donations, $member->donationsReceived);
            $memberListWithDonationRatio->push($member);
        }
        return $memberListWithDonationRatio;
    }

}
