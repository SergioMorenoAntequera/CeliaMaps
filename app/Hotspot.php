<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    //The attributes that are mass assignable.
    protected $fillable = [
        'title', 'description', 'lat', 'lng',
    ];

    public function maps() {
        return $this->belongsToMany('App\Map', 'hotspots_maps');
    }
}
