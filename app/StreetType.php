<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StreetType extends Model
{
    public function streets() {
        return $this->hasMany('App\Street');
    }
}
