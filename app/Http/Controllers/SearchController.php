<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Street;
use App\Map;
use App\StreetType;
use App\Point;
use App\MapStreet;
use App\Hotspot;
use App\Image;
use DB;
use Cookie;


class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth")->except("inform");
    }

    // MUESTRA EL LISTADO DE LAS CALLES Y LOS PUNTOS DE INTERÉS CON EL BUSCADOR ///////////////////////////
    public function index() {
        $streets = Street::all()->sortBy('name');
        $maps = Map::all();
        $types = StreetType::all();
        $hotspots = Hotspot::all()->sortBy('title');

        //return view('search/searchStreet', ['streets' => $streets, 'maps' => $maps, 'types' => $types]);

        return view('search/searchAll', ['streets' => $streets, 'maps' => $maps, 'types' => $types, 'hotspots' => $hotspots]);
    }
    // PARA QUE FUNCIONE EL BUSCADOR DE LAS CALLES //////////////////////////////////////////////
    public function search(Request $request)
    {
        $data = $request->text; // lo que escribimos en la caja de texto de la vista
        //id, name, type
        $data = DB::table('streets')
            ->join('street_types', 'streets.type_id', '=', 'street_types.id')
            ->join('maps_streets', 'streets.id', '=', 'maps_streets.street_id')
            ->select('streets.id', 'streets.name as street_name', 'street_types.name', 'maps_streets.alternative_name')
            ->where('streets.name', 'like', '%' . $data . '%')
            ->orWhere('maps_streets.alternative_name', 'like', '%' . $data . '%')->distinct()->take(10)->get();
        return response()->json($data);
    }
    // PARA QUE FUNCIONE EL BUSCADOR DE LOS PUNTOS DE INTERÉS ///////////////////////////////////
    public function searchHotspot(Request $request)
    {
        $data = $request->text; // la variable $data contendrá lo que se ha introducido en la caja de texto de la vista
        $data = DB::table('hotspots') // equivale a select * from
            ->join('images', 'hotspots.id', '=', 'images.hotspot_id')
            //->join('maps', 'images.map_id', '=', 'maps.id')
            //->select('hotspots.id','hotspots.title', 'hotspots.description', 'images.id as id_image', 'images.title as title_image', 'images.description as description_image', 'images.file_name', 'maps.id as map_id')
            ->select('hotspots.id','hotspots.title', 'images.id as id_image', 'images.title as title_image')
            ->where('hotspots.title', 'like', '%' . $data . '%')->distinct()->take(10)->get();
            return response()->json($data);
    }
    // MUESTRA LA VISTA PREVIA DEL PDF, ES SÓLO PARA PROBARLO /////////////////////////
    public function show($id){

        $street = Street::find($id);
        $street_type = StreetType::all();
        $map = Map::all();
        return view('search/informeImprimir', array('street' => $street, 'street_type' => $street_type, 'map' => $map));
    }

    // MUESTRA LA VISTA DE LA CALLE SELECCIONADA //////////////////////////////////////
    public function inform($id, Request $request)
    {
        $street = Street::find($id);
        $street_type = StreetType::all();
        $map_street = MapStreet::all();
        $map = Map::all();

        // Mantenemos la variable flash para guardar el último sitio visitado (frontend)
        $request->session()->reflash();
        // Controlamos el acceso de usuarios invitados
        $guest = true;
        if($request->user()){
            $guest = false;
        }
        //Creamos la cookie para mostrar o no la ayuda contextual

        Cookie::queue(Cookie::make('cookie1Probando', true));

        //return view('search/informe', array('street' => $street, 'street_type' => $street_type, 'map' => $map, 'map_street' => $map_street, 'guest' => $guest));
        return view('search/informenuevo', array('street' => $street, 'street_type' => $street_type, 'map' => $map, 'map_street' => $map_street, 'guest' => $guest));
    }

    // MUESTRA LA VISTA DEL PUNTO DE INTERÉS SELECCIONADO
    public function hotspot($id){
        $hotspot = Hotspot::find($id);
        $image = Image::all();
        $map = Map::all();
        //return view('search/informeHotspot', array('hotspot' => $hotspot, 'image' => $image, 'map' => $map));

        return view('search/informeHotspot', array('hotspot' => $hotspot, 'image' => $image));

    }

     /*Creamos la cookie para mostrar o no la ayuda contextual
    public function hideHelp(Request $request)
    {
        Cookie::queue(Cookie::make('cookieNuevaProbando', 2));

    }
    */
}
