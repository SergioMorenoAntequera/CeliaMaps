<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    //The attributes that are mass assignable.
    protected $fillable = [
        'title', 'description', 'point_x', 'point_y', 'map_id',
    ];
}
