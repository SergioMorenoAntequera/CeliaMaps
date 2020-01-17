<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Map;
use DB;


class MapController extends Controller
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
        //$this->middleware('auth')->except('index', 'show');     
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // SHOW ALL SOMETHING  ////////////////////////////////////////////////////////////////////
    /**
     * Method that shows all the registers in the database
     * 
     * @return View
     */
    public function index(){
        $maps = Map::all();
        //We sort the maps depending on the level
        $mapsSorted = Array();
        for ($i = 0; $i < sizeof($maps); $i++) {
            $mapsSorted[$maps[$i]->level - 1] = $maps[$i];
        }
        ksort($mapsSorted);
        
        $data['maps'] = $mapsSorted;
        $data['mapMaxLevel'] = Map::max('level');
        return view("map.index", $data);
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
        $data['map'] = Map::find($id);
        return view("map.show", $data);
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////
    // CREATE FORM /////////////////////////////////////////////////////////////////////////
    /**
     * Method that shows the form to create a new register
     * 
     * @return View
     */
    public function create(){
        return view("map.create");
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
        $map = new Map($r->all());
        $map->id = Map::max('id')+1;
        
        if($r->hasFile('image')){
            $file = $r->file('image');
            $file->move(public_path("/img/maps/"), $map->id.$file->getClientOriginalName());
            $map->image = $map->id.$file->getClientOriginalName();
        } else {
            $map->image = "NoMap.png";
        }

        if($r->hasFile('miniature')){
            $file = $r->file('miniature');
            $file->move(public_path("/img/miniatures/"), $map->id.$file->getClientOriginalName());
            $map->miniature = $map->id.$file->getClientOriginalName();
        } else {
            $map->miniature = "NoMiniature.png";
        }

        $map->save();
        return redirect(route('map.index'));
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // EDIT FORM //////////////////////////////////////////////////////////////////////////////
    /**
     * Method that shows the form to edit an already existing registry
     * 
     * @return View
     */
    public function edit($id){
        $data['map'] = Map::find($id);
        return view('map.edit', $data);
    }

    // UPDATE FUNCTION //////////////////////////////////////////////////////////////////////////////
    /**
     * Method that recieves information in a Request object,
     * then checks and changes the information inside our database
     * 
     * @param r
     * @return View
     */
    public function update(Request $r, $id){
        $map = Map::find($id);
        
        $map->fill($r->all());
        if($r->hasFile('image')){
            $file = $r->file('image');
            $file->move(public_path("/img/maps/"), $map->id.$file->getClientOriginalName());
            $map->image = $map->id.$file->getClientOriginalName();
        }

        if($r->hasFile('miniature')){
            $file = $r->file('miniature');
            $file->move(public_path("/img/miniatures/"), $map->id.$file->getClientOriginalName());
            $map->miniature = $map->id.$file->getClientOriginalName();
        }

        $map->update();
        return redirect(route("map.index"));
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
    public function destroy(Request $r){
        $map = Map::where("level", $r->level)->first();
        
        //We destroy the map
        Map::destroy($map->id);

        //We change the next levels
        for($i = $r->level + 1; $i <= Map::count()+1; $i++){
            $mapAux = Map::where("level", $i)->first();
            $mapAux = Map::find($mapAux->id);
            $mapAux->level -= 1;
            $mapAux->update();
        }

        return response()->json([
            'count'=> Map::count(),
            'levelSelected'=>$r->level,
        ]);
        
        //Map::destroy($id);  
        //return redirect(route("map.index"));
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // MOVE UP //////////////////////////////////////////////////////////////////////////////
    /**
     * Method that moves a map up
     * 
     * @param id
     * @return View
     */
    public function moveUp(Request $r){
        
        //We get the map that we are going to move
        $map = Map::where("level", $r->level)->first();
        //We get the next map(The one that now has to go down)
        $mapNext = DB::table('maps')->where('level', $map->level-1)->first();
        $mapNext = Map::find($mapNext->id);
        
        //We chech that it's not the first one
        if($map->level > 1){
            //We leave some space so the character dosent repeat
            $mapNext->level = 0;
            $map->level--;
            
            $mapNext->update();
            $map->update();
            
            $mapNext->level = $map->level + 1;
            $mapNext->update();
        } else {
            return response()->json(['respond'=>false]);
        }

        return response()->json(['level'=>$map->level]);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // MOVE DOWN //////////////////////////////////////////////////////////////////////////////
    /**
     * Method that moves a map down
     * 
     * @param id
     * @return View
     */
    public function moveDown(Request $r){
        //We get the map that we are going to move
        $map = Map::where("level", $r->level)->first();
        //We get the next map(The one that now has to go down)
        $mapNext = DB::table('maps')->where('level', $map->level + 1)->first();
        $mapNext = Map::find($mapNext->id);
        
        //We chech that it's not the first one
        if($mapNext != null && $map->level + 1 == $mapNext->level){
            
            //We leave some space so the character dosent repeat
            $mapNext->level = 0;
            $map->level++;
            
            $mapNext->update();
            $map->update();
            
            $mapNext->level = $map->level - 1;
            $mapNext->update();
        } else {
            return response()->json(['respond'=>false]);
        }

        return response()->json(['level'=>$map->level]);
    }
}
