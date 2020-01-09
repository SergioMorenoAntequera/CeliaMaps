@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')    
@endsection

@section('content')

<br>
    <div class="container w-50 text-center  text-dark">
    @isset($user)
        <div class="card">
            <div class="card-header">
              MODIFICAR USUARIOS
            </div>

            <div class="card-body">
               
                <form class="form-inline" action="{{route('user.update', $user->id)}}" method="POST">
                @method("PUT")
    @else
                    <div class="card">
                        <div class="card-header">
                            INSERTAR USUARIOS
                        </div>

                        <div class="card-body">
                            <form action="{{route('user.store')}}" method="POST">
    @endisset
                            @csrf
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" value="{{$user->name??''}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="{{$user->email??''}}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" value="{{$user->password??''}}">
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <input type="text" name="level" id="level" value="{{$user->level??''}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>        
        </div>
    </div>                    
@endsection
