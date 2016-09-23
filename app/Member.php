<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'clanId',
        'name',
        'tag',
        'role',
        'expLevel',
        'trophies',
        'clanRank',
        'previousClanRank',
        'donations',
        'donationsReceived',
        'donationRatio',
        'leagueId',
        'leagueName',
        'leagueIconUrlsSmall',
        'leagueIconUrlsTiny',
        'leagueIconUrlsMedium',
    ];
}
