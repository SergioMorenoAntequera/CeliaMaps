@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
@endsection


@section('content')

<div class="container mt-5">

    <div class="row">
        <form action="{{route('user.create')}}" method="GET">
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
        <div id="id" class="col-1">
            {{$user->id}}
        </div>
        <div class="col-2 text-left">
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
            <form action="{{route('user.edit', ["user" => $user->id])}}" method="GET">
                @csrf
                @method("GET|HEAD")
                <button class="btn" id="editar" type="submit" value="Editar">
                    <img src="/img/icons/editYellow.png" style="height:2em" alt="">
                </button>
            </form>
        </div>
        <div class="col-1">
            <form action="{{route('user.destroy',$user->id)}}" method="POST">
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
</div>

</div>
@endsection
