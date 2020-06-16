<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Image;
use App\Map;
use App\Hotspot;

class ImageController extends Controller
{
    
    public function __construct()
    {
        
    }
    public function index() {
        $data["hotspots"] = Hotspot::all();
        // $data["maps"] = Map::all();
        $data["images"] = Image::all();
        return view("hotspot.gallerynew", $data);
    }

    /**
     * Method that shows the form to create a new register
     *
     * @return View
     */
    public function create(){
        return redirect()->route('hotspot.gallery');
    }

    /**
     * Method that recieves information in a Request object from the,
     * and then checks and include that information inside our database
     *
     * @param r
     * @return View
     */
    public function store(Request $r){
        $image = new Image($r->all());

        if ($r->hasFile('image')) {
            $r->file('image')->move('img/hotspots/', $r->getClientOriginalName());
            $image->file_name = $r->getClientOriginalName();
        }

        $image->save();

        return redirect()->route('hotspot.gallery');
    }

    /**
     * Method that shows the form to edit an already existing registry
     *
     * @return View
     */
    public function edit($id){

        return redirect()->route('hotspot.gallery');
    }

    /**
     * Method that recieves information in a Request object,
     * then checks and changes the information inside our database
     *
     * @param r
     * @return View
     */
    public function update(Request $r, $id){

        $image = Image::find($id);
        $image->fill($r->all());
        // Photos
        if($r->hasFile('image')){
            File::delete(public_path('img/hotspots/'.$image->file_name));
            $r->file('image')->move('img/hotspots', $r->file('image')->getClientOriginalName());
            $image->file_name = $r->file('image')->getClientOriginalName();
        }
        $image->save();
        return redirect()->route('hotspot.gallery');
    }

    /**
     * Method that deleets an specific registry inside out database
     * depending on a id that we will introduce by url
     *
     * @param id
     * @return View
     */
    public function destroy($id){
        $hotspot = Hotspot::find($id);
        $hotspot->delete();
        return redirect()->route('hotspot.index');

        $image = Image::find($id);
        File::delete(public_path('img/hotspots/'.$image->file_name));
        $image->delete();
        return redirect()->route('hotspot.gallery');
    }

}
