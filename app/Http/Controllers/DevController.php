<?php

namespace App\Http\Controllers;
use App\Http\CocService;

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
        $input['locationId'] = "32000228"; // Taiwan
        $clans = $cocService->getClanRankings($input);


    }
}
