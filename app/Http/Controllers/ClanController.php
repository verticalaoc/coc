<?php

namespace App\Http\Controllers;

use App\Clan;
use App\Location;
use App\Member;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Carbon\Carbon;
use Illuminate\Validation\Validator;

class ClanController extends Controller
{
    const API_TOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6ImI5MWE2OWVmLWU5ZDgtNGY5Ni1iOTc2LWU2ZmM0NjEyY2VjNiIsImlhdCI6MTQ3MjE2OTU5OSwic3ViIjoiZGV2ZWxvcGVyLzMzYjI0NmNlLTg3MTMtNzllYi1iZTY0LWJlZjk3YWQwMzYwZiIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjIwMi44OS4xMjEuMTYiLCIxLjM0LjIxNS4xMSIsIjEuMzQuMjE1LjE1IiwiNTIuNzYuOTMuMTcyIl0sInR5cGUiOiJjbGllbnQifV19.dO67BRlJUXM4aWDd0RTD9ajRoIREOCocnftThTfMmOabEG57FrgHW2WPHdrS8G0IJ7rXZq771d57sUwnGiGX6g";

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.min' => '部落名稱長度不可小於 4',
        ];
    }

    public function clans(\Illuminate\Http\Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:4',
            ],
            [
                'name.min' => '部落名稱長度不可小於 4',
            ]
        );

        // remove the filter for locationId if it equals to 'any'
        $input = $request->all();
        if ($input['locationId'] == "any") {
            unset($input['locationId']);
        }

        // remove any input which is null or empty
        $input = array_filter($input,
            function (
                $value
            ) {
                return !empty($value);
            }
        );

        // query and get the list of clans
        $clans = $this->getClansByInput($input);
        $clanModels = array();
        foreach ($clans as $index => $data) {
            // query the detail info for each clan
            list($clan, $memberList) = $this->getClanByTag($data['tag']);

            // sum the donations
            $clan['donations'] = $this->sumMemberDonation($memberList);
            $clans[$index]['donations'] = $this->sumMemberDonation($memberList);

            // save clan data to clans table
            $this->saveClanDataIfNotCreatedToday($clan);

            // collect the latest data by tag from DB
            $clanModel = Clan::where([
                'tag' => $clan['tag']
            ])->orderBy('created_at', 'DESC')->first();
            $clanModels[] = $clanModel;

            // save memberList data to members table
            foreach ($memberList as $member) {
                $member['clanId'] = $clanModel->id;
                $this->saveMemberDataIfNotCreatedToday($member);
            }
        }

//        foreach ($clanModels as $clanModel) {
//            list($clan, $memberList) = $this->getClanByTag($clanModel->tag);
//            foreach ($memberList as $member) {
//                $member['clanId'] = $clanModel->id;
//                $this->saveMemberDataIfNotCreatedToday($member);
//            }
//        }

        //        $clanModels = array();
        //        foreach($clans as $clan){
        //            $clanModels[] = new Clan($clan);
        //        }

        $clans = $clanModels;
        return view('clan.clans', compact('clans', 'input'));
    }

    public function clan($clanTag)
    {
        $clans = Clan::where('tag', $clanTag)->orderBy('created_at', 'DESC')->get();
        return view('clan.clan', compact('clans'));
    }

    public function members($clanId)
    {
        $clan = Clan::find($clanId);
        $memberList = Member::where(['clanId' => $clanId])->get();
        return view('clan.members', compact('clan', 'memberList'));
    }

    public function query()
    {
        $data = $this->getLocations();
        $locations = array();
        foreach ($data['items'] as $item) {
            $locations[] = new Location($item);
        }
        return view('clan.query', compact('locations'));
    }

    public function warlogs($clanTag)
    {
        return $clanTag;
    }

    public function locations()
    {
        return $this->getLocations();
    }

    /**
     * Check if the record is already saved.
     * We only save a record per day.
     *
     * @param array of clan info $item
     *
     * @return bool
     */
    private function isClanCreatedToday($clan)
    {
        $foundClan = Clan::where([
            'tag' => $clan['tag']
        ])->orderBy('created_at', 'DESC')->first();
        if ($foundClan == null) return false;
        $createTime = new Carbon($foundClan->toArray()['created_at']);
        if ($createTime->isSameDay(Carbon::now())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if the record is already saved.
     * We only save a record per day.
     *
     * @param array of clan info $item
     *
     * @return bool
     */
    private function isMemberCreatedToday($member)
    {
        $foundMember = Member::where([
            'tag' => $member['tag']
        ])->orderBy('created_at', 'DESC')->first();

        if ($foundMember == null) return false;

        $createTime = new Carbon($foundMember->toArray()['created_at']);
        if ($createTime->isSameDay(Carbon::now())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * COC API - query the clans by name
     *
     * @param string $input the name of the clan
     *
     * @internal param $string
     * @return mixed
     */
    private function getClansByInput($input)
    {
        $headers = ['Accept' => 'application/json', 'authorization' => 'Bearer ' . self::API_TOKEN];
        $request = new Request('GET', 'https://api.clashofclans.com/v1/clans?' . http_build_query(
                array_filter($input,
                    function (
                        $value
                    ) {
                        return !empty($value);
                    })), $headers);
        $client = new Client([
            'base_uri' => 'https://api.clashofclans.com/v1/',
            'timeout' =>
                10.0,
        ]);

        $response = $client->send($request, ['timeout' => 10.0]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        $clans = $responseData['items'];

        $flattenClans = array();
        foreach ($clans as $clan) {
            $flattenClans[] = $this->flattenClan($clan);
        }
        return $flattenClans;
    }

    private function getClanByTag($clanTag)
    {
        $headers = ['Accept' => 'application/json', 'authorization' => 'Bearer ' . self::API_TOKEN];
        $request = new Request('GET', 'https://api.clashofclans.com/v1/clans/' . urlencode($clanTag), $headers);
        $client = new Client([
            'base_uri' => 'https://api.clashofclans.com/v1/',
            'timeout' => 10.0,
        ]);

        $response = $client->send($request, ['timeout' => 10.0]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        $clan = $responseData;
        $flattenedClan = $this->flattenClan($clan);
        return array($flattenedClan, $flattenedClan['memberList']);

    }

    private function getLocations()
    {
        $headers = ['Accept' => 'application/json', 'authorization' => 'Bearer ' . self::API_TOKEN];
        $request = new Request('GET', 'https://api.clashofclans.com/v1/locations', $headers);
        $client = new Client([
            'base_uri' => 'https://api.clashofclans.com/v1/',
            'timeout' => 10.0,
        ]);

        $response = $client->send($request, ['timeout' => 10.0]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        return $responseData;

    }

    private function flattenClan($clan)
    {
        $newClan = $clan;
        if (!empty($clan['location'])) {
            unset($newClan['location']);
            if (empty($clan['location']['id']) ||
                empty($clan['location']['name']) ||
                empty($clan['location']['isCountry']) ||
                empty($clan['location']['countryCode'])
            ) {
                //                dd($clan);
            }
            $newClan['locationId'] = $clan['location']['id'];
            $newClan['locationName'] = $clan['location']['name'];
            $newClan['locationIsCountry'] = $clan['location']['isCountry'];
            //            $newClan['locationCountryCode'] = $clan['location']['countryCode'];
        }

        if (!empty($clan['badgeUrls'])) {
            unset($newClan['badgeUrls']);
            $newClan['badgeUrlsLarge'] = $clan['badgeUrls']['large'];
            $newClan['badgeUrlsMedium'] = $clan['badgeUrls']['medium'];
            $newClan['badgeUrlsSmall'] = $clan['badgeUrls']['small'];
        }

        if (!empty($clan['memberList'])) {
            unset($newClan['memberList']);
            foreach ($clan['memberList'] as $member) {
                $flattenMember = $member;
                unset($flattenMember['league']);
                $flattenMember['leagueId'] = $member['league']['id'];
                $flattenMember['leagueName'] = $member['league']['name'];
                $flattenMember['leagueIconUrlsSmall'] = $member['league']['iconUrls']['small'];
                $flattenMember['leagueIconUrlsTiny'] = $member['league']['iconUrls']['tiny'];
                // medium icon is not here always. so skip it.
                // $flattenMember['leagueIconUrlsMedium'] = $member['league']['iconUrls']['medium'];
                $newClan['memberList'][] = $flattenMember;
            }
        }
        return $newClan;
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
     * Save the member data to database if the data is not created today.
     *
     * @param $data
     */
    public function saveMemberDataIfNotCreatedToday($data)
    {
        if (!$this->isMemberCreatedToday($data)) {
            Member::create($data);
        }
    }

    /**
     * Save the clan data to database if the data is not created today.
     *
     * @param $data
     */
    public function saveClanDataIfNotCreatedToday($data)
    {
        if (!$this->isClanCreatedToday($data)) {
            Clan::create($data);
        }
    }

    private function sumMemberDonation($memberList)
    {
        $sum = 0;
        foreach ($memberList as $member) {
            $sum += $member['donations'];
        }
        return $sum;
    }


}
