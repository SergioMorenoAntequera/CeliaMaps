<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Image;
use App\Map;
use App\Hotspot;

class ImageController extends Controller
{
    



    /**
     *  Method that shows the gallery, Hotspots Images
     * 
     *  @return View
     */
    public function gallery(){
        $image = Image::all();
        $hotspot = Hotspot::all();
        $map = Map::all();
        return view('hotspot.gallery', ['images'=>$image, 
                                        'hotspots'=>$hotspot,
                                        'maps'=>$map]);
    }
}
