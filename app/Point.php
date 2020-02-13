<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{

    public function streets() {
        return $this->belongsToMany('App\Street', 'points_streets');
    }

    public function hotspots() {
        return $this->belongsToMany('App\Hotspot');
    }


    //The attributes that are mass assignable.
    protected $fillable = [
        'x', 'y',
    ];
}
