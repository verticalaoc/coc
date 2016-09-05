<?php

namespace App\Http\Controllers;
use App\Clan;
use App\Http\CocService;

class ClanRankingController extends Controller
{

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

    /**
     * Display the page for clan ranking query
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function queryClanRankings()
    {
        $cocService = new CocService();
        $locations = $cocService->getLocations();
        return view('clan.queryClanRankings', compact('locations'));
    }

    public function clanRankings(\Illuminate\Http\Request $request)
    {
        $this->validate($request,
            [
                'locationId' => 'required',
            ]
        );
        $input = $request->all();
        $cocService = new CocService();
        $clans = $cocService->getClanRankings($input);

        $clanExistsInDb = array();
        foreach ($clans as $clan) {
            $found = Clan::where('tag', $clan->tag)->orderBy('created_at', 'desc')->first();
            if ($found) {
                $clanExistsInDb[$clan->tag] = true;
            } else {
                $clanExistsInDb[$clan->tag] = false;
            }
        }

        return view('clan.ranking', compact('clans', 'clanExistsInDb'));
    }

    public function locations()
    {
        return $this->getLocations();
    }
}
