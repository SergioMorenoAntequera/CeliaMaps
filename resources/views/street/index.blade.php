@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    <!--  Head html  -->
@endsection

{{-- 
@section('content')

    <!-- Maps list to filter street list -->
    <div class="row text-center my-5">
        <div class="col-12">
            <button class="btn btn-primary" >Todas</button>
            @foreach ($maps as $map)
                <button class="btn btn-primary">{{$map->title}}</button>
            @endforeach
        </div>
    </div>

    <!-- Strees list -->
    <div class="container text-left">
        
        <a class="position-fixed" style="bottom:5%;right:5%" href="{{route('street.create')}}"><button class="btn btn-primary">Añadir</button></a>
        
        @foreach ($streets as $street)
            <!-- Street row -->
            <div class="row justify-content-center">
                <a href="{{route('street.show',$street->id)}}" class="w-50 my-1 list-group-item list-group-item-action list-group-item-light">{{$street->type->type}} {{$street->name}}</a>
                <!-- Modify button -->
                <a href="{{route('street.edit', $street->id)}}"><button class="mx-2 mt-3 btn btn-primary">Editar</button></a>
                <!-- Boton para borrar -->
                <form method="POST" action="{{route('street.destroy', $street->id)}}">
                    @csrf
                    @method("DELETE")
                    <input class="mx-2 mt-3 btn btn-primary" type="submit" value="Eliminar"> 
                </form>
            </div>
        @endforeach
    </div>

@endsection
--}}


@section('content')
    
    <!-- One div to get all the maps -->
    <div class="container text-center">
        <div class="row text-center my-5">
            <div class="col-12">
                <button class="btn btn-primary" >Todas</button>
                @foreach ($maps as $map)
                    <button class="btn btn-primary">{{$map->title}}</button>
                @endforeach
            </div>
        </div>
        <a href="{{route('street.create')}}"> 
            <button>Nueva</button> 
        </a>

        <!-- La fila para agrupar todas las columnas -->
        <div class="row allElements justify-content-center">
            <!-- Por cada mapa guardado en la base de datos -->
            @foreach ($streets as $street)
                <div class="oneElement col-8">
                    <div class="textElement bg-primary">
                        <!-- Name -->
                        <a class="text-white" href="{{route("street.show", $street->id)}}">{{$street->type->type}} {{$street->name}}</a>
                        <!-- Maps -->
                        @foreach ($street->maps as $map)
                            <br>
                            <a class="text-white" href="{{route("map.show", $map->id)}}">{{$map->title}} ({{$map->city}} - {{$map->date}})</a>
                        @endforeach
                        <!-- Modify button -->
                        <a href="{{route('street.edit', $street->id)}}"> 
                            <button class="cornerUpdateButton bg-secondary">
                                <img src="{{url("img/icons/editWhite.png")}}" alt=""> 
                            </button>
                        </a>
                        <!-- Remove button -->
                        <form method="POST" action="{{route('street.destroy', $street->id)}}">
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
        <!--  Footer html  -->
    </div>

@endsection
