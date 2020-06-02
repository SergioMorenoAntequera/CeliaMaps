<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Street;
use App\Map;
use App\StreetType;
use App\Point;
use App\MapStreet;
use App\Organization;
use DB;
use PDF;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth")->except("inform");
    }

    // MUESTRA EL LISTADO DE LAS CALLES CON EL BUSCADOR ///////////////////////////
    public function index() {
        $streets = Street::all();
        $maps = Map::all();
        $types = StreetType::all()->sortBy('name');
        return view('search/searchStreet', ['streets' => $streets, 'maps' => $maps, 'types' => $types]);
    }
    // PARA QUE FUNCIONE EL BUSCADOR //////////////////////////////////////////////
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
        $org = Organization::all();
        // Mantenemos la variable flash para guardar el último sitio visitado (frontend)
        $request->session()->reflash();
        // Controlamos el acceso de usuarios invitados
        $guest = true;
        if($request->user()){
            $guest = false;
        }
        return view('search/informe', array('street' => $street, 'street_type' => $street_type, 'map' => $map, 'map_street' => $map_street,'org' => $org, 'guest' => $guest));
    }
}
