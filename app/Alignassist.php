<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alignassist extends Model
{
    //
    public function points() {
        return $this->belongsToMany('App\Point');
    }
}
