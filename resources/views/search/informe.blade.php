@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')

@endsection

@section('cdn')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
@endsection

@section('content')
<h3 style="text-align:center;" class="my-3">Informe de situación</h3>
<div class="container">

    @isset($street)
    <div class="wholePanel">
        <!-- PANEL IZQUIERDO, POR  AHORA NO INCLUIMOS IMAGEN, MÁS QUE NADA, PORQUE NO CABE //////////////////////////////////////////// 
        <div class="leftPanel" style="width:60%;">            
            
        </div>
         FIN DE PANEL IZQUIERDO //////////////////////////////////////////// -->

        <!-- PANEL DERECHO //////////////////////////////////////////// -->
        <div class="rightPanel" style="width:100%;">
            <div>
                <h2>
                    {{$street->type->name }} {{$street->name}}
                </h2>
            </div>
            <div>
                <h5>Se encuentra
                @if (count($street->maps) > 1)
                    en los siguientes mapas
                @else
                    en el mapa
                @endif
                : </h5>
            </div> 
            <br>
            <div>
                @foreach($street->maps as $map)
                    <div>
                        <h5>
                            {{$map->title}}
                        </h5>
                    </div> 
                    <div>
                        <p>{{$map->description}}</p>
                    </div> 
                    
                @endforeach
            </div>
            
            {{-- Botón librería PDF
        <!-- BOTONES //////////////////////////////////////////// -->
            <div class="row col-2 float-left">
                <!-- sólo de prueba, para visualizar el informe -->
                <a href="{{route('search.show', $street->id)}}">
                    <button type="button" class="btn btn-success">ver</button>
                </a>
            </div>
            --}}

            <br>

            <div class="row col-2">
                <!-- AQUÍ PONGO EL BOTÓN DE PDF -->
                <button id="btn-pdf" type="button" class="btn btn-success">PDF</button>
            </div>
        <!-- FIN DE BOTONES  //////////////////////////////////////////// -->
     


        <div id="map" style="width:100%;height: 480px;"></div>
        <script>
            map = L.map('map', {
                minZoom: 10,  //Dont touch, recommended
                zoomControl: false,
            });
            // LATITUD Y LONGITUD
            map.setView([{{$street->points[0]->lat}}, {{$street->points[0]->lng}}], 17);
            let mapTile = L.tileLayer.wms('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19, //Dont touch, max zoom 
            });
            map.addLayer(mapTile);
            let markerIcon = L.icon({
                iconUrl: "{{url('img/icons/token.svg')}}",
                iconSize:     [40, 100],
                iconAnchor:   [15,60],
            });
            // LATITUD Y LONGITUD
            let marker = L.marker([{{$street->points[0]->lat}},{{$street->points[0]->lng}}],{icon:markerIcon});
            marker.addTo(map);
            marker.on("click", function(){
                map.setView([{{$street->points[0]->lat}}, {{$street->points[0]->lng}}]);
            })

            $("#btn-pdf").click(function(){
                $(this).parent().hide();
                window.print();
                $(this).parent().show();
            });
        </script>
    </div>
    
    {{--    Imagenes mapas 
    <br>
    <!-- FIN DE PANEL DERECHO //////////////////////////////////////////// -->
    <div class="rightPanel" style="width:100%;">       
        @foreach ($street->maps as $map)
        <img src="/img/maps/{{$map->image}}" alt="..." style="width: 75%;">             
        @endforeach
    </div>
    --}}
    </div>
    @endisset
</div>

@endsection