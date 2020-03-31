@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se enseñan todos los mapas
@endsection

@section('content')
    
    <!-- One div to get all the maps -->
    <div class="container text-center">
        
        <div id="cPopUp" style="z-index: 2; display: none">
            <div class="cornerButton"> X </div>
            <span class="text">
            </span>
        </div>
    
        <!-- Todos los elementos de la página -->
        <div id="allElements">
            @foreach ($maps as $map)
                <!-- Cada uno de los elementos de la página -->
                <div class="wholePanel" style="min-height: 225px">
                    <!-- Columna con el numero y las flechas -->
                    <div class="leftPanel" style="width:10%; position: relative">
                        {{-- Metemos el boton dentro de un enlace para cuando queramos usar una imagen --}}
                        <input class="bUp" type="image" src="{{url("img/icons/arrowUp.svg")}}"/>
                        <div class="content">
                            <span class="mapLevel">{{$map->level}}</span>
                        </div>
                        <input class="bDown" type="image" src="{{url("img/icons/arrowDown.svg")}}"/>
                    </div>

                    <!-- Columna con el resto de información del mapa -->
                    <div class="rightPanel" style="width:90%; position: relative;">
                        <!-- Titulo -->
                        <p><b class="text-6">{{$map->title}}</b></p>
                        <!-- Foto/miniatura -->
                        <a style="float: left" href="{{route("map.show", $map->id)}}">
                            <img class="mr-4 ml-5" style="width: 100px" src="{{url("img/miniatures/$map->miniature")}}" alt="Miniatura">
                        </a>
                        <!-- Algunos detalles -->
                        <p>{{$map->city}} - {{$map->date}}</p>
                        <p> {{$map->description}}</p>

                        <!-- Boton para Borrar  -->
                        <form method="POST" action="{{route('map.destroy', $map->id)}}">
                            @csrf
                            @method("DELETE")

                            <div data-toggle="modal" data-target="#ModalCenter{{$map->id}}" class="deleteCornerButton cornerButton">
                                <img class="center" src="{{url("img/icons/delete.svg")}}" alt=""> 
                            </div>
                        </form>
                        <div id="ModalCenter{{$map->id}}" class="modal fade text-dark" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">¿En serio?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <p>¿Seguro que quieres borrar el mapa {{$map->title}}?</p>
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                        <button iddb="{{$map->id}}" type="button" class="btn btn-danger deleteConfirm" data-dismiss="modal">
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FINAL modal para borrar -->

                        <!-- Boton para modificar -->
                        <a href="{{route('map.edit', $map->id)}}">
                            <div class="cornerButton" style="right: 50px">
                                <img class="center" src="{{url("img/icons/edit.svg")}}" alt=""> 
                            </div>
                        </a><!-- FIN Boton para modificar -->

                        {{-- Boton para alinear los mapas  --}}
                        <a href="{{route('map.align', $map->id)}}">
                            @if (empty($map->tlCornerLatitude))
                                <div style="right: 100px" class="cornerButton bg-danger">
                                    <img class="center" src="{{url("img/icons/align.svg")}}" alt=""> 
                                </div>
                                <b class="text-warning"> Mapa no alineado </b>
                                
                            @else
                                <div style="right: 100px" class="cornerButton">
                                    <img class="center" src="{{url("img/icons/align.svg")}}" alt=""> 
                                </div>
                            @endif
                            <div style="clear: both"></div>
                        </a>
                    </div><!-- FINAL columna con info del mapa -->
                </div> <!-- FINAL .oneElement -->
            @endforeach
        </div> <!-- FINAL .allEments -->
    </div>

    <a href="{{route('map.create')}}">
    <div id="addButton">
        <img class="center" src="{{url("img/icons/plus.svg")}}">
    </div>
    </a>
@endsection

@section('footer')
    <div>
        footer
    </div>
@endsection

@section('scripts')
    <script src="{{url('js/cPopUp.js')}}"></script>
    <!------------------------------------ FUNCTIONS WITH AJAX ---------------------------------->
    <!--------------------------------- DELETE, MOVE UP AND DOWN -------------------------------->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script> var token = '{{csrf_token()}}';</script>
    <script type="text/javascript" src="{{url('/js/moveAndDeleteMaps.js')}}"></script>
@endsection