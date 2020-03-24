<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $fillable = ['id', 'name', 'type', 'radius'];
    //
    public function points() {
        return $this->belongsToMany('App\Point');
    }
}
