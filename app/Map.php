<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{

    public function streets() {
        return $this->belongsToMany('App\Street', 'maps_streets')->withPivot('alternative_name');
    }

    public function hotspots() {
        return $this->belongsToMany('App\Hotspot');
    }

    //The attributes that are mass assignable.
    protected $fillable = [
        'title', 'description', 'city', 'date', 'image', 'level', 'width', 'height',
                'deviation_x', 'deviation_y',
    ];
}
