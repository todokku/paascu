<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GsMembership extends Model
{
	// protected $table = 'gs_memberships';
    protected $fillable = [
        'id', 'member_id', 'title', 'content', 'position', 'gtr'
    ];

        public function members(){
    	return $this->belongsTo('App\Members', 'member_id');
    }

}
