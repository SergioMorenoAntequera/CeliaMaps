<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Hotspot;
use Illuminate\Http\Request;
use App\Image;
use App\Map;
use App\Point;
use DB;

class HotspotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('getAllAjax');
    }

    /**
     * Method that shows all the registers in the database
     *
     * @return View
     */
    public function index(){
        $hotspot = Hotspot::all();
        //d($hotspot[0]->images[0]);
        return view('hotspot.index', ['hotspots'=>$hotspot]);
    }

    /**
     * Method that shows a specific register o our
     * database depending on it's ID
     *
     * @param id
     * @return View
     */
    public function show($id){
        $hotspot = Hotspot::find($id);
        return view('hotspot.show', ['hotspot'=>$hotspot]);
    }

    /**
     * Method that shows the form to create a new register
     *
     * @return View
     */
    public function create(){
        $hotspots = Hotspot::all();
        $map = Map::all();
        $image = Image::all();
        //dd($hotspots[0]->images[1]->file_name);
        return view('hotspot.test', ['hotspots'=>$hotspots, 
                    'maps'=>$map, 
                    'images'=>$image, 
                    'mainPoint'=>Map::getMainPoint()]);
    }

    public function admin() {
        $data['maps'] = Map::all();
        $data['hotspots'] = Hotspot::all();
        $data['images'] = Image::all();
        $data['mainPoint'] = Point::getMainPoint();

        
        foreach ($data['hotspots'] as $hotspot) {
            $hotspot->lat = $hotspot->lat; 
            $hotspot->lng = $hotspot->lng;
        }

        return view("hotspot.admin", $data);
    }

    /**
     * Method that recieves information in a Request object from the,
     * and then checks and include that information inside our database
     *
     * @param r
     * @return View
     */
    public function store(Request $r){
        $r->validate([
            'title' => 'required',
            'description' => 'required',
            'images' => 'required'
        ]);
        
        $hotspot = new Hotspot($r->all());
        $hotspot->save();

        if(count($r->images) > 0){
            foreach ($r->images as $requestImage) {
                $requestImage->move('img/hotspots/', $requestImage->getClientOriginalName());
                $image = new Image();
                $image->title = $r->titleImage;
                $image->description = $r->descriptionImage;
                $image->file_name = $requestImage->getClientOriginalName();
                $image->file_path = 'img/hotspots/';
                $image->hotspot_id = $hotspot->id;
                $image->save();
            }
        }

        return redirect()->route('hotspot.index');
    }

    public function storeAjax(Request $r){
        $r->validate([
            'title' => 'required',
            'description' => 'required',
            'images' => 'required'
        ]);

        $hotspot = new Hotspot($r->all());
        $hotspot->save();

        if(count($r->images) > 0){
            foreach ($r->images as $requestImage) {
                $requestImage->move('img/hotspots/', $requestImage->getClientOriginalName());
                $image = new Image();
                $image->title = $r->titleImage;
                $image->description = $r->descriptionImage;
                $image->file_name = $requestImage->getClientOriginalName();
                $image->file_path = 'img/hotspots/';
                $image->hotspot_id = $hotspot->id;
                $image->save();
            }
        }

        $hotspot->images;

        return response()->json([
            'hotspot' => $hotspot
        ]);
    }

    /**
     * Method that shows the form to edit an already existing registry
     *
     * @return View
     */
    public function edit($id){
        $hotspot = Hotspot::find($id);
        return view('hotspot.edit', array('hotspot' => $hotspot));
    }

    /**
     * Method that recieves information in a Request object,
     * then checks and changes the information inside our database
     *
     * @param r
     * @return View
     */
    public function update(Request $r, $id){
        $r->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $hotspot = Hotspot::find($id);
        $hotspot->fill($r->all());
        $hotspot->save();
        return redirect()->route('hotspot.index');
    }

    public function updateAjax(Request $r){
        $r->validate([
            'title' => 'required',
            'description' => 'required',
            'images' => 'required'
        ]);
        
        $hotspot = Hotspot::find($id);
        $hotspot->fill($r->all());
        $hotspot->save();
        
        // Tener en cuenta imágenes

        return response()->json([
            'hotspot' => $hotspot
        ]);
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
    }

    public function deleteAjax(Request $r, $id){

        Hotspot::destroy($r->id);

        // Tener en cuenta imágenes

        return response()->json([
            'delete' => true,
        ]);
    }

    public function getAllAjax(Request $r){
        $hotspotFound = Hotspot::find($r->id);
        $imagesFound = Array();

        foreach ($hotspotFound->images as $image) {
           array_push($imagesFound, $image->file_name);
        }

        $hotspotFound->images = $imagesFound;

        return response()->json([
            'hotspot' => $hotspotFound,
        ]);
    }

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

    public function searchAjax(Request $r){
        $imagesFound = Image::where('title', 'LIKE', '%'.$r->text.'%')->get();
        return response()->json([
            'imagesFound' => $imagesFound,
        ]);
    }

    // AJAX METHODS
    /* 
    public function storeAjax(Request $r){
        // Server side validation
        $r->validate([
            'title'=>'required',
            'description'=>'required',
            'titleImage'=>'required',
            'descriptionImage'=>'required'
        ]);

        $hotspot = new Hotspot($r->all());
        $hotspot->save();

        $mapsAsigned = Array();
        if(!is_null($r->maps_id) > 0){
            for ($i=0; $i < count($r->maps_id); $i++) { 
                $mapStreet = new MapStreet();
                $mapStreet->street_id = $street->id;
                $mapStreet->map_id = $r->maps_id[$i];
                $mapStreet->alternative_name = $r->maps_name[$i];
                $mapStreet->save();

                $mapAsigned = Map::find($mapStreet->map_id);
                $mapAsigned->pivot = $mapStreet;
                array_push($mapsAsigned, $mapAsigned);
            }
        }
        foreach ($mapsAsigned as $mapAsigned) {
            $pivot = DB::table('maps_streets')
                    ->where('map_id', $mapAsigned->id)
                    ->where('street_id', $street->id)
                    ->first();
            $mapAsigned->pivot = $pivot;
            // $pivot = MapStreet::where('map_id', $mapAsigned->id)->get();
        }
        
        $point = Point::Create(["lat" => $r->lat, "lng" => $r->lng]);
        $street->points()->attach($point->id);
        $street->lat = $r->lat;
        $street->lng = $r->lng;
        $street->type()->associate($r->type_id);
        $street->typeName = $street->type->name;
        $street->fullName = $street->typeName . " " . $street->name;
        return response()->json([
            'street' => $street,
            'points' => $point,
            'maps' => $mapsAsigned,
        ]);
    }
    */
}
