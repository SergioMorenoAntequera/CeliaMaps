@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
@endsection

@section('content')


<div class="container">
    <div class="wholePanel">
        <div class="leftPanel widht:40%">

            <div class="content">
              <div class="titulo">
                Rellene este fomulario para introducir el usuario administrador.
              </div>
              <!--<img src="{{url('/img/icons/userWhite.png')}}" width="50%" alt="" class="img-fluid">-->
              </div>
        </div>
        <div class="rightPanel">

                <form action="{{route('install.storeUser')}}" method="POST">

                    @csrf

            <div id="septimafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">NOMBRE USUARIO ADMINISTRADOR</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                </div>
            </div>
            <div id="octavafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="password">CONTRASEÑA USUARIO</label>
                        <input type="password" class="form-control" name="password" id="password" autocomplete="off" required>
                    </div>
                </div>
            </div>
            <div id="novenafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="password_confirmation">CONFIRMAR CONTRASEÑA</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" autocomplete="off" required>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
            <div id="decimafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="email">EMAIL USUARIO</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <button type="submit" id="crearEnv" class="btn btn-success">Finalizar</button>
                </div>
            </div>

             <!-- SE AÑADE EL BOTÓN "X" PARA SALIR DEL FORMULARIO
                    <a href="{{route('user.index')}}">
                        <div class="cornerButton">
                            <img class="center" src="{{url("img/icons/close.svg")}}" alt="">
                        </div>
                    </a>
            -->
          </form>

@endsection
