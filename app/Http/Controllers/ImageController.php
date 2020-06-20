<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
    // public function destroy($id){
    //     $hotspot = Hotspot::find($id);
    //     $hotspot->delete();
    //     return redirect()->route('hotspot.index');

    //     $image = Image::find($id);
    //     File::delete(public_path('img/hotspots/'.$image->file_name));
    //     $image->delete();
    //     return redirect()->route('hotspot.gallery');
    // }

    public function getImagesOfHotspot(Request $r){
        if($r->hotspot == "Todos"){
            return response()->json(Image::all());
        }
        $hpToShow = DB::table('hotspots')->where('title', '=', $r->hotspot)->first();
        $images = DB::table('images')->where('hotspot_id', '=', $hpToShow->id)->get();
        return response()->json($images);
    }

    public function updateAjax(Request $r){
        $imgToChange = Image::find($r->id);
        $imgToChange->title = $r->title;
        $imgToChange->description = $r->description;

        $hp = DB::table("hotspots")->where("title", "=", $r->hpTitle)->first();
        $imgToChange->hotspot_id = $hp->id;
        $imgToChange->update();
        return response()->json($imgToChange);
    }

    public function destroyAjax(Request $r) {
        $image = Image::find($r->id);
        Storage::delete(public_path() . $image->file_path . $image->file_name);
        $image->delete();
    }

    public function uploadImg(Request $r){

        $r->validate([
            'title' => 'required|unique:images',
            'description' => 'required',
            'img' => 'required|image',
        ]);

        $image = new Image();
        $image->title = $r->title;
        $image->description = $r->description;
        $image->hotspot_id = $r->hotspot_id;
        
        $newID = DB::table('images')->latest('id')->first()->id + 1;

        $file = $r->file('img');
        $file->move(public_path("/img/hotspots/"), $newID.$file->getClientOriginalName());
        $image->file_name = $newID.$file->getClientOriginalName();
        $image->file_path = "/img/hotspots";

        $image->save();
        return redirect(route("gallery.index"));        
    }

}
