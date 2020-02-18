@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
   
@endsection

@section('content')
<div lass="container">
    edjdjdjlkfbigogbire
    @isset($street)
        <div class="row col-7">
            nombre calle
        </div>
           
        <div class="row col-7">
           <!--
            <div> {{--
                @foreach ($street->type as $type)
                {{$type->name}}
                @endforeach  
                --}}
            </div>
        -->
            <div>
                {{$street->street_name}}
            </div>
            
        </div>
           
        <div class="row col-7">
            nombre mapa
        </div>
       <!--
        <div class="row">
             {{--
            @foreach ($Street->maps as $map)
            {{$map->id}}
            @endforeach
             --}}
        </div>
    -->
</div>

<div class="row col-9 float-right">
    <!-- AQUÍ PONGO EL BOTÓN DE PDF -->
    <a href="{{route('search.download')}}">
        <button type="button" class="btn btn-primary">pdf</button>
        </a>
</div>
    @endisset
</div>

@endsection
