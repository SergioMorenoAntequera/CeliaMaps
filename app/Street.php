<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{

    public function maps() {
        return $this->belongsToMany('App\Map');
    }

    //The attributes that are mass assignable.
    protected $fillable = [
        'type', 'name', 'city',
    ];
}
