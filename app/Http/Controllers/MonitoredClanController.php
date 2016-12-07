<?php

namespace App\Http\Controllers;

use App\Clan;
use App\ClanRanking;
use App\Http\CocService;
use App\MonitoredClan;
use App\UserInputMonitoredClan;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;

class MonitoredClanController extends Controller
{
    private $messages = [
        '404' => '輸入的部落標籤不存在'
    ];

    public function monitoredClans()
    {
        $monitoredClans = $this->getAllMonitoredClans();
        return view('clan.monitoredClans', compact('monitoredClans'));
    }

    public function pageAddUserInputMonitoredClans()
    {
        return view('clan.addUserInputMonitoredClans');
    }

    public function userInputMonitoredClans()
    {
        $userInputMonitoredClans = UserInputMonitoredClan::all();
        return view('clan.userInputMonitoredClans', compact('userInputMonitoredClans'));
    }

    public function addUserInputMonitoredClans(\Illuminate\Http\Request $request)
    {
        $input = $request->all();
        $tag = $input['tag'];
        $cocService = new CocService();
        try {
            /** @var MonitoredClan $clan */
            list($clan, $members) = $cocService->getClanByTag($tag);
        } catch (RequestException $e) {
            return Redirect::back()->withErrors([$this->messages[$e->getResponse()->getStatusCode()]]);
        }

        $foundClan = false;
        try {
            $foundClan = UserInputMonitoredClan::where('tag', $tag)->first();
        } catch (QueryException $e) {
            // insert into

            dd($e->getMessage());
        }
        if($foundClan) {
            return Redirect::back()->withErrors(['此部落已正在追蹤中']);
        } else {
            UserInputMonitoredClan::create($clan->getAttributes());
            return Redirect::back()->with('message', '新增成功！');
        }
    }

    /**
     * Query Top Clans and insert the records into monitoredClan table
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function collectClansToMonitor()
    {
        $cocService = new CocService();

        // Query the clans by location & level
        $queryPlans = array();
        $queryPlans[] = ["32000228", 7]; // Taiwan, level 5+
        //$queryPlans[] = ["32000056", 7]; // China, level 7+
        $input = array();
        foreach ($queryPlans as $queryPlan) {
            $locationId = $queryPlan[0];
            $level = $queryPlan[1];
            $input['locationId'] = $locationId;
            $input['minClanLevel'] = $level;
            for ($members = 30; $members <= 50; $members++) {
                $input['minMembers'] = $members;
                $input['maxMembers'] = $members;
                $clans = $cocService->getClans($input);
                $this->addClansToMonitoredDbTable($clans);
            }
        }

        // Get the top ranking clans by location
        $locationIds = [
            "32000228", // Taiwan
            "32000006", // International
            "32000056", // China
        ];
        $input = array();
        foreach ($locationIds as $locationId) {
            $input['locationId'] = $locationId;
            $clans = $cocService->getClanRankings($input);
            $this->addClansToMonitoredDbTable($clans);
        }
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
     * Check if the clan existing in the array of clans.
     *
     * @param Array $monitoredClans         array of clans
     * @param Clan  $userInputMonitoredClan the target clan
     *
     * @return bool
     */
    private function isContained($monitoredClans, $userInputMonitoredClan)
    {
        foreach($monitoredClans as $monitoredClan) {
            if($monitoredClan->tag == $userInputMonitoredClan->tag) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get all monitored clans, including user input monitored clans.
     *
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllMonitoredClans()
    {
        $monitoredClans = MonitoredClan::all();
        $userInputMonitoredClans = UserInputMonitoredClan::all();

        foreach ($userInputMonitoredClans as $userInputMonitoredClan) {
            if ($this->isContained($monitoredClans, $userInputMonitoredClan)) {
                continue;
            } else {
                $monitoredClans[] = new MonitoredClan($userInputMonitoredClan->getAttributes());
            }
        }
        return $monitoredClans;
    }
}
