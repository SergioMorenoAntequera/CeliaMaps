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

    public static function getHomeOptions(){
        $homeInfo = (object) array();
        $homeInfo->homeDescription = Setting::where("name", "=", "homeSubtitle")->first()->value;
        $homeInfo->homeBackground = Setting::where("name", "=", "homeBackground")->first()->value;
        $homeInfo->homeColor = Setting::where("name", "=", "homeColor")->first()->value;
        return $homeInfo;
    }

    public static function getMetaData() {
        $metaData = (object) array();
        $metaData->pageTitle = Setting::where("name", "=", "pageTitle")->first()->value;
        $metaData->description = Setting::where("name", "=", "description")->first()->value;
        $metaData->keywords = Setting::where("name", "=", "keywords")->first()->value;
        return $metaData;
    }
}
