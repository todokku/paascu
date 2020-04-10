<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GsMembership extends Model
{
	protected $fillable = [
        'id', 'member_id', 'formula_id', 'variable_id', 'content',
    ];
    public function variables(){
    	return $this->belongsTo('App\Variable', 'variable_id');
    }
    public function formula(){
    	return $this->belongsTo('App\Formula', 'formula_id');
    }
    public function members(){
    	return $this->belongsTo('App\Members', 'member_id');
    }
//testing ------------------------------------------------------
    public function membership(){
        return $this->belongsTo('App\Membership', 'content_id');
    }
//testing ------------------------------------------------------
}
