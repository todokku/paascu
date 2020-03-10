<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compute extends Model
{
        public function members(){
    	return $this->belongsTo('App\Members', 'member_id');
    }
    //     public function membership(){
    // 	return $this->belongsTo('App\Membership', 'fee_id');
    // }
}
