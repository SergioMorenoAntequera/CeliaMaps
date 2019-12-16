@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se enseñan todos los mapas
@endsection

@section('content')
    
    <!-- One div to get all the maps -->
    <div class="container text-center">
        <p>Estaría bien poner aqui una serie de opciones por las cuales se pueda filtrar el mapa que sale</p>
        <a href="{{route('map.create')}}"> <button> Crear nuevo </button> </a>
        <!-- La fila para agrupar todas las columnas -->
        <div class="row allElements justify-content-center">
            <!-- Por cada mapa guardado en la base de datos -->
            @foreach ($maps as $map)
                <!-- Creamos una de las columnas (Si no caben se bajan) -->
                <div class="oneElement col-md-3 p-1">
                    <!-- Aqui sacamos la información de un solo mapa  -->
                    <div class="textElement bg-secondary">
                        <p><b>{{$map->title}}</b></p>
                        <a href="{{route("map.show", $map->id)}}">
                            <p><img src="{{$map->image}}" alt="Mapa"></p>
                        </a>
                        <p>{{$map->city}} - {{$map->date}}</p>

                        <!-- Boton para modificar -->
                        <a href="{{route('map.edit', $map->id)}}"> 
                            <button> Editar </button>
                        </a>
                    
                        <!-- Boton para borrar -->
                        <form method="POST" action="{{route('map.destroy', $map->id)}}">
                            @csrf
                            @method("DELETE")

                            <input type="submit" value="Eliminar"> 
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