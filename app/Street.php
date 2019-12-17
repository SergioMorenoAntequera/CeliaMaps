<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{

    public function maps() {
        return $this->belongsToMany('App\Map');
    }

    public function type()
    {
        return $this->hasOne('App\StreetType');
    }

    //The attributes that are mass assignable.
    protected $fillable = [
        'type_id', 'name', 'city',
    ];
}
