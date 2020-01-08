@extends('layouts/master')

@section('title', 'Celia Maps')
    
@section('content')

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th><th>Nombre</th><th>Email</th><th>Contraseña</th><th>Nivel</th><th>accion1</th><th>accion2</th>
        </tr>
    </thead>
    @foreach ($userList as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->password}}</td>
            <td>{{$user->level}}</td>

            <td style = "margin: 0 auto;"> 
                <form action="{{route('user.edit',$user->id)}}" method="GET">
                @csrf
                @method("GET|HEAD")
                <input type="submit" margin=" 0 auto" value="Modificar">
                </form>
            </td>

            <td style = "margin: 0 auto;">
                <form action= "{{route('user.destroy',$user->id)}}" method= "POST">
                @csrf
                @method("DELETE")
                <input type="submit"  value="Borrar">
                </form>
            </td>

        </tr>
        
    @endforeach
</table>

    
@endsection