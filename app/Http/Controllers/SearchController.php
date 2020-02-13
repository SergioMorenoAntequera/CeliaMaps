<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Street;
use DB;
use PDF;

class SearchController extends Controller
{
    public function index(){

       $streetList = Street::all();

        return view('search/searchStreet', ['streetList'=>$streetList]);
    }

    public function search(Request $request){

        $data = $request->text; // lo que escribimos en la caja de texto de la vista

        $data = Street::where('name', 'like', $data.'%')->get();   
        return response()->json($data);

       
    }

    public function download()
    {
    
        $data = ['title' => 'CeliaMaps'];
        $pdf = PDF::loadView('search.searchStreet', $data);
     
        return $pdf->download('probandopdf.pdf');


        //return PDF::loadView('search.probandopdf', $data)
        //->stream('probandopdf.pdf');
    
    /*
       $data = ['title' => 'CeliaMaps'];
       //$streetList = Street::all();
       
        $pdf = PDF::loadView('search.probandopdf', $data);
     
        return $pdf->download('probandopdf.pdf');
    
        //$pdf = \PDF::loadView('search/searchStreet', $data);
     
        //return $pdf->download('archivo.pdf');
    
       // return PDF::loadView('search/probandopdf', $data)->stream('archivo.pdf');
    */
    }
    
}