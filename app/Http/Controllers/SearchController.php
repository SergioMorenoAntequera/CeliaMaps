<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Street;

class SearchController extends Controller
{
    public function index(){

       $streetList = Street::all();

        return view('search/searchStreet', ['streetList'=>$streetList]);
    }
    public function search(Request $request){

        $data = $request->text;

        $data = Street::where('name', 'LIKE', '%'.$data)->first();
       
        //dd($data);

        //$view = view('search/searchStreet', compact('data'))->render();

        return response()->json($data);



    }
}