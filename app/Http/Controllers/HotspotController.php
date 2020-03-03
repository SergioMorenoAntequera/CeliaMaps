<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Hotspot;
use Illuminate\Http\Request;
use App\Image;
use App\Map;

class HotspotController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth')->except('index', 'show');     
    }

    /**
     * Method that shows all the registers in the database
     * 
     * @return View
     */
    public function index(){
        $hotspot = Hotspot::all();
        return view('hotspot.index', ['hotspots'=>$hotspot]);
    }

    /**
     * Method that shows a specific register o our
     * database depending on it's ID
     * 
     * @param id
     * @return View
     */
    public function show($id){
        $hotspot = Hotspot::find($id);
        return view('hotspot.show', ['hotspot'=>$hotspot]);
    }
    
    /**
     * Method that shows the form to create a new register
     * 
     * @return View
     */
    public function create(){
        $hotspots = Hotspot::all();
        $map = Map::all();
        $image = Image::all();
        //dd($hotspots[0]->images[1]->file_name);
        return view('hotspot.test', ['hotspots'=>$hotspots, 'maps'=>$map, 'images'=>$image]);
    }
    
    /**
     * Method that recieves information in a Request object from the,
     * and then checks and include that information inside our database
     * 
     * @param r
     * @return View
     */
    public function store(Request $r){
        /*
        $r->validate([
            'titulo' => 'required|max:50',
        ]);
        */

        $hotspot = new Hotspot($r->all());
        $hotspot->save();
        $hotspot->images()->attach($r->image_id);
        return redirect()->route('hotspot.index');
    }

    /**
     * Method that shows the form to edit an already existing registry
     * 
     * @return View
     */
    public function edit($id){
        $hotspot = Hotspot::find($id);
        return view('hotspot.edit', array('hotspot' => $hotspot));
    }

    /**
     * Method that recieves information in a Request object,
     * then checks and changes the information inside our database
     * 
     * @param r
     * @return View
     */
    public function update(Request $r, $id){
        $hotspot = Hotspot::find($id);
        $hotspot->fill($r->all());
        $hotspot->save();
        return redirect()->route('hotspot.index');
    }

    /**
     * Method that deleets an specific registry inside out database
     * depending on a id that we will introduce by url
     * 
     * @param id
     * @return View
     */
    public function destroy($id){
        $hotspot = Hotspot::find($id);
        $hotspot->delete();
        return redirect()->route('hotspot.index');
    }
}
