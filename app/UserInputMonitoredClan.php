<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInputMonitoredClan extends Model
{
    protected $fillable = [
        'tag',
        'name'
    ];

    protected $table = "userInputMonitoredClans";
}
