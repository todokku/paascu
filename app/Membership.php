<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'id', 'member_id', 'formula_id', 'variable_id', 'content',
    ];
    public function variables(){
    	return $this->belongsTo('App\Variable', 'variable_id');
    }
    //why is this named fee??
    public function fee(){
    	return $this->belongsTo('App\Formula', 'formula_id');
    }
    public function members(){
    	return $this->belongsTo('App\Members', 'member_id');
    }
//testing ------------------------------------------------------
    public function gsmembership(){
        return $this->hasMany('App\GsMembership', 'content_id');
    }
    public function hsmembership(){
        return $this->hasMany('App\HsMembership', 'content_id');
    }
    public function bedmembership(){
        return $this->hasMany('App\BedMembership', 'content_id');
    }
    public function colmembership(){
        return $this->hasMany('App\ColMembership', 'content_id');
    }
    public function gedmembership(){
        return $this->hasMany('App\GedMembership', 'content_id');
    }
    public function compute(){
        return $this->hasOne('App\Compute', 'content_id');
    }
//testing ------------------------------------------------------
}
