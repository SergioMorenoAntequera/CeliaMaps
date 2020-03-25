<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marker;
use App\Point;

class MarkerController extends Controller
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
    public function admin(){
        $data['markers'] = Marker::all();
        $data['lastID'] = Marker::max('id');
        return view("marker.admin", $data);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // SHOW ALL SOMETHING  ////////////////////////////////////////////////////////////////////
    /**
     * Method that shows all the registers in the database
     * 
     * @return View
     */
    // public function index(){
    //     return view("marker.admin");
    // }

    // SHOW A SOMETHING ///////////////////////////////////////////////////////////////////////
    /**
     * Method that shows a specific register o our
     * database depending on it's ID
     * 
     * @param id
     * @return View
     */
    public function show($id){

    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////
    // CREATE FORM /////////////////////////////////////////////////////////////////////////
    /**
     * Method that shows the form to create a new register
     * 
     * @return View
     */
    public function create(){

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
        $data = (array) json_decode($r->layer);
        //Conseguimos el marcador
        $marker = new Marker();
        $marker->fill($data);
        
        // Conseguimos los puntos y los unimos uno a uno
        $points = (array) $data['points'];
        
        if($marker->type == "polygon" || $marker->type == "line"){
            // Polygon and lines, have multiple points
            foreach ($points as $point) {
                $pointAux = new Point();
                $pointAux->fill((array) $point);
                //Juntamos todo
                $marker->points()->save($pointAux);
            }
        } else {
            // Circles and Markers, have one point
            $pointAux = new Point();
            $pointAux->fill($points);
            //Juntamos todo
            $marker->points()->save($pointAux);
        }
        
        $marker->save();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // EDIT FORM //////////////////////////////////////////////////////////////////////////////
    /**
     * Method that shows the form to edit an already existing registry
     * 
     * @return View
     */
    public function edit($id){
        
    }

    // UPDATE FUNCTION //////////////////////////////////////////////////////////////////////////////
    /**
     * Method that recieves information in a Request object,
     * then checks and changes the information inside our database
     * 
     * @param r
     * @return View
     */
    public function update(Request $r){
        $data = (array) json_decode($r->layer);
        
        //Conseguimos el marcador
        $marker = Marker::find($data['id']);
        $marker->fill($data);

        // Comprobamos el radius
        if($marker->radius == ""){
            $marker->radius = null;
        }
        
        // $marker->name = $data['name'];
        $marker->points()->detach();
        
        // Conseguimos los puntos y los unimos uno a uno
        $points = (array) $data['points'];
        
        if($marker->type == "polygon" || $marker->type == "line"){
            // Polygon and lines, have multiple points
            foreach ($data['points'] as $point) {
                $pointAux = new Point();
                $pointAux->fill((array) $point);
                //Juntamos todo
                $marker->points()->save($pointAux);
            }
        } else {
            // Circles and Markers, have one point
            $pointAux = new Point();
            
            if(sizeof($points) == 2){
                // Si viene un punto nuevo (drag) sin id
                $pointAux->fill($points);
                //Juntamos todo
                $marker->points()->save($pointAux);
                
            } else {
                // Si viene un punto existente (rename) con ID
                $pointAux = Point::find($points[0]->id);
                $marker->points()->save($pointAux);
            }
        }

        $marker->update();
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
    public function destroy(Request $r){
        // dd("PRA");
        $data = (array) json_decode($r->layer);
        $marker = Marker::find($data['id']);

        $marker->points()->detach();
        
        Marker::destroy($marker->id);  
    }
}
