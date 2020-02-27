<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BedMembership extends Model
{
    protected $fillable = [
        'gste', 'hste', 'te', 'atf', 'gtr', 'member_id',
    ];

        public function members(){
    	return $this->belongsTo('App\Members', 'member_id');
    }
}
