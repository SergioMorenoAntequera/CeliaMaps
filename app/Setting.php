<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    
    public static function getMainPoint(){
        $mainPoint = (object) array();
        $mainPoint->lat = Setting::where("name", "=", "mainPointLat")->first()->value;
        $mainPoint->lng = Setting::where("name", "=", "mainPointLng")->first()->value;
        $mainPoint->zoom = Setting::where("name", "=", "mainPointZoom")->first()->value;
        return $mainPoint;
    }
}
