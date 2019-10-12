<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    public function amount()
    {
        return $this->belongsTo('App\Amount');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getDobAttribute($value)
    {
        return Carbon::parse($value)->format('Y/m/d');
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

}
