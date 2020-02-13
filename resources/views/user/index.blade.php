@extends('layouts/master')

@section('title', 'Celia Maps')
    
@section('content')
<div class="container">
    <div id="cabecera" class="row">
    <div class="col-1">
        Id
    </div>
    <div class="col-1">
        Nombre
    </div>
    <div class="col-2">
        Email  
    </div>
    <div class="col-3">
        Contraseña
    </div>
    <div class="col-2" style="text-align:center">
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
        <div class="col-1">
        {{$user->name}}
        </div>
        <div class="col-2">
        {{$user->email}}
        </div>
        <div class="col-3" style="overflow: hidden">
        {{$user->password}}
        </div>
        <div class="col-2" style="text-align:center">
        {{$user->level}}
        </div>
        <div class="col-1">
        <form action="{{route('user.edit',$user->id)}}" method="GET">
                @csrf
                @method("GET|HEAD")
                <button class="btn" type="submit" value="Borrar">
                    <img src="/img/icons/editYellow.png" style="height:2em" alt="">
                </button>
                </form>
        </div>
        <div class="col-1">
        <form action= "{{route('user.destroy',$user->id)}}" method= "POST">
                    @csrf
                    @method("DELETE")
                    <button id="borrado" class="btn" type="submit" value="Borrar">
                        <img src="/img/icons/deleteRed.png" style="height:2em" alt="">
                    </button>
                </form>
        </div>
    </div>
        
    @endforeach

</div>

@endsection
@section('scripts')

<script type="text/javascript" src="{{url('/js/user.js')}}">
</script>

@endsection
   
    