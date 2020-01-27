@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se enseñan todos los mapas
@endsection

@section('content')
    
    <!-- One div to get all the maps -->
    <div class="container text-center">
        <p>Estaría bien poner aqui una serie de opciones por las cuales se pueda filtrar el mapa que sale</p>
        <a href="{{route('map.create')}}"> 
            <button> 
                Crear nuevo 
            </button>
        </a>

        <!-- Todos los elementos de la página -->
        <div id="allElements" class="justify-content-center mt-3">

            @foreach ($maps as $map)
                <!-- Cada uno de los elementos de la página -->
                <div id="oneElement{{$map->level}}" class="row mb-4 justify-content-center ">
                    <!-- Columna con el numero y las flechas -->
                    <div class="col-1 bg-primary justify-content-center rounded">
                        <a  class="bUp"><button id="bUp{{$map->level}}"> Up</button></a>
                        <br>
                        <span id="level{{$map->level}}">{{$map->level}}</span>
                        <br>
                        <a class="bDown"><button id="bDown{{$map->level}}">Down</button></a>
                    </div>

                    <!-- Columna con el numero y las flechas -->
                    <div class="col-10 px-3 py-1 ml-4 text-left bg-primary rounded">
                        <!-- Titulo -->
                        <p><b class="text-white text-6">{{$map->title}}</b></p>
                        <!-- Foto/miniatura -->
                        <a style="float: left" href="{{route("map.show", $map->id)}}">
                            <img class="mr-4 ml-5" style="width: 100px" src="{{url("img/miniatures/$map->miniature")}}" alt="Miniatura">
                        </a>
                        <!-- Algunos detalles -->
                        <p>{{$map->city}} - {{$map->date}}</p>
                        <p> {{$map->description}}</p>
                        <div style="clear: both"></div>

                        <!-- Boton para modificar -->
                        <a href="{{route('map.edit', $map->id)}}"> 
                            <button class="cornerUpdateButton bg-secondary">
                                <img src="{{url("img/icons/editWhite.png")}}" alt=""> 
                            </button>
                        </a>
                        
                        <!-- Boton para borrar -->
                        <!-- action="{{route('map.destroy', $map->id)}}" -->
                        <form method="POST" action="{{route('map.destroy', $map->id)}}">
                            @csrf
                            @method("DELETE")

                            <button data-toggle="modal" data-target=".ModalCenter{{$map->id}}" class="cornerDeleteButton bg-secondary" type="submit" value="Eliminar">
                                <img src="{{url("img/icons/deleteWhite.png")}}" alt="">    
                            </button>
                        </form>
                        
                        <!-- Modal para borrar -->
                        <div class="modal fade text-dark ModalCenter{{$map->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                            <span class="d-none">{{$map->level}}</span> 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- FINAL modal para borrar -->

                        <!-- Boton para resize -->
                        <a href="{{route('map.align', $map->id)}}"> 
                            <button class="cornerAlignButton bg-secondary">
                                <img src="{{url("img/icons/align.png")}}" alt=""> 
                            </button>
                        </a>
                    </div><!-- FINAL columna con info del mapa -->
                </div> <!-- FINAL .oneElement -->
            @endforeach
        </div> <!-- FINAL .allEments -->

        
    </div>
@endsection

@section('footer')

    <div>
        footer
    </div>

@endsection

@section('scripts')
    <!------------------------------------ FUNCTIONS WITH AJAX ---------------------------------->
    <!--------------------------------- DELETE, MOVE UP AND DOWN -------------------------------->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script type="text/javascript" src="{{url('/js/MoveMaps.js')}}">
    </script>
@endsection