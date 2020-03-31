<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Map;
use App\Street;
use App\StreetType;
use App\Point;
use App\MapStreet;
use DB;

class StreetController extends Controller
{
    /**
     * Create a new controller instance.
     * Restricting the access to all it's views
     * but the index and the information about one
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth' );     
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // SHOW ALL SOMETHING  ////////////////////////////////////////////////////////////////////
    /**
     * Method that shows all the registers in the database
     * 
     * @return View
     */
    public function index(){
        $data['maps'] = Map::all();
        $data['streets'] = Street::all();
        
        return view("street.index", $data);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // SHOW ALL SOMETHING  ////////////////////////////////////////////////////////////////////
    /**
     * Method that shows all the registers in the database
     * 
     * @return View
     */
    public function admin(){
        $data['streetsTypes'] = StreetType::all();
        $data['maps'] = Map::all();
        $data['streets'] = Street::all();
        $data['mainPoint'] = Point::getMainPoint();
        foreach ($data['streets'] as $street) {
            $street->typeName = $street->type->name;
            $street->maps;
            $street->lat = $street->points[0]->lat; 
            $street->lng = $street->points[0]->lng;
        }

        return view("street.admin", $data);
    }
    public function storeAjax(Request $r){
        // Server side validation
        $r->validate([
            'type_id'=>'required',
            'name'=>'required'
        ]);

        $street = new Street($r->all());
        $street->save();

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
    public function updateAjax(Request $r){
        // Server side validation
        $r->validate([
            'type_id'=>'required',
            'name'=>'required'
        ]);

        $street = Street::find($r->id);
        $street->fill($r->all());
        
        // Maps streets relationships update
        $mapsRelationship = array();
        $mapsAsigned = Array();
        // Array to complete junction table
        if(isset($r->maps_id)){
            for ($i=0; $i < count($r->maps_id); $i++) { 
                $mapsRelationship[$r->maps_id[$i]] = ['alternative_name' => $r->maps_name[$i]];
    
                $mapFound = Map::find($r->maps_id[$i]);
                array_push($mapsAsigned, $mapFound);
            }
        }
        $street->maps()->sync($mapsRelationship);
        
        foreach ($mapsAsigned as $mapAsigned) {
            $pivot = DB::table('maps_streets')
                    ->where('map_id', $mapAsigned->id)
                    ->where('street_id', $street->id)
                    ->first();
            $mapAsigned->pivot = $pivot;
            // $pivot = MapStreet::where('map_id', $mapAsigned->id)->get();
        }

        // Point update
        $point = Point::find($street->points[0]->id);
        $point->id = $street->points[0]->id;
        $point->lat = $r->lat;
        $point->lng = $r->lng;
        $point->save();

        $street->save();

        $street->lat = $point->lat;
        $street->lng = $point->lng;
        $street->typeName = $street->type->name;
        $street->fullName = $street->typeName . " " . $street->name;
        
        
        return response()->json([
            'street' => $street,
            'points' => $point,
            'maps' => $mapsAsigned,
        ]);
    }
    public function updatePositionAjax(Request $r){
        $street = Street::find($r->id);
        
        // Point update
        $point = Point::find($street->points[0]->id);
        $point->lat = $r->lat;
        $point->lng = $r->lng;

        $point->save();
    }
    public function destroyAjax(Request $r){
        $street = Street::find($r->id);
        $street->maps()->detach();
        $street->points()->detach();
        $street->delete();

        $street->destroy($street->id);
        // Street::destroy($id);
    }

    // SHOW A SOMETHING ///////////////////////////////////////////////////////////////////////
    /**
     * Method that shows a specific register o our
     * database depending on it's ID
     * 
     * @param id
     * @return View
     */
    public function show($id){
        $data['street'] = Street::find($id);
        return view("street.show", $data);
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////
    // CREATE FORM /////////////////////////////////////////////////////////////////////////
    /**
     * Method that shows the form to create a new register
     * 
     * @return View
     */
    public function create(){
        $data['streetsTypes'] = StreetType::all();
        $data['maps'] = Map::all();
        $data['streets'] = Street::all();
        //return view("street.create", $data);
        return view("street.test", $data);
    }

    // STORE FUNCTION ///////////////////////////////////////////////////////////////////////
    /**
     * Method that recieves information in a Request object from the,
     * and then checks and include that information inside our database
     * 
     * @param r
     * @return View
     */
    public function store(Request $r){
        // Server side validation
        $r->validate([
            'type_id'=>'required',
            'name'=>'required'
        ]);

        $street = new Street($r->all());
        $street->save();
        if(!is_null($r->maps_id) > 0){
            for ($i=0; $i < count($r->maps_id); $i++) { 
                $mapStreet = new MapStreet();
                $mapStreet->street_id = $street->id;
                $mapStreet->map_id = $r->maps_id[$i];
                $mapStreet->alternative_name = $r->maps_name[$i];
                $mapStreet->save();
            }
        }
        
        $point = Point::Create(["lat" => $r->lat, "lng" => $r->lng]);
        $street->points()->attach($point->id);
        $street->type()->associate($r->type_id);
        return redirect(route('street.create'));
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // EDIT FORM //////////////////////////////////////////////////////////////////////////////
    /**
     * Method that shows the form to edit an already existing registry
     * 
     * @return View
     */
    public function edit($id){
        $data['street'] = Street::find($id);
        $data['streetsTypes'] = StreetType::all();
        $data['maps'] = Map::all();
        return view("street.edit", $data);
    }

    // UPDATE FUNCTION //////////////////////////////////////////////////////////////////////////////
    /**
     * Method that recieves information in a Request object,
     * then checks and changes the information inside our database
     * 
     * @param r
     * @param id
     * @return View
     */
    public function update(Request $r, $id){

        // Server side validation
        $r->validate([
            'type_id'=>'required',
            'name'=>'required'
        ]);

        $street = Street::find($id);
        $street->fill($r->all());
        
        // Maps streets relationships update
        $mapsRelationship = array();
        // Array to complete junction table
        for ($i=0; $i < count($r->maps_id); $i++) { 
            $mapsRelationship[$r->maps_id[$i]] = ['alternative_name' => $r->maps_name[$i]];
        }
        $street->maps()->sync($mapsRelationship);
        // Point update
        $point = Point::find($street->points[0]->id);
        $point->lat = $r->lat;
        $point->lng = $r->lng;
        $point->save();

        $street->save();
        return redirect(route('street.create'));
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // DESTROY //////////////////////////////////////////////////////////////////////////////
    /**
     * Method that deleets an specific registry inside out database
     * depending on a id that we will introduce by url
     * 
     * @param id
     * @return View
     */
    public function destroy($id){
        $street = Street::findOrFail($id);
        $street->maps()->detach();
        $street->points()->detach();
        // type
        $street->delete();

        
        //Street::destroy($id);
        return redirect(route('street.create'));
    }
}
