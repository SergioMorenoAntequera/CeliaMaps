<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Map;
use App\Hotspot;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('getAllAjax');
    }

    /**
     * Method that shows all the registers in the database
     *
     * @return View
     */
    public function index(){
        $image = Image::all();
        return view('image.index', ['images'=>$image]);
    }

    /**
     * Method that shows a specific register o our
     * database depending on it's ID
     *
     * @param id
     * @return View
     */
    public function show($id){
        $image = Image::find($id);
        return view('image.show', ['image'=>$image]);
    }

    /**
     * Method that shows the form to create a new register
     *
     * @return View
     */
    public function create(){
        $image = Image::all();
        return view('image.index', ['images'=>$image]);
    }

    /**
     * Method that recieves information in a Request object from the,
     * and then checks and include that information inside our database
     *
     * @param r
     * @return View
     */
    public function store(Request $r){
       $images = $r->file('file');

        if (!is_array($images)) {
            $images = [$imeges];
        }

        if (!is_dir($this->images_path)) {
            mkdir($this->images_path, 0777);
        }

        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];
            $name = $photo->getClientOriginalName();
            $save_name = $name;
            $buscar = ".";
            $posicion = strpos($save_name, $buscar);
            $extension = substr($save_name, $posicion);
            if($extension == ".png" || $extension == ".jpg" ){
                $ruta = public_path('img/resources/miniatures/'.$save_name);
                ImageManagerStatic::make($photo->getRealPath())->resize(300, 300, function($const){
                    $const->aspectRatio();
                })->save($ruta);
                $ext="image";
            }elseif($extension == ".pdf"){
                $ext="document";
            }elseif($extension == ".mp3" || $extension == ".wav" ){
                $ext="audio";
            }
            $photo->move($this->photos_path, $save_name);
            $resource = new Resource();
            $resource->title = $save_name;
            $resource->route = $save_name;
            $resource->type= $ext;
            $resource->save();
        }
        return Response::json([
            'message' => 'Image saved Successfully',
            'id' => $resource->id,
            'type' => $resource->type,
            'route' => $resource->route,
            'title' => $resource->title
        ], 200);
    }
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
     *  Method that shows the gallery, Hotspots Images
     * 
     *  @return View
     */
    public function gallery(){
        $image = Image::all();
        return view('hotspot.gallery', array('images'=>$image));
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

    public function deleteAjax(Request $r, $id){


        Hotspot::destroy($r->id);

        return response()->json([
            'delete' => true,
        ]);
    }

    public function getAllAjax(Request $r){
        $hotspotFound = Hotspot::find($r->id);
        $imagesFound = Array();

        foreach ($hotspotFound->images as $image) {
           array_push($imagesFound, $image->file_name);
        }

        $hotspotFound->images = $imagesFound;

        return response()->json([
            'hotspot' => $hotspotFound,
        ]);
    }

    public function searchAjax(Request $r){
        $imagesFound = Image::where('title', 'LIKE', '%'.$r->text.'%')->get();
        return response()->json([
            'imagesFound' => $imagesFound,
        ]);
    }
}
