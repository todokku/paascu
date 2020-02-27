<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberEducation extends Model
{
//table name
protected $table = 'member_education_levels';
protected $fillable = ['ed_level'];

    // public function members()
    // {
    //     return $this->belongsTo(Members::class);
    // }

    public function members(){
    return $this->belongsTo('App\Members', 'member_id');
	}

}
