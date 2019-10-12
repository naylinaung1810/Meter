<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    public function key()
    {
        return $this->belongsTo('App\Key');
    }
}
