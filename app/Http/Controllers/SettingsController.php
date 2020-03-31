<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingsController extends Controller
{
    //


    ///////////////////////////////////////////////////////////////////////////////////////////
    // SET THE MAIN VIEW OF THE GLOBAL MAP ////////////////////////////////////////////////////
    /**
     * Method that gets the info from the database
     * 
     * @param id
     * @return View
     */
    public function setMainView() {
        $mainPoint = (object) array();
        $mainPoint->lat = Setting::where("name", "=", "mainPointLat")->first()->value;
        $mainPoint->lng = Setting::where("name", "=", "mainPointLat")->first()->value;
        $mainPoint->zoom = Setting::where("name", "=", "mainPointZoom")->first()->value;
        $data['mainPoint'] = $mainPoint;

        return view('setting.setMainView');
    }
}
