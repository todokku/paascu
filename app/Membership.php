<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    public function variables(){
    	return $this->belongsTo('App\Variable', 'variable_id');
    }
    public function fee(){
    	return $this->belongsTo('App\Formula', 'formula_id');
    }
    public function members(){
    	return $this->belongsTo('App\Members', 'member_id');
    }
}
