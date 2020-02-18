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
        <div id="allElements" class="justify-content-center mt-3 text-white">
            @foreach ($maps as $map)
                <!-- Cada uno de los elementos de la página -->
                <div class="wholePanel">
                    <!-- Columna con el numero y las flechas -->
                    <div style="width:10%; position: relative" class="leftPanel">
                        {{-- Metemos el boton dentro de un enlace para cuando queramos usar una imagen --}}
                        <input class="bUp" type="image" src="{{url("img/icons/arrowUp.svg")}}"/>
                        <div class="content">
                            <span class="mapLevel">{{$map->level}}</span>
                        </div>
                        <input class="bDown" type="image" src="{{url("img/icons/arrowDown.svg")}}"/>
                    </div>

                    <!-- Columna con el resto de información del mapa -->
                    <div style="width:90%; position: relative;" class="rightPanel">
                        <!-- Titulo -->
                        <p><b class="text-6">{{$map->title}}</b></p>
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
                            <div class="cornerButton" style="right: 50px">
                                <img class="center" src="{{url("img/icons/editWhite.png")}}" alt=""> 
                            </div>
                        </a>

                        <!-- Boton para Borrar  -->
                        <form method="POST" action="{{route('map.destroy', $map->id)}}">
                            @csrf
                            @method("DELETE")

                            <div data-toggle="modal" data-target="#ModalCenter{{$map->id}}" class="deleteCornerButton cornerButton">
                                <img class="center" src="{{url("img/icons/deleteWhite.png")}}" alt=""> 
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
                                            <span class="d-none">{{$map->level}}</span> 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- FINAL modal para borrar -->
                            
                        <a href="{{route('map.align', $map->id)}}">
                            @if (empty($map->tlCornerLatitude))
                                <div style="right: 100px" class="cornerButton bg-danger">
                                    <img class="center" src="{{url("img/icons/align.png")}}" alt=""> 
                                </div>
                                <b class="text-warning"> Mapa no alineado, no se mostrará en página principal </b>
                            @else
                                <div style="right: 100px" class="cornerButton">
                                    <img class="center" src="{{url("img/icons/align.png")}}" alt=""> 
                                </div>
                            @endif 
                        </a>
                        {{-- <form method="POST" action="{{route('map.destroy', $map->id)}}">
                            @csrf
                            @method("DELETE")

                            <button data-toggle="modal" data-target=".ModalCenter{{$map->id}}" class="cornerDeleteButton bg-secondary" type="submit" value="Eliminar">
                                <img src="{{url("img/icons/deleteWhite.png")}}" alt="">    
                            </button>
                        </form>
                        
                        <!-- Modal para borrar -->
                        

                        <!-- Boton para alinear -->
                        <a href="{{route('map.align', $map->id)}}">
                            @if (empty($map->tlCornerLatitude))
                                <button class="cornerAlignButton bg-danger">
                                    <img src="{{url("img/icons/align.png")}}" alt=""> 
                                </button>
                                <b class="text-warning"> Mapa no alineado, no se mostrará en página principal </b>
                            @else
                                <button class="cornerAlignButton bg-secondary">
                                    <img src="{{url("img/icons/align.png")}}" alt=""> 
                                </button>
                            @endif 
                        </a> --}}
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
    <script type="text/javascript" src="{{url('/js/MoveAndDeleteMaps.js')}}">
    </script>
    
@endsection