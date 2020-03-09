<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
//use App\Http\Requests\formularioUsuarios;

use App\User;

class UserController extends Controller
{  
    // CON EL CONSTRUCTOR IMPEDIMOS QUE ENTRE QUIEN NO ESTÉ LOGUEADO /////////////
    public function __construct(){
    //$this->middleware("auth")->only("create","edit","destroy");
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // LISTADO DE USUARIOS /////////////////////////////////////////////////////////
    public function index()
    {
        $userList = User::all()->sortBy('name');
        return view('user/index',['userList'=>$userList]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // VISTA DEL FORMULARIO DE USUARIOS  /////////////////////////////////////////////
    public function create()
    {
        return view('user/form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * PARA ENCRIPTAR LA CONTRASEÑA SIN UTILIZAR EL REGISTER QUE TRAE LARAVEL POR DEFECTO, HAY QUE
     * ANADIR EN LA CABECERA "use Illuminate\Support\Facades\Hash;" Y EN EL MÉTODO STORE DEL CONTROLADOR
     * AÑADIR EL HASH:MAKE A LA PASSWORD

     */
    // PARA INSERTAR NUEVOS USUARIOS ////////////////////////////////////////////////
    public function store(Request $r)
    {
        $r->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|max:255',
            'level'=>'required',
        ]);

        $user = new User();

        $user->name = $r->name;
        $user->email = $r->email;
        $user->password = Hash::make($r->password);        
        $user->level = $r->level;

        $user->save();

        return Response()->json(['success'=>'registrado con exito']);

        //return redirect()->route("user.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // VISTA DEL FORMULARIO DE USUARIOS PERSONALIZADO PARA LA EDICIÓN ///////////////////////
    public function edit($id)
    {
        $user = User::find($id);

        return view('user/form', array('user'=>$user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * EN EL MÉTODO UPDATE, LE DAMOS A $clave EL VALOR DE LA PASSWORD Y ESTABLECEMOS QUE,
     * SI EL CAMPO PASSWORD ESTÁ VACIO EN EL FORMULARIO DE EDICIÓN DE USUARIO, LA PASSWORD
     * NO SE MODIFICA, ES DECIR, TOMA EL VALOR DE $clave.
     */
    // PARA MODIFICAR USUARIOS ///////////////////////////////////////////////////////////////
    public function update(Request $r,$id)
    {       
        $user = User::find($id);

        $clave = $user->password;    
        //dd($clave);
        $user->name = $r->name;
        $user->email = $r->email;
       if($r->password == null){
            $user->password = $clave;
        }else{
            $user->password = Hash::make($r->password);    ;
        }
        $user->level = $r->level;
        $user->save();       
        //return Response()->json(['success'=>'modificado con exito']);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // BORRADO DE USUARIOS //////////////////////////////////////////////////////////////////
    public function destroy($id)
    {
       $user = User::find($id);
       $user->delete();

       return redirect()->route('user.index');
    }
  
    
}
