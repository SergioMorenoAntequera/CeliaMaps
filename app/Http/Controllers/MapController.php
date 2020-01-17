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
        $data['maps'] = Map::all();
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
    public function destroy($id){
        Map::destroy($id);  
        return redirect(route("map.index"));
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // MOVE UP //////////////////////////////////////////////////////////////////////////////
    /**
     * Method that moves a map up
     * 
     * @param id
     * @return View
     */
    public function moveUp($id){
        //We get the map that we are going to move
        $map = Map::find($id);
        //We chech that it's not the first one
        if($map->level > 1){
            //We get the next map(The one that now has to go down)
            $mapNext = DB::table('maps')->where('level', $map->level-1)->first();
            $mapNext = Map::find($mapNext->id);
            
            //We leave some space so the character dosent repeat
            $mapNext->level = 0;
            $map->level--;
            
            $mapNext->update();
            $map->update();
            
            $mapNext->level = $map->level + 1;
            $mapNext->update();
        } else {
            echo("Error al subir mapa");
            return redirect(route("map.index"));
        }
        echo("Mapa clickado ahora en el level: ". $map->level ."<br>");
        echo("Mapa siguiete ahora en el level: ". $mapNext->level);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // MOVE DOWN //////////////////////////////////////////////////////////////////////////////
    /**
     * Method that moves a map down
     * 
     * @param id
     * @return View
     */
    public function moveDown($id){
        //We get the map that we are going to move
        $map = Map::find($id);
        //We chech that it's not the last one
        $maps = Map::all();
        $lastMap = $maps->last();
        if($map->level < $lastMap->level){
            //We get the next map(The one that now has to go down)
            $mapNext = DB::table('maps')->where('level', $map->level+1)->first();
            $map->level++;
            $mapNext->level--;
            //$mapNext->level = 0;
            //$levelAux = $map->level;
            //$map->level += 1;
            //$mapNext->level = $levelAux;
        } else {
            echo("Error al bajar mapa");
            return redirect(route("map.index"));
        }
        echo("Mapa clickado ahora en el level: ". $map->level ."<br>");
        echo("Mapa siguiete ahora en el level: ". $mapNext->level);
        dd();
    }
}
