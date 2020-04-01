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
                Rellene este fomulario para configurar su apliación.
              </div>
              <img src="{{url('/img/icons/userWhite.png')}}" width="50%" alt="" class="img-fluid">
              </div>
        </div>
        <div class="rightPanel">

                <form action="{{route('install.createFile')}}" method="POST">

                    @csrf

                  <!-- LA BASE DE DATOS  -->
                  <!--
                  <div id="filacero" class="row">
                      <div class="col">
                          <div class="form-group">
                          <label for="host">HOST</label>
                              <input type="text" class="form-control"  name="host" id="host" required>
                          </div>
                      </div>
                  </div>
            <div id="primerafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="appUrl">APP_URL</label>
                        <input type="text" class="form-control"  name="appUrl" id="appUrl" required>
                    </div>
                </div>
            </div>
            <div id="segundafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="dbConnection">DB_CONNECTION</label>
                        <input type="text" class="form-control" name="dbConnection" id="dbConnection" required>
                    </div>
                </div>
            </div>
            <div id="tercerafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="dbPort">DB_PORT</label>
                        <input type="text" class="form-control" name="dbPort" id="dbPort" required>
                    </div>
                </div>
            </div>
            <div id="cuartafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="namedb">DB_NAME</label>
                        <input type="text" class="form-control" name="namedb" id="namedb" required>
                    </div>
                </div>
            </div>
            <div id="quintafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="userdb">DB_USER</label>
                        <input type="text" class="form-control" name="userdb" id="userdb" required>
                    </div>
                </div>
            </div>
        -->
            <div id="sextafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="passdb">DB_PASSWORD</label>
                        <input type="text" class="form-control" name="passdb" id="passdb" required>
                    </div>
                </div>
            </div>

            <!-- EL USUARIO  -->
            <!--
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
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                </div>
            </div>
            <div id="novenafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="password2">CONFIRMAR CONTRASEÑA</label>
                        <input type="password" class="form-control" name="password2" id="password2" required>
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
        -->
            <input type='submit' value='Aceptar' class="btn-success">

          </form>

@endsection
