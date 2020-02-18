<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Map;
use App\Street;
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
    // SHOW THE MAIN MAP  /////////////////////////////////////////////////////////////////////
    /**
     * Method that shows all the registers in the database
     * 
     * @return View
     */
    public function map(){
        $maps = Map::all();
        //We sort the maps depending on the level
        $mapsSorted = Array();
        for ($i = 0; $i < sizeof($maps); $i++) {
            $mapsSorted[$maps[$i]->level - 1] = $maps[$i];
        }
        ksort($mapsSorted);
        
        $data['maps'] = $mapsSorted;
        
        return view("map.map", $data);
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
        $r->validate([
            'title' => 'required|unique:maps',
            'date' => 'required|numeric|min:0|max:'.date("Y").'',
            'image' => 'required|image',
            'description' => 'nullable|string',
            'city' => 'nullable|string',
            'miniature' => 'nullable|image',
        ]);

        $map = new Map($r->all());
        $map->id = Map::max('id') + 1;
        $map->level = Map::max('level') + 1;

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
        return redirect(route('map.align', $map->id));
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
        $r->validate([
            'title' => 'required|unique:maps,title,'. $id,
            'date' => 'required|numeric|min:0|max:'.date("Y").'',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
            'city' => 'nullable|string',
            'miniature' => 'nullable|image',
        ]);
        
        
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
        
        $map = Map::where("id", $r->id)->first();
        $level = $map->level;
        //We destroy the map
        Map::destroy($map->id);

        //We change the next levels
        for($i = $level + 1; $i <= Map::count()+1; $i++){
            $mapAux = Map::where("level", $i)->first();
            $mapAux = Map::find($mapAux->id);
            $mapAux->level -= 1;
            $mapAux->update();
        }
        unlink(url('img/maps/'. $data['map']->image));
        unlink(url('img/miniatures/'. $data['map']->miniature));

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
        
        
        //We chech that it's not the last one
        if($map->level != Map::count()){
            //We get the next map(The one that now has to go down)
            $mapNext = DB::table('maps')->where('level', $map->level + 1)->first();
            $mapNext = Map::find($mapNext->id);

            //We leave some space so the character dosent repeat
            $mapNext->level = 0;
            $map->level++;
            
            $mapNext->update();
            $map->update();
            
            $mapNext->level = $map->level - 1;
            $mapNext->update();
        } else {
            return response()->json(['lastOne'=>true]);
        }

        return response()->json(['level'=>$map->level]);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // ALIGN MAPS //////////////////////////////////////////////////////////////////////////////
    /**
     * View  where we can adjust the map
     * 
     * @param id
     * @return View
     */
    public function alignMap($id){
        $data['map'] = Map::find($id);
        return view('map.align', $data);
    }
    
    /**
     * Function where we will update the map position
     * 
     * @param id
     * @return View
     */
    public function saveAlign(Request $r, $id){
        $map = Map::find($id);

        // No me deja hacerlo del modo bonito por X
        $map->tlCornerLatitude = $r->tlLat;
        $map->tlCornerLongitude = $r->tlLon;
        $map->trCornerLatitude = $r->trLat;
        $map->trCornerLongitude = $r->trLon;
        $map->blCornerLatitude = $r->blLat;
        $map->blCornerLongitude = $r->blLon;
        $map->brCornerLatitude = $r->brLat;
        $map->brCornerLongitude = $r->brLon;
        
        $map->update();
        return redirect(route("map.index"));
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // LOOK FOR THINGS IN THE MAP /////////////////////////////////////////////////////////////
    /**
     * Method that gets the info from the database
     * 
     * @param id
     * @return View
     */
    public function search(Request $r){
        //We have to look for the street name/type
        $r->text = "Calle Avenida";
        $wordsAux = explode(" ", trim($r->text));
        $words = Array();
        foreach ($wordsAux as $word) {
            if($word != ""){
                $words[] = $word;
            }
        }
        
        //Array donde guardaremos todas las calles que hemos encontrado por los tipos de calles
        $streetsByType = Array();
        $streetsFound = Array();
        
        // Tipos de calles que hemos concontrado
        $typesFound = Array();
        for ($i = 0; $i < sizeof($words); $i++) {
            $aux = DB::table('street_types')->where('name', 'like', '%'.$words[$i].'%')->get()->toArray();
            if(sizeof($aux) != 0 && !in_array($aux, $typesFound)){
                $typesFound[] = $aux[0]; 
            }
        }
        
        // Aqui tenemos todos las calles de los tipos que se han podido deducir de lo que se ha metido
        for($i = 0; $i < sizeof($typesFound); $i++){
            $aux = DB::table('streets')->where('type_id', $typesFound[$i]->id)->get()->toArray();
            foreach ($aux as $street) {
                if(!in_array($street, $streetsByType))
                $streetsByType[] = $street;    
            }
        }
        dd($streetsByType);
        
        for ($i = 0; $i < sizeof($streetsByType); $i++) { 
            for ($j = 0; $j < sizeof($streetsByType[$i]); $j++) {
                $streetsFound[] = $streetsByType[$i][$j];
            }
        }
        
        // Buscamos por el nombre de la calle 
        $auxNames = DB::table('streets')->where('name', 'like', '%'.$r->text.'%')->get();
        for($i = 0; $i < sizeof($auxNames); $i++){
            //Miramos si ya lo hemos añadido antes al poner los tipos de calles
            if(!in_array($auxNames[$i], $streetsFound)){
                $streetsFound[] = $auxNames[$i];

            }
        }
        //Le añadimos a el array Calle un objeto type 
        for($i = 0; $i < sizeof($streetsFound); $i++){
            $type = DB::table('street_types')->where("id", $streetsFound[$i]->type_id)->get()->first();
            $streetsFound[$i]->type = $type;    
        } 
        
        //And then in the hotspot title
        $hotSpotsFound = DB::table('hotspots')->where('title', 'like', '%'.$r->text.'%')->get();

        return response()->json([
            'streets'=>$streetsFound,
            'hotspots'=>$hotSpotsFound,
        ]);
    }
}