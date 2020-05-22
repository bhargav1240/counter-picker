<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    public function counters()
    {
        return $this->hasMany('App\Counter');
    }
}
