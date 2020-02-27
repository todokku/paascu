<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GsMembership extends Model
{
	// protected $table = 'gs_memberships';
    protected $fillable = [
        'te', 'atf', 'gtr', 'member_id',
    ];

        public function members(){
    	return $this->belongsTo('App\Members', 'member_id');
    }
}
