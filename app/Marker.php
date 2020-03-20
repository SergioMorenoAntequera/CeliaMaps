<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    //
    public function points() {
        return $this->belongsToMany('App\Point');
    }
}
