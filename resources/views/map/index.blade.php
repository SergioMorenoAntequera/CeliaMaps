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

        <!-- La fila para agrupar todas las columnas -->
        <div class="row allElements justify-content-center">
            <!-- Por cada mapa guardado en la base de datos -->
            @foreach ($maps as $map)
                <!--Por cada mapa creamos el cuadrado para las flechas -->
                <div class="oneElement bg-danger col-1">
                    <a href="{{route('map.up', $map->id)}}"> <button>Arriba</button></a>
                    <br>
                    <p id="test"> {{$map->level}} </p>
                    
                    <br>
                    <a href="{{route('map.down', $map->id)}}"> <button>Down</button></a>
                </div>

                
                <!--Por cada mapa creamos el cuadrado para los mapas -->
                <div class="oneElement col-11 text-left">
                    <!-- Aqui sacamos la información de un solo mapa  -->
                    <div class="textElement bg-primary">
                        <!-- Titulo -->
                        <p><b class="text-white text-6">{{$map->title}}</b></p>
                        <!-- Foto/miniatura -->
                        <a href="{{route("map.show", $map->id)}}">
                            <img style="width: 100px" src="{{url("img/miniatures/$map->miniature")}}" alt="Miniatura">
                        </a>
                        <!-- Algunos detalles -->
                        <p class="text-white">{{$map->city}} - {{$map->date}}</p>

                        <!-- Boton para modificar -->
                        <a href="{{route('map.edit', $map->id)}}"> 
                            <button class="cornerUpdateButton bg-secondary">
                                <img src="{{url("img/icons/editWhite.png")}}" alt=""> 
                            </button>
                        </a>
                    
                        <!-- Boton para borrar -->
                        <form method="POST" action="{{route('map.destroy', $map->id)}}">
                            @csrf
                            @method("DELETE")

                            <button class="cornerDeleteButton bg-secondary" type="submit" value="Eliminar">
                                <img src="{{url("img/icons/deleteWhite.png")}}" alt="">    
                            </button>
                        </form>
                    </div>
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