<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{

    public function streets() {
        return $this->belongsToMany('App\Street', 'maps_streets','map_id', 'street_id');
    }

    public function images() {
        return $this->hasMany('App\Image');
    }

    //The attributes that are mass assignable.
    protected $fillable = [
        'title', 'description', 'city', 'date', 'image', 'level', 'width', 'height',
                'deviation_x', 'deviation_y',
    ];
}
