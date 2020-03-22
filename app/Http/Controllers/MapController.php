<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Map;
use App\Street;
use App\Hotspot;
use App\MapStreet;
use App\Point;
use App\Marker;
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
<<<<<<< HEAD
<<<<<<< HEAD
        $this->middleware('auth')->except('map', 'getStreets', 'search');     
=======
        $this->middleware('auth')->except('map', 'getSteets', 'search');     
>>>>>>> 4eee9de53c5eb221be4228e31bedc7162dadf02c
=======
        //$this->middleware('auth')->except('map', 'getSteets', 'search');     
>>>>>>> 6e6e361f3a80aee3792a5b903f8c4a865d68b1d5
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // SHOW THE MAIN MAP  /////////////////////////////////////////////////////////////////////
    /**
     * Method that shows all the registers in the database
     * 
     * @return View
     */
    public function map(){
        // Preparamos los mapas ordenados
        $maps = Map::all();
        $mapsSorted = Array();
        for ($i = 0; $i < sizeof($maps); $i++) {
            $mapsSorted[$maps[$i]->level - 1] = $maps[$i];
        }
        ksort($mapsSorted);
        $data['maps'] = $mapsSorted;
        
        // Preparamos los hps con sus imagenes
        $hotspots = HotSpot::all();
        foreach ($hotspots as $hp) {
            $hp->images = $hp->images->toArray();
        }
        
        $data['hotspots'] = $hotspots;
        
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
        $data['streets'] = Street::all();
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
        $maps = Map::all();
        //We sort the maps depending on the level
        $mapsSorted = Array();
        for ($i = 0; $i < sizeof($maps); $i++) {
            $mapsSorted[$maps[$i]->level - 1] = $maps[$i];
        }
        ksort($mapsSorted);
        
        $data['maps'] = $mapsSorted;
        return view("map.create", $data);
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

        //Herencia de calles de otro mapa
        if($r->inherit != "Ninguno"){
            $mapToInherit = DB::table('maps')->where('title', 'like',  $r->inherit)->first(); 
            $mapToInherit = Map::find($mapToInherit->id);

            $streets = $mapToInherit->streets->toArray();

            foreach ($streets as $mapStreet) {
                $mapStreet = DB::table('maps_streets')
                        ->where('street_id', $mapStreet['id'])
                        ->where('map_id', $mapToInherit->id)->first();
                $info = MapStreet::find($mapStreet->id);

                $newMapsStreet = new MapStreet();
                $newMapsStreet->id = MapStreet::max('id') + 1;
                $newMapsStreet->street_id = $info->street_id;
                $newMapsStreet->map_id = $map->id;
                
                $newMapsStreet->save();
            }
        }

        $map = $this->createMiniature($r, $map);
    

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
        $data['maps'] = Map::all();
        $data['streets'] = Street::all();
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

        //Para todo el tema de las calles y como se heredan y tal ...
        if($r->streetsToDo == "Calles actuales"){
            $map->streets()->detach();
            
            if($r->streetsInMap != null ){
                foreach ($r->streetsInMap as $streetId) {
                    $streetIn = Street::find($streetId);
                    $map->streets()->attach($streetIn);
                }
            }
        } else {
            //Herencia de calles de otro mapa
            if($r->inherit != "Ninguno"){
                //Borramos las que tenia antes
                $map->streets()->detach();

                //Añadimos las calles del nuevo mapa
                $mapToInherit = DB::table('maps')->where('title', 'like',  $r->inherit)->first(); 
                $mapToInherit = Map::find($mapToInherit->id);
                $mapToInherit = Map::find($mapToInherit->id);
                
                $streets = $mapToInherit->streets->toArray();

                foreach ($streets as $mapStreet) {
                    $mapStreet = DB::table('maps_streets')
                            ->where('street_id', $mapStreet['id'])
                            ->where('map_id', $mapToInherit->id)->first();
                    $info = MapStreet::find($mapStreet->id);

                    $newMapsStreet = new MapStreet();
                    $newMapsStreet->id = MapStreet::max('id') + 1;
                    $newMapsStreet->street_id = $info->street_id;
                    $newMapsStreet->map_id = $map->id;
                    
                    $newMapsStreet->save();
                }
            }
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
        
        if(sizeof($map->streets) > 0){
            return response()->json([
                'delete' => false,
            ]);
        }
        
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

        return response()->json([
            'delete' => true,
            'count'=> Map::count(),
            'levelSelected'=>$r->level,
        ]);
        
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

        return response()->json([
            'level'=>$map->level,
            'levelOther'=>$mapNext->level
        ]);
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

        return response()->json([
            'level'=>$map->level,
            'levelOther'=>$mapNext->level
        ]);
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
    
    ///////////////////////////////////////////////////////////////////////////////////////////
    // SAVE ALIGN //////////////////////////////////////////////////////////////////////////////
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
    public function search(/* Request $r */){

        $streets = Street::all();
        foreach ($streets as $street) {
            $street->typeName = $street->type->name;
            $street->maps;
            $street->lat = $street->points[0]->lat; 
            $street->lng = $street->points[0]->lng;
        }
        //dd($streets);
        $hotspots = HotSpot::all();
        
        return response()->json([
            'streets'=>$streets,
            'hotspots'=>$hotspots,
        ]);

        //We have to look for the street name/type
        // $r->text = "ave med";
        // $wordsAux = explode(" ", trim($r->text));
        // $words = Array();
        // foreach ($wordsAux as $word) {
        //     if($word != "") {
        //         $words[] = $word;
        //     }
        // }
        // $streetsFound = Array();
        
        // // Tipos de calles que hemos concontrado
        // $typesFound = Array();
        // //Recorremos las palabras
        // for ($i = 0; $i < sizeof($words); $i++) {
        //     //Buscamos por un tipo que contenga esa palabra
        //     $auxTypes = DB::table('street_types')->where('name', 'like', '%'.$words[$i].'%')->get()->toArray();
        //     //Miramos a ver si encuentra o si ya lo hemos añadido
        //     if(sizeof($auxTypes) != 0 && !in_array($auxTypes[0], $typesFound)){
        //         $typesFound[] = $auxTypes[0];
        //         // Si no, buscamos las calles que se correspondan
        //         $aux = DB::table('streets')->where('type_id', $auxTypes[0]->id)->get()->toArray();
        //         // Por cada calle que encuentre de ese tipo lo añadimos
        //         foreach ($aux as $street) {
        //             // Comprobamos que no la añada si ya está
        //             if(!in_array($street, $streetsFound)){
        //                 $street->type = DB::table('street_types')->where('id', $street->type_id)->first();
        //                 $streetsFound[] = $street;    
        //             }
        //         }
        //     }

        //     //Busamos por un nombre que contenga esa palabra
        //     $auxNames = DB::table('streets')->where('name', 'like', '%'.$words[$i].'%')->get()->toArray();
        //     foreach ($auxNames as $street) {
        //         $street->type = DB::table('street_types')->where('id', $street->type_id)->first();
        //         if(!in_array($street, $streetsFound)){
        //             $streetsFound[] = $street;
        //         }
        //     }
        // }
        
        
        // // dd($streetsFound);
        // //And then in the hotspot title
        // $hotSpotsFound = DB::table('hotspots')->where('title', 'like', '%'.$r->text.'%')->get();
        // // dd($streetsFound[0]->type);
        // return response()->json([
        //     'streets'=>$streetsFound,
        //     'hotspots'=>$hotSpotsFound,
        // ]);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // LOOK FOR THINGS IN THE MAP /////////////////////////////////////////////////////////////
    /**
     * Method that gets the info from the database
     * 
     * @param id
     * @return View
     */
    public function getStreets(Request $r){
        if($r->title == "Todos"){
            $streets = Street::all();
        } else {
            $map = DB::table('maps')->where('title', $r->title)->first();
            $map = Map::find($map->id);
            $streets = $map->streets;
        }
        
        
        foreach ($streets as $street) {
            $street->type = $street->type()->first()->toArray();
        }
        
        return response()->json([
            'streets' => $streets->toArray(),
        ]);
    }

    // Metodo auxiliar que me saca las miniaturas de los mapas ///////////////////////////////
    private function createMiniature(Request $r, Map $map){
        //Now that we have to have a image we want it or not
        $file = $r->file('image');
        $dim = Array();
        $dim['x'] = getimagesize($file)[0]/4; 
        $dim['y'] = getimagesize($file)[1]/4;
        $dim['width'] = getimagesize($file)[0]/2;
        $dim['height'] = getimagesize($file)[1]/2;

        $fileName = $map->id.$file->getClientOriginalName();
        $mapsPath = public_path("img/maps/");
        $miniaturesPath = public_path("img/miniatures/");
        
        //We move the file to this folder to save it
        $file->move($mapsPath, $fileName);
        
        // we check if we already have a miniature
        if($r->hasFile('miniature')){
            //If we are introducing a miniature we just save it (boring)
            $miniatureFile = $r->file('miniature');
            $miniatureFile->move($miniaturesPath, $fileName);
        } else {
            // Let's gnerate the miniature by ourselfs
            // We get the path that we are gonna use
            // Miramos que sea un png (porque hay que usar un metodo especial)
            if(strpos($fileName, ".png")){
                //Conseguimos la imagen
                $miniature = imagecreatefrompng($mapsPath . $fileName);
                

                //Cortamos la imagen y comporbamos que la hemos cortado
                //$miniature = imagecrop($miniature, $dim);
                $miniature = (imagescale($miniature, $dim['x'], $dim['y'], IMG_NEAREST_NEIGHBOUR));
                if ($miniature !== FALSE) {
                    // Header para visualizar
                    header("Content-type: image/png"); 
                    // Lo pasamos a imagen y lo guardamos
                    
                    imagepng($miniature, $miniaturesPath.$fileName);
                    //Destruimos el archivo temporal
                    imagedestroy($miniature);
                }
            } else {
                // Miramos que sea un JPEG (porque hay que usar un metodo especial)
                if(strpos($fileName, ".jpeg")){
                    //Conseguimos la imagen
                    $miniature = imagecreatefromjpeg($mapsPath . $fileName);
                    
                    //Cortamos la imagen y comporbamos que la hemos cortado
                    //$miniature = imagecrop($miniature, $dim);
                    $miniature = (imagescale($miniature, $dim['x'], $dim['y'], IMG_BILINEAR_FIXED));
                    if ($miniature !== FALSE) {
                        // Header para visualizar
                        header("Content-type: image/jpeg"); 
                        // Lo pasamos a imagen y lo guardamos
                        
                        imagejpeg($miniature, $miniaturesPath.$fileName);
                        //Destruimos el archivo temporal
                        imagedestroy($miniature);
                    }
                }
            }
        }
        $map->miniature = $fileName;
        $map->image = $fileName;
        return $map;
    }
}