<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BedMembership extends Model
{
    protected $fillable = [
        'gste', 'gsatf', 'hste', 'hsatf', 'gtr', 'member_id',
    ];

        public function members(){
    	return $this->belongsTo('App\Members', 'member_id');
    }
}
