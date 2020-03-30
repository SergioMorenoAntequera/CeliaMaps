<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Setting;

class Point extends Model
{

    public function streets() {
        return $this->belongsToMany('App\Street', 'points_streets');
    }

    public function hotspots() {
        return $this->belongsToMany('App\Hotspot');
    }

    public function marker(){
        return $this->belongsToMany('App\Marker');
    }

    // Para tener el punto este en esta clase también
    public static function getMainPoint() {
        return Setting::getMainPoint();
    }

    //The attributes that are mass assignable.
    protected $fillable = [
        'lat', 'lng',
    ];
}
