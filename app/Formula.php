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


    public function gsmembership(){
        return $this->hasMany('App\GsMembership', 'formula_id');
    }
    public function hsmembership(){
        return $this->hasMany('App\HsMembership', 'formula_id');
    }
    public function bedmembership(){
        return $this->hasMany('App\BedMembership', 'formula_id');
    }
    public function colmembership(){
        return $this->hasMany('App\ColMembership', 'formula_id');
    }
    public function gedmembership(){
        return $this->hasMany('App\GedMembership', 'formula_id');
    }
}
