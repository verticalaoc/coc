<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clan extends Model
{
    protected $fillable = [
        'name',
        'tag',
        'type',
        'locationId',
        'locationName',
        'locationIsCountry',
        'locationCountryCode',
        'badgeUrlsLarge',
        'badgeUrlsMedium',
        'badgeUrlsSmall',
        'clanLevel',
        'clanPoints',
        'requiredTrophies',
        'warFrequency',
        'warWinStreak',
        'warWins',
        'isWarLogPublic',
        'members',
        'donations',
        'description'
    ];
}
