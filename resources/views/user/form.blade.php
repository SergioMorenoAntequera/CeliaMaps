@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
@endsection

@section('content')

<br>
<div class="container w-50 text-center  text-dark">

    <div class="card">
        @isset($user)
            <div class="card-header">
                MODIFICAR USUARIOS
            </div>

            <div class="card-body">

                <form class="" action="{{route('user.update', $user->id)}}" method="POST">
                    @method("PUT")

        @else

            <div class="card-header">
                INSERTAR USUARIOS
            </div>

            <div class="card-body">
                <form action="{{route('user.store')}}" method="POST">
                    @endisset
                        @csrf
                            <div id="primerafila" class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" class="form-control"  name="name" id="name" value="{{$user->name??''}}" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{$user->email??''}}" required>
                                    </div>
                                </div>
                            </div>

                            <div id="segundafila" class="row">
                                <div class="col-6">
                                    <!-- SI EXISTE USUARIO MOSTRAMOS EL CAMPO CONTRASEÑA VACIO -->
                                    @isset($user)
                                        <div class="form-group">
                                            <label for="password">Contraseña</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="rellenar solo si desdea modificar" value="">
                                        </div>
                                    <!-- COMPORTAMIENTO DEL FORMULARIO SI INSERTAMOS NUEVO USUARIO -->
                                    @else
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password"  class="form-control" name="password" id="password" value="{{$user->password??''}}" required>
                                        </div>
                                    @endisset
                                </div>                                    
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="level">Level</label>
                                        <input type="text" class="form-control" name="level" id="level" value="{{$user->level??''}}" required>
                                    </div>
                                </div>
                            </div>
               
                            <div id="tercerafila" class="row">

                                @isset($user)

                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" id="modificarUsuario" class="btn btn-primary">Modificar</button>
                                    </div>
                                </div>
                                @else
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" id="enviarUsuario" class="btn btn-primary">Enviar</button>
                                    </div>
                                </div>
                                @endisset
                </form>
                                <div class="col">
                                    <div class="inicio">
                                        <form action="{{route('user.index')}}" method="GET">
                                            @csrf
                                                @method("GET|HEAD")
                                                    <input type="submit"  class="btn btn-info" name="inicio" value="Volver">
                                        </form>
                                    </div>
                
                                </div>
                            </div>
            </div>
    </div>
</div>

@endsection

@section('scripts')



<script  type="text/javascript">
  
    
$(document).ready(function(){

    function campoVacio(){
        $("#name").val('');
        $("#email").val('');
        $("#password").val('');
        $("#level").val('');
    }

    //EL TOKEN, QUE NO FUNCIONABA SIN ÉL ////////////
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // AÑADIR USUARIOS CON AJAX ///////////////////////////////////
    $("#enviarUsuario").click(function(e){
        // PARA QUE NO SE RECARGUE LA PÁGINA ////////// 
        e.preventDefault(); 
    

        var nombre = $("input[name = name]").val();
        var email = $("input[name = email]").val();
        var pass = $("input[name = password]").val();
        var level = $("input[name = level]").val();
        
        
        //var route =  "{{route('user.store')}}";

        $.ajax({
            type:'POST',
            dataType: 'json',
            url:  "{{route('user.store')}}",
            // al pasar los datos del nuevo usuario se hace por par nombre del campo en la base
            // de datos : nombre de la variable que hemos declarado con el campo.
            // y se pasan en el mismo orden en el que están en la base de datos
            data: {name:nombre, email:email, password:pass, level:level},
            success: function(data){
                //mostrarMensaje(data.mensaje);
                //alert("no se por donde voy");
                campoVacio();
            }
            
        });

    });

     // MODIFICAR USUARIOS CON AJAX
     $("#modificarUsuario").click(function(e){
          e.preventDefault(); 
      
  
          var nombre = $("input[name = name]").val();
          var email = $("input[name = email]").val();
          var pass = $("input[name = password]").val();
          var level = $("input[name = level]").val();
        
  
          $.ajax({
              type:'PUT',
              dataType: 'json',
              url:  "{{route('user.update', $r->id)}}",
              
              // al pasar los datos del nuevo usuario se hace por par nombre del campo en la base
              // de datos : nombre de la variable que hemos declarado con el campo.
              // y se pasan en el mismo orden en el que están en la base de datos
              data: {name:nombre, email:email, password:pass, level:level},
              success: function(data){
                  //mostrarMensaje(data.mensaje);
                  //alert("no se por donde voy");
                  campoVacio();
              }
              
          });
  

});




</script>
    
@endsection