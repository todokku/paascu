<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrolledProgram extends Model
{
    public function compute(){
    	return $this->belongsTo('App\Compute', 'compute_id');
    }
}
