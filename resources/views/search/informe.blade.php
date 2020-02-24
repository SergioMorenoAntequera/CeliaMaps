@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')

@endsection

@section('content')
<h3 style="text-align:center;">Informe situación calle</h3>
<div class="container">

    @isset($street)
    <div class="wholePanel">
        <!-- PANEL IZQUIERDO, POR  AHORA NO INCLUIMOS IMAGEN, MÁS QUE NADA, PORQUE NO CABE //////////////////////////////////////////// -->
        <div class="leftPanel" style="width:60%;">
            Aquí iba el mapa, pero no cabe.....
            @foreach ($street->maps as $map)
            <!-- <img src="/img/maps/{{$map->image}}" alt="..."> -->
            @endforeach
        </div>
        <!-- FIN DE PANEL IZQUIERDO //////////////////////////////////////////// -->

        <!-- PANEL DERECHO //////////////////////////////////////////// -->
        <div class="rightPanel">
            <h4>Impresión de Informes</h4>
            <div>
                {{$street->type->name }} {{$street->name}}
            </div>
           
            <div>
                @foreach($street->maps as $map)
                    <div>
                        <h5>Se encuentra en el mapa:</h5>
                    </div> 
                    <div>
                        {{$map->title}}
                    </div> 
                    <div>
                        <h5>Descripción del mapa</h5>
                    </div> 
                    <div>
                        {{$map->description}}
                    </div> 
                    
                @endforeach
            </div>
        <!-- BOTONES //////////////////////////////////////////// -->
            <div class="row col-2 float-left">
                <!-- sólo de prueba, para visualizar el informe -->
                <a href="{{route('search.show', $street->id)}}">
                    <button type="button" class="btn btn-success">ver</button>
                </a>
            </div>


            <div class="row col-2 float-right">
                <!-- AQUÍ PONGO EL BOTÓN DE PDF -->
                <a href="{{route('search.download', $street->id)}}">
                    <button type="button" class="btn btn-success">PDF</button>
                </a>
            </div>
        <!-- FIN DE BOTONES  //////////////////////////////////////////// -->
     
        </div>
        <!-- FIN DE PANEL DERECHO //////////////////////////////////////////// -->
    </div>
    @endisset
</div>

@endsection