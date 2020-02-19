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
    public function index(){

        $streets = Street::all();
        $maps = Map::all();
        $types = StreetType::all();
        return view('search/searchStreet', ['streets'=>$streets,'maps'=>$maps,'types'=>$types]);      
       
     }

    public function search(Request $request){

        $data = $request->text; // lo que escribimos en la caja de texto de la vista
        //id, name, type
        $data = DB::table('streets')                          
                            ->join('street_types','streets.type_id','=','street_types.id')
                            ->join('maps_streets', 'streets.id','=','maps_streets.street_id')
                            ->select('streets.id','streets.street_name','street_types.name','maps_streets.map_id')
                            //->select('streets.*','street_types.name')
                            ->where('streets.street_name', 'like','%'.$data.'%')->get();
       // $data = Street::where('name', 'like','%'.$data.'%')->get();   
        return response()->json($data);       
    }

    public function download()
    {    
        //$data = ['title' => 'CeliaMaps'];
        //$street = Street::find($id);
        $data = Street::all();

        $pdf = PDF::loadView('search.report', $data);

          //->stream('report.pdf'); para que se abra en otra pagina
     
        return $pdf->download('report.pdf');
       
    }
    public function report($id)
    {
        $street = Street::find($id);
        //dd($street);
        $maps = MapStreet::all();
        //dd($maps);
        $types = StreetType::all();
        //dd($types);
       return view('search/report', array('street'=>$street, 'map'=>$maps, 'type'=>$types));
    }    
}



      
    