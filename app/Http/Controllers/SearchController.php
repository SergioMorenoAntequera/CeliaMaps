<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Street;
use App\Map;
use App\StreetType;
use App\Point;
use App\MapStreet;
use DB;
use PDF;

class SearchController extends Controller
{
    public function index()
    {

        $streets = Street::all();
        $maps = Map::all();
        $types = StreetType::all();
        return view('search/searchStreet', ['streets' => $streets, 'maps' => $maps, 'types' => $types]);
    }

    public function search(Request $request)
    {

        $data = $request->text; // lo que escribimos en la caja de texto de la vista
        //id, name, type
        $data = DB::table('streets')
            ->join('street_types', 'streets.type_id', '=', 'street_types.id')
            ->select('streets.id', 'streets.name as street_name', 'street_types.name')
            ->where('streets.name', 'like', '%' . $data . '%')->take(10)->get();
        return response()->json($data);
    }
    public function show($id){

        $street = Street::find($id);        
        $street_type = StreetType::all();       
        $map = Map::all();
        return view('search/informeImprimir', array('street' => $street, 'street_type' => $street_type, 'map' => $map));
       
    }
    public function download($id)
    {

        $street = Street::find($id);        
        $street_type = StreetType::all();       
        $map = Map::all();
        $pdf = PDF::loadView('search/informeImprimir', array('street' => $street, 'street_type' => $street_type, 'map' => $map));       

        //return $pdf->download('Informe.pdf');
        return $pdf->stream('Informe.pdf');
    }
    public function inform($id)
    {
        $street = Street::find($id);
        //dd($street);
        $street_type = StreetType::all();
        //dd($street_type);
        $map = Map::all();
        //dd($map);

        return view('search/informe', array('street' => $street, 'street_type' => $street_type, 'map' => $map));
    }
}
