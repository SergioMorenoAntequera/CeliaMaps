<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');     
    }
    //
    ///////////////////////////////////////////////////////////////////////////////////////////
    // INDEX //////////////////////////////////////////////////////////////////////////////////
    /**
     * Method that gets the info from the database
     * 
     * @param id
     * @return View
     */
    public function index() {
        return view('setting.index');
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


    ///////////////////////////////////////////////////////////////////////////////////////////
    // OPTIONS TO CHANGE THE INFO AT HOME /////////////////////////////////////////////////////
    /**
     * Method that gets the info from the database
     * 
     * @param id
     * @return View
     */
    public function homeInfo() {
        $data['homeInfo'] = Setting::getHomeOptions();
        $data['metadata'] = Setting::getMetaData();
       
        // return view('setting.setMainView', $data);
        return view('setting.homeInfo', $data);
    }
    
    public function updateHomeInfo(Request $r) {
        // dd($r);
        $request = $r->data;
        $options = ["pageTitle", "description", "keywords", "homeSubtitle", "homeColor"];
        for ($i=0; $i < sizeof($options); $i++) { 
            $oneSetting = Setting::where("name", "=", $options[$i])->first();
            $oneSetting->value = $request[$i]['value'];
            $oneSetting->update();
        }


        // foreach ($request as $option) {
        //     if($option["name"] == "homeBackground"){
        //         if($option["name"]->hasFile('homeBackground')){
        //             $oneSetting = Setting::where("name", "=", "homeBackground")->first();
        //             $file = $option->file('miniature');
        //             dd($file);
        //             // $file->move(public_path("/img/miniatures/"), getClientOriginalName());
        //             // $map->miniature = getClientOriginalName();
        //         } else {
        //             return;
        //         }        
        //     } else {
        //         continue;
        //     }
        // }
    }
}
