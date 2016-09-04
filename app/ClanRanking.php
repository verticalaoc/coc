<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClanRanking extends Model
{
    protected $fillable = [
        'name',
        'tag',
        'locationId',
        'locationName',
        'locationIsCountry',
        'locationCountryCode',
        'badgeUrlsLarge',
        'badgeUrlsMedium',
        'badgeUrlsSmall',
        'clanLevel',
        'clanPoints',
        'members',
        'rank',
        'previousRank'
    ];
}
