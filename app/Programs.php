<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    public function members(){
    	return $this->belongsTo('App\Members', 'member_id');
    }

 	public function programeducation()
{
    return $this->hasOne('App\ProgramEducation', 'program_id');
}
}
