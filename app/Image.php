<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function hotspot() {
        return $this->belongsTo('App\Hotspot');
    }

    public function map() {
        return $this->belongsTo('App\Map');
    }
}
