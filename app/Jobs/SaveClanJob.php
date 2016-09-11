<?php

namespace App\Jobs;

use App\Clan;
use App\Http\CocService;
use App\Member;
use Carbon\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File;

class SaveClanJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $clanTag;

    /**
     * Create a new job instance.
     *
     * @param $clanTag
     *
     * @internal param Clan $clan
     */
    public function __construct($clanTag)
    {
        $this->clanTag = $clanTag;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        File::append(app_path() . '/listener.log',
            Carbon::now()->toDateTimeString() . "Handling clan: " . $this->clanTag . PHP_EOL);
        $cocService = new CocService();
        list($clan, $members) = $cocService->getClanByTag($this->clanTag);
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

    /**
     * Sum the donations of members up.
     *
     * @param $members Member object
     *
     * @return int
     */
    private function getDonationsFromMembers($members)
    {
        $sum = 0;
        foreach ($members as $member) {
            $sum += $member->donations;
        }
        return $sum;
    }

    /**
     * Check if the Clan is saved today.
     * If not, return false, otherwise return true.
     *
     * @param Clan $clan
     *
     * @return bool
     */
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
}
