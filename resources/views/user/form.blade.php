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
                                    <input type="text" class="form-control" name="name" id="name" value="{{$user->name??''}}" required>
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
                            <div class="col">
                                <!-- SI EXISTE USUARIO MOSTRAMOS EL CAMPO CONTRASEÑA VACIO -->
                                @isset($user)
                                <div class="form-group">
                                     <label for="password">rellenar solo si desdea modificar contraseña</label>
                                    <input type="password" class="form-control" name="password" id="password" value="">
                                </div>
                                <!-- COMPORTAMIENTO DEL FORMULARIO SI INSERTAMOS NUEVO USUARIO -->
                                @else
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" value="{{$user->password??''}}" required>
                                </div>
                            </div>


                            @endisset
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <input type="text" class="form-control" name="level" id="level" value="{{$user->level??''}}" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div id="tercerafila" class="row">
                    <div class="col">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
            </form>
            <div class="col">

                <div class="inicio">
                    <form action="{{route('user.index')}}" method="GET">
                        @csrf
                        @method("GET|HEAD")
                        <input type="submit" class="btn btn-info" name="inicio" value="Volver">
                    </form>
                </div>









            </div>
        </div>
    </div>
</div>


@endsection