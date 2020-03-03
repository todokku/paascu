<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipFormula extends Model
{
    protected $fillable = [
        'id', 'variable', 'position', 'ed_type',
    ];
}
