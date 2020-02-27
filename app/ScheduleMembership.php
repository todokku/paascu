<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleMembership extends Model
{
    protected $fillable = [
        'gtrs', 'gtre', 'amf', 'scu', 'status',
    ];

}
