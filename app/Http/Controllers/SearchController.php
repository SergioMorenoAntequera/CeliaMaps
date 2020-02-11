<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Street;
use DB;

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
}