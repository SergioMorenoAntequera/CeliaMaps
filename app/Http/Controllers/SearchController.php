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

        $data = $request->text;

        $data = Street::where('name', 'like', $data.'%')->get();
       
        

        return response()->json($data);

       /* $users = DB::table('users')
                ->where('name', 'like', 'T%')
                ->get();

                $data = DB::table('streets')->where('name', 'like', $data.'%')->get();
        */
        //dd($data);

        //$view = view('search/searchStreet', compact('data'))->render();
    }
}