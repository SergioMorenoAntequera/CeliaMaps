@extends('layouts/master')

@section('title', 'Celia Maps')

    
@section('content')
    <div class="container mt-5">

    <div class="row">
        <form action= "{{route('user.create')}}" method= "GET">
                @csrf
                @method("GET|HEAD")
                <input type="submit" value="Insertar">
        </form>
</div>

        <div id="cabecera" class="row font-weight-bold">
        <div class="col-1">
            Id
        </div>
        <div class="col-2">
            Nombre
        </div>
        <div class="col-2">
            Email  
        </div>
        <!--
        <div class="col-3">
            Contraseña
        </div>
-->
        <div class="col-2 text-center">
            Tipo
        </div>
        <div class="col-1">
            Modificar
        </div>
        <div class="col-1">
            Eliminar
        </div>
        </div>

        @foreach ($userList as $user)
            <div id="usuario" class="row mt-4">
                <div class="col-1">
                {{$user->id}}
                </div>
                <div class="col-2 text-left" >
                {{$user->name}}
                </div>
                <div class="col-2">
                {{$user->email}}
                </div>
                <!--
                <div class="col-3" style="overflow: hidden">
                {{$user->password}}
                </div>
                -->
                <div class="col-2 text-center">
                {{$user->level}}
                </div>
                <div class="col-1">
                <form action="{{route('user.edit',$user->id)}}" method="GET">
                        @csrf
                        @method("GET|HEAD")
                        <button class="btn" id="editar" type="submit" value="Editar">
                            <img src="/img/icons/editYellow.png" style="height:2em" alt="">
                        </button>
                </form>
                </div>
                <div class="col-1">
                <form action= "{{route('user.destroy',$user->id)}}" method= "POST">
                    @csrf
                    @method("DELETE")
                    <button id="borrar" class="btn" type="submit" value="Borrar">
                        <img src="/img/icons/deleteRed.png" style="height:2em" alt="">
                    </button>
                </form>
                </div>
            </div>
                
        @endforeach

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
    
    // PARA QUE NO SE RECARGUE LA PÁGINA ////////// 
    $("#editar").click(function(e){
        e.preventDefault(); 
    

        var nombre = $("input[name = name]").val();
        var email = $("input[name = email]").val();
        var pass = $("input[name = password]").val();
        var level = $("input[name = level]").val();
        
        
        //var route =  "{{route('user.store')}}";

        $.ajax({
            type:'PUT',
            dataType: 'json',
            url:  "{{route('user.update', $id->id)}}",
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
});




 </script>
    
@endsection



<!--

<script>
$(document).ready(function(){
alert("entrajquery");


$('#borrado').click(function(e){
    e.preventDefault();
});

$('#borrado').click(function borradoUsuario(id, route){

    var route = "{{route('user.destroy', 'idreq')}}".replace('idreq',id)
    console.log(route);
    
    
    $.ajax({              
        url: route,
        type: 'delete',
        data: {
            "_token": "{{ csrf_token() }}",
            },
        success: function(result){
            if(result[status]){
                $("#id" + result['idreq']).remove();
                alert('registro borrado');
            }else {
                modalWindw(result[error],0,null);
                alert('no funciona');
            }
        }   
    });
});  

});


</script>    
-->
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
