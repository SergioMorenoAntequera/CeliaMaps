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
               
                <form class="form-inline" action="{{route('user.update', $user->id)}}" method="POST">
                @method("PUT")
    @else
                   
                        <div class="card-header">
                            INSERTAR USUARIOS
                        </div>

                        <div class="card-body">
                            <form action="{{route('user.store')}}" method="POST">
    @endisset
                            @csrf
                            <div class="row">
                                <div class="col">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$user->name??''}}">
                            </div>
                            </div>
                            <div class="col">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{$user->email??''}}">
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col">

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" value="{{$user->password??''}}">
                            </div>
                            </div>
                            <div class="col">
                            <div class="form-group">
                                <label for="level">Level</label>
                                <input type="text" class="form-control" name="level" id="level" value="{{$user->level??''}}">
                            </div>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                    
                             
                    
                </form>
                <div class="inicio">
                            <form action="{{route('user.index')}}" method="GET">
                             @csrf 
                             @method("GET|HEAD")
                                <input type="submit" class="btn btn-info" name="inicio" value="Inicio Usuarios">
                            </form>
                            </div>  
                        </div>    
            </div>        
        </div>
    </div>   

            
@endsection
