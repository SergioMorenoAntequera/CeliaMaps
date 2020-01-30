@extends('layouts/master')

@section('title', 'Celia Maps')
    
@section('content')

<div class="insertar float-right" style="padding: 80px 80px 15px 0px">
        <form action= "{{route('user.create')}}" method= "GET">
                @csrf
                @method("GET|HEAD")
                <input type="submit" value="Insertar">
        </form>
</div>

<table class="table table-hover text-white">
    <thead>
        <tr>
            <th>Id</th><th>Nombre</th><th>Email</th><th>Contraseña</th><th>Nivel</th><th>accion1</th><th>accion2</th>
        </tr>
    </thead>
    @foreach ($userList as $user)
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->password}}</td>
            <td>{{$user->level}}</td>

            <td style = "margin: 0 auto;"> 
                <form action="{{route('user.edit',$user->id)}}" method="GET">
                @csrf
                @method("GET|HEAD")
                <button class="btn" type="submit" value="Borrar">
                    <img src="/img/icons/editYellow.png" style="height:2em" alt="">
                </button>
                </form>
            </td>

            <td style = "margin: 0 auto;">
                <form action= "{{route('user.destroy',$user->id)}}" method= "POST">
                    @csrf
                    @method("DELETE")
                    <button id="borrado" class="btn" type="submit" value="Borrar">
                        <img src="/img/icons/deleteRed.png" style="height:2em" alt="">
                    </button>
                </form>
            </td>

        </tr>
        
    @endforeach
</table>


@endsection
                   
    