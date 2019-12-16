<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Map;

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
        //$this->middleware('auth')->except('index', 'show');     
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // SHOW ALL SOMETHING  ////////////////////////////////////////////////////////////////////
    /**
     * Method that shows all the registers in the database
     * 
     * @return View
     */
    public function index(){
        $data['maps'] = Map::all();
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
        return view("map.create");
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
        $map = new Map($r->all());
        $map->id = Map::max('id')+1;
        
        if($r->hasFile('image')){
            $file = $r->file('image');
            $file->move(public_path("/img/maps/"), $map->id.$file->getClientOriginalName());
            $map->image = $map->id.$file->getClientOriginalName();
        } else {
            $map->image = "NoMap.png";
        }

        $map->save();
        return redirect(route('map.index'));
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
        
        $map->fill($r->all());
        if($r->hasFile('image')){
            $file = $r->file('image');
            $file->move(public_path("/img/maps/"), $map->id.$file->getClientOriginalName());
            $map->image = $map->id.$file->getClientOriginalName();
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
    public function destroy($id){
        Map::destroy($id);
        return redirect(route("map.index"));
    }
}
