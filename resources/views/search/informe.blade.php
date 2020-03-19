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
                        Con el nombre 
                        @foreach ($street->maps as $alternativa)
                        <h6>
                             {{$alternativa->pivot->alternative_name}}
                             
                        </h6>                        
                        @endforeach
                        
                    </div>
                    <!-- POR AHORA NO MOSTRAREMOS LA DESCRIPCIÓN DEL MAPA
                    <div>
                        
                        {{--<p>{{$map->description}}</p> --}} 
                    </div> 
                    -->
                @endforeach
            </div> 
            <br>
            <!-- AQUÍ PONGO EL BOTÓN DE OBSERVACIONES -->
            <div class="row col-2 float-left">
            <button id="botonObservaciones" type="button" class="btn btn-success" data-toggle="modal" data-target="#cuadroObservaciones">
                Observaciones
              </button>
            </div>                
            <!-- FIN DE BOTÓN DE OBSERVACIONES -->

            <!-- MODAL PARA INCLUIR OBSERVACIONES -->

            <div class="modal fade" id="cuadroObservaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="tituloModal">Escriba un breve informe</h5>
                      <button type="button" class="close text-success" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        
                      <input id="observaciones" class="col-12" style="border:0;" onkeyup="texto()">
                   
                      <script>
                          function texto(){
                              parrafo = document.getElementById('observaciones').value;
                              document.getElementById('contenido').innerHTML = ' ' + parrafo;
                          }
                      </script>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal">Aplicar</button>
                      <!-- <button type="button" class="btn btn-primary">Aplicar</button> -->
                    </div>
                  </div>
                </div>
              </div>

            <!-- FIN DE MODAL PARA INCLUIR OBSERVACIONES -->

             <!-- AQUÍ PONGO EL BOTÓN DE PDF -->
            <div class="row col-2 float-right">               
                <button id="btn-pdf" type="button" class="btn btn-success">PDF</button>
            </div>
            <!-- FIN DE BOTÓN DE PDF -->

             <!-- SE AÑADE EL BOTÓN "X" PARA SALIR DEL INFORME -->
             <a href="{{route('search.index')}}">
                <div class="cornerButton">
                    <img class="center" src="{{url("img/icons/close.svg")}}" alt=""> 
                </div>
            </a>
            <!-- FIN DE BOTÓN "X" PARA SALIR DEL INFORME -->

        <!-- FIN DE BOTONES  //////////////////////////////////////////// -->
            <br>
            <br>

    <!-- DIV QUE CONTIENE EL MAPA CON LA SITUACIÓN DE LA CALLE BUSCADA ///////////////////// -->            
        <div id="map" style="width:100%;height: 480px;"></div>

        <!-- DIV QUE CONTIENE EL EDITOR DE TEXTO -->

        <div id="contenido">

        </div>
       
        

        <!--SCRIPT QUE NOS MUESTRA LA SITUACIÓN DE LA CALLE EN EL MAPA ////////////////////// -->
        <script>
            map = L.map('map', {
                minZoom: 10,  //Dont touch, recommended
                zoomControl: false,
            });
            /* LATITUD Y LONGITUD */
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
            /* LATITUD Y LONGITUD */
            let marker = L.marker([{{$street->points[0]->lat}},{{$street->points[0]->lng}}],{icon:markerIcon});
            marker.addTo(map);
            marker.on("click", function(){
                map.setView([{{$street->points[0]->lat}}, {{$street->points[0]->lng}}]);
            })

            $("#btn-pdf").click(function(){
                $(this).parent().hide();
                $("#botonObservaciones").hide();
                window.print();
                $(this).parent().show();
                $("#botonObservaciones").show();
            });
           
        </script>
        

    </div>
    
    
    <br>
    <!-- FIN DE PANEL DERECHO //////////////////////////////////////////// -->
    {{--    Imagenes mapas 
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