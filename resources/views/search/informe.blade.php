@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
@endsection

@section('content')
<h3>informe situación calle</h3>
    <div class="container">
       
        @isset($street)
        <div class="wholePanel">
           <div class="leftPanel width:60%" style="background-color:#FFFACD!important">
                @foreach ($street->maps as $map)
                    <img src="{{$map->image}}" alt="">  
                @endforeach     
           </div>          

      
            <div class="rightPanel">
                <div class="row col-4">
                    nombre calle
                </div>
                        
                <div class="row col-4">
                    {{$street->type->name }} &nbsp; {{$street->name}}
                </div>
                    mapa al que pertenece
                
                    @foreach ($street->maps as $map)
                    <div class="row">
                        {{$map->title}}
                    </div>
                    <div class="row">
                        {{$map->description}} 
                    </div>
                @endforeach
                <div class="row col-2 float-right">
                    <!-- AQUÍ PONGO EL BOTÓN DE PDF -->
                    <a href="{{route('search.download', $street->id)}}">
                        <button type="button" class="btn btn-success">PDF</button>
                    </a>
                </div>

            </div>  
                    
            </div>
        @endisset
    </div> 
    
 @endsection
 