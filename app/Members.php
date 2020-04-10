<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    public function programs(){
    	return $this->hasMany('App\Programs', 'member_id');
    }
//testing ------------------------------------------------------
    public function membership(){
        return $this->hasMany('App\Membership', 'member_id');
    }
//testing ------------------------------------------------------
    public function formula(){
        return $this->hasMany('App\Formula', 'member_id');
    }
    public function compute(){
        return $this->hasMany('App\Compute', 'member_id');
    }

        public function gsmembership(){
        return $this->hasMany('App\GsMembership', 'member_id');
    }
        public function hsmembership(){
        return $this->hasMany('App\HsMembership', 'member_id');
    }
        public function bedmembership(){
        return $this->hasMany('App\BedMembership', 'member_id');
    }
        public function colmembership(){
        return $this->hasMany('App\ColMembership', 'member_id');
    }
        public function gedmembership(){
        return $this->hasMany('App\GedMembership', 'member_id');
    }
}
