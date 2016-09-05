<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonitoredClan extends Model
{
    protected $fillable = [
        'tag',
        'name'
    ];

    protected $table = "monitoredClans";
}
