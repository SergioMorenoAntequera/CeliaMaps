@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
@endsection

@section('content')

<div class="container">
    <div class="wholePanel">
        <div class="leftPanel widht:40%">
            
            <div class="content">
                @isset($user)
                    <div class="titulo" >
                        Modificar Usuarios
                    </div>
            @else
                    <div class="titulo">
                        Insertar Usuarios
                    </div>
            @endisset

                <img src="{{url('/img/icons/userWhite.png')}}" width="50%" alt="" class="img-fluid">
            </div>            
        </div>
        <div class="rightPanel">
            <!-- SI EXISTE EL USUARIO UTILIZAMOS ESTE FORMULARIO -->
            @isset($user)
                <form class="" action="{{route('user.update', ["user" => $user->id])}}" method="POST">
                @method("PUT")
            <!-- SI NO EXISTE EL USUARIO UTILIZAMOS ESTE FORMULARIO -->
            @else 
                <form action="{{route('user.store')}}" method="POST">                
            @endisset

            @csrf
            <div id="filacero" class="row">
                <div class="col">
                    <div class="form-group">
                        
                        <input type="hidden" class="form-control"  name="idUsuario" id="id" value="{{$user->id??''}}">
                    </div>
                </div>
            </div>
            <div id="primerafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control"  name="name" id="name" value="{{$user->name??''}}" required>
                        <div class="error text-danger"></div>
                    </div>
                </div>
            </div>
            <div id="segundafila" class="row">            
                <div class="col">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{$user->email??''}}" required>
                        <div class="error text-danger"></div>
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
                            <div class="error text-danger"></div>
                        </div>
                    <!-- COMPORTAMIENTO DEL FORMULARIO SI INSERTAMOS NUEVO USUARIO -->
                    @else
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password"  class="form-control" name="password" id="password" value="{{$user->password??''}}" required>
                            <div class="error text-danger"></div>
                        </div>
                    @endisset
                </div>
            </div>
                <div id="tercerafila" class="row">                                   
                <div class="col-2">
                    <div class="form-group">
                        <label for="level">Level</label>
                        <input type="text" class="form-control" name="level" id="level" value="{{$user->level??''}}" required>
                        <div class="error text-danger"></div>
                    </div>
                </div>
            </div>
            
            <div id="cuartafila" class="row">

                @isset($user)

                <div class="col">
                    <div class="form-group">
                        <button type="submit" id="modificarUsuario" class="btn btn-success">Modificar</button>
                    </div>
                </div>
                @else
                <div class="col">
                    <div class="form-group">
                        <button type="submit" id="enviarUsuario" class="btn btn-success">Enviar</button>
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

            /*
            al pasar los datos del nuevo usuario se hace por par nombre del campo en la base
            de datos : nombre de la variable que hemos declarado con el campo.
            y se pasan en el mismo orden en el que están en la base de datos
            */
            data: {name:nombre, email:email, password:pass, level:level},
            
            success: function(){
                //$("#respuesta").text();
                //mostrarMensaje(data.mensaje);
                alert("Usuario insertado con éxito");
                campoVacio();
            },
            error: function(e){
                // Número de errores contenidos en la respuesta JSON
                $('.error')[0].innerHTML = e.responseJSON.errors.name;
                $('.error')[1].innerHTML = e.responseJSON.errors.email;
                $('.error')[2].innerHTML = e.responseJSON.errors.password;
                $('.error')[3].innerHTML = e.responseJSON.errors.level;

            }    
                    
        });
    });

});
</script>

    
@endsection