<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    public function membership(){
        return $this->hasMany('App\Membership', 'variable_id');
    }
}
