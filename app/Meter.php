<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meter extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function meterD()
    {
        return $this->hasMany('App\MeterDetail');
    }
}
