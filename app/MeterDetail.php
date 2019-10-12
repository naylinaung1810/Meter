<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeterDetail extends Model
{
    public function meter()
    {
        return $this->belongsTo('App\Meter');
    }
}
