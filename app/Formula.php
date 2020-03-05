<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    public function members(){
    	return $this->belongsTo('App\Members', 'member_id');
    }
    public function membership(){
        return $this->hasMany('App\Membership', 'formula_id');
    }
}
