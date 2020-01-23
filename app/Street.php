<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{

    public function maps() {
        return $this->belongsToMany('App\Map', 'maps_streets')->withPivot('alternative_name');
    }

    public function points() {
        return $this->belongsToMany('App\Point', 'points_streets');
    }

    public function type()
    {
        return $this->belongsTo('App\StreetType');
    }

    //The attributes that are mass assignable.
    protected $fillable = [
        'type_id', 'name', 
    ];
}
