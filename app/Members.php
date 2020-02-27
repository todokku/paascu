<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    public function programs(){
    	return $this->hasMany('App\Programs', 'member_id');
    }

 //    public function membereducation(){
 //    return $this->hasOne(MemberEducation::class);
	// }

	public function membereducation()
{
    return $this->hasOne('App\MemberEducation', 'member_id');
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
}
