<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    public function membership(){
        return $this->hasMany('App\Membership', 'variable_id');
    }

        public function gsmembership(){
        return $this->hasMany('App\GsMembership', 'variable_id');
    }
        public function hsmembership(){
        return $this->hasMany('App\HsMembership', 'variable_id');
    }
        public function bedmembership(){
        return $this->hasMany('App\BedMembership', 'variable_id');
    }
        public function colmembership(){
        return $this->hasMany('App\ColMembership', 'variable_id');
    }
        public function gedmembership(){
        return $this->hasMany('App\GedMembership', 'variable_id');
    }
}
