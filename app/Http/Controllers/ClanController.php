<?php

namespace App\Http\Controllers;

use App\Clan;
use App\Http\CocService;
use App\Member;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Carbon\Carbon;

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
            ],
            [
                'name.min' => '部落名稱長度不可小於 4',
            ]
        );

        $input = $request->all();
        $cocService = new CocService();
        $clans = $cocService->getClans($input);
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

    public function clan($clanTag)
    {
        $clans = Clan::where('tag', $clanTag)->orderBy('id', 'DESC')->get();
        return view('clan.clan', compact('clans'));
    }

    public function queryMember()
    {
        return view('clan.queryMember');
    }

    public function queryMemberWithTag(\Illuminate\Http\Request $request) {
        $input = $request->all();
        return $this->member($input['memberTag']);
    }

    public function members($clanId)
    {
        $clan = Clan::find($clanId);
        $memberList = Member::where(['clanId' => $clanId])->get();
        return view('clan.members', compact('clan', 'memberList'));
    }

    public function member($memberTag)
    {
        $memberList = Member::where('tag', $memberTag)->get();
        $clanList = array();
        foreach ($memberList as $member) {
            if (array_key_exists($member->clanId, $clanList)) {
                continue;
            }
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

    public function about()
    {
        return view('clan.about');
    }
}
