<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compute extends Model
{
		protected $fillable = [
        'status', 
    ];
        public function members(){
    	return $this->belongsTo('App\Members', 'member_id');
    }
            public function membership(){
    	return $this->belongsTo('App\Membership', 'id');
    }


        public function enrolledprogram(){
        return $this->hasMany('App\EnrolledProgram', 'compute_id');
    }
        public function enrolledacpagps(){
        return $this->hasMany('App\EnrolledAcpagps', 'compute_id');
    }
}
