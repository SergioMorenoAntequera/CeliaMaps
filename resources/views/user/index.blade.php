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
                    <div id="datos" style="pt-2">
                        <strong>{{$user->name}}</strong>
                        <br>
                        {{$user->email}}
                    </div>
                    <!-- botones -->

                      <!-- Boton para Borrar con modal incluida -->
                      <form method="POST" action="{{route('user.destroy',$user->id)}}">
                        @csrf
                        @method("DELETE")

                        <div data-toggle="modal" data-target="#ModalCenter{{$user->id}}" class="deleteCornerButton cornerButton">
                            <img class="center" src="{{url("img/icons/delete.svg")}}" alt=""> 
                        </div>
                    </form>
                    <div id="ModalCenter{{$user->id}}" class="modal fade text-dark" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">¿Está seguro?</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <p>Va a borrar el usuario {{$user->name}}?</p>
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                    <button iddb="{{$user->id}}" type="button" class="btn btn-danger deleteConfirm" data-dismiss="modal">
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FINAL modal para borrar -->
                     <!-- modificar -->
                        <a href="{{route('user.edit', ["user"=>$user->id])}}">
                            <div class="cornerButton" style="right:50px">
                                <img class="center" src="{{url("img/icons/edit.svg")}}" alt="">
                            </div>
                        </a>
                   
                </div>
            </div>
        @endforeach
    </div>    
</div>
<a href="{{route('user.create')}}">
    <div id="addButton">
        <img class="center" src="{{url("img/icons/plus.svg")}}">
    </div>
    </a>

@endsection
