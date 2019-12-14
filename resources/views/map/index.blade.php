@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se enseñan todos los mapas
@endsection

@section('content')
    
    <!-- One div to get all the maps -->
    <div class="container text-center">
        <p>Estaría bien poner aqui una serie de opciones por las cuales se pueda filtrar el mapa que sale</p> 
        <!-- La fila para agrupar todas las columnas -->
        <div class="row allElements justify-content-center">
            <!-- Por cada mapa guardado en la base de datos -->
            @foreach ($maps as $map)
                <!-- Creamos una de las columnas (Si no caben se bajan) -->
                <div class="oneElement col-md-3 p-1">
                    <!-- Aqui sacamos la información de un solo mapa  -->
                    <a href="{{route("map.show", $map->id)}}">
                    <div class="infoElement bg-secondary">
                        <p><b>{{$map->title}}</b></p>
                        <p><img src="{{$map->image}}" alt="Mapa"></p>
                        {{$map->city}} - {{$map->date}} <br>
                    </div>
                    </a>
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