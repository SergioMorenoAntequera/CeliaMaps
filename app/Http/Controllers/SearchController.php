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
                            ->join('maps', 'streets.id','=','maps_streets.street_id')
                            ->select('streets.*','street_types.*')
                            ->where('streets.name', 'like','%'.$data.'%')->get();
       // $data = Street::where('name', 'like','%'.$data.'%')->get();   
        return response()->json($data);       
    }

    public function download()
    {
    
        $data = ['title' => 'CeliaMaps'];
        $pdf = PDF::loadView('search.inform', $data);

          //->stream('informe.pdf'); para que se abra en otra pagina
     
        return $pdf->download('informe.pdf');
       
    }
    public function inform()
    {
       return view('search/inform');
    }    
}



      
    