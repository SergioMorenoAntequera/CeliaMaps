@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    <!--  Head html  -->
@endsection

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

@section('footer')

    <div>
        <!--  Footer html  -->
    </div>

@endsection
