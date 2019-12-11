<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    //The attributes that are mass assignable.
    protected $fillable = [
        'point_x', 'point_y', 'street_id',
    ];
}
