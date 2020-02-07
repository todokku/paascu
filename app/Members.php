<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    public function programs(){
    	return $this->hasMany('App\Programs', 'member_id');
    }
}
