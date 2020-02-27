<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramEducation extends Model
{	
protected $table = 'program_education_levels';
protected $fillable = ['ed_level'];

    public function program(){
    return $this->belongsTo('App\Programs', 'program_id');
	}
}
