@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
@endsection

@section('content')

<div class="container text-center">
    <div id="allelements">       
        @foreach ($userList as $user)
            <div class="wholePanel" style="height:13%">
                <div class="leftPanel" style="width:10%; position: relative"> 
                    <img src="/img/icons/userWhite.png" width="45%" alt="" class="img-fluid pt-1">
                    <p><strong><span class="userId text-4 pb-2">{{$user->id}}</span></strong></p>
                </div>
                <div class="rightPanel" style="width:90%; position: relative;">
                    <!-- nombre usuario -->
                    <p><b class="text-4">{{$user->name}}</b><br>
                        {{$user->email}}
                    </p>
                    <!-- botones -->
                     <!-- modificar -->
                    <form action="{{route('user.edit', ["user" => $user->id])}}" method="GET">
                        @csrf
                        @method("GET|HEAD")
                        <button class="btn" id="editar" type="submit" value="Editar">
                            <div class="cornerButton" style="right: 50px">
                                <img class="center" src="{{url("img/icons/edit.svg")}}" alt=""> 
                            </div>
                        </button>
                    </form>
                     <!-- borrar -->
                    <form action="{{route('user.destroy',$user->id)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button id="borrar" class="btn" type="submit" value="Borrar">
                            <div class="deleteCornerButton cornerButton">
                                <img class="center" src="{{url("img/icons/delete.svg")}}" alt=""> 
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>    
</div>

@endsection
