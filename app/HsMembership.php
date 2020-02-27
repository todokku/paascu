<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HsMembership extends Model
{
    protected $fillable = [
        'te', 'atf', 'gtr', 'member_id',
    ];

        public function members(){
    	return $this->belongsTo('App\Members', 'member_id');
    }
}
