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
    public function index() {
        dd("indice de settings - jeje no sé");
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // SET THE MAIN VIEW OF THE GLOBAL MAP ////////////////////////////////////////////////////
    /**
     * Method that gets the info from the database
     * 
     * @param id
     * @return View
     */
    public function mainView() {
        $data['mainPoint'] = Setting::getMainPoint();
        return view('setting.setMainView', $data);
    }
    public function saveMainView(Request $r){
        $lat = Setting::where("name", "=", "mainPointLat")->first();
        $lat->value = $r->lat;
        $lat->update();

        $lng = Setting::where("name", "=", "mainPointLng")->first();
        $lng->value = $r->lng;
        $lng->update();

        $zoom = Setting::where("name", "=", "mainPointZoom")->first();
        $zoom->value = $r->zoom;
        $zoom->update();
    }
}
