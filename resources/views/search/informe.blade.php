@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')

@endsection

@section('cdn')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin="" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
@endsection

@section('content')


    <div class="container">



        @isset($street)
            <div class="wholePanel">
                <!-- PANEL IZQUIERDO, POR  AHORA NO INCLUIMOS IMAGEN, MÁS QUE NADA, PORQUE NO CABE ////////////////////////////////////////////
                <div class="leftPanel" style="width:60%;">

                </div>
                FIN DE PANEL IZQUIERDO //////////////////////////////////////////// -->

                <!-- PANEL DERECHO //////////////////////////////////////////// -->
                <div class="rightPanel" style="width:100%;">
                    <h2  class="text-center">Informe de situación</h2>
                    <div>
                        <h3>
                            {{$street->type->name }} {{$street->name}}
                        </h3>
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
                    <div id="nombreMapas">
                        @foreach($street->maps as $map)
                            <div>
                                <h5>
                                    {{$map->title}}
                                </h5>
                            </div>
                            @isset($map->pivot->alternative_name)
                                @if (count($street->maps) > 1)
                                    <div class="row offset-md-1">
                                        <p>
                                            Con el nombre: &nbsp;
                                            <h6>
                                                {{$map->pivot->alternative_name}}
                                            </h6>
                                        </p>
                                    </div>
                                @endif
                            @endisset

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
                        <button id="botonObservaciones" type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#cuadroObservaciones">
                            Observaciones
                        </button>
                    </div>
                    <!-- FIN DE BOTÓN DE OBSERVACIONES -->

                    <!-- MODAL PARA INCLUIR OBSERVACIONES -->

                    <div class="modal fade" id="cuadroObservaciones" data-backdrop="static" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tituloModal">Escriba un breve informe</h5>

                                        <button type="button" class="close text-success" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <p class="font-weight-light">
                                        El informe se imprimirá, por defecto, bajo la imagen, si desea cambiar el orden, <br>
                                        haga click en el elemento y muévalo.
                                    </p>
                                    <div class="form-group">
                                        <label for="funcionarioa">Nombre de el/la funcionario/a</label>
                                        <input type="text" id="funcionarioa" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="observaciones">Redacte aquí el contenido del informe</label>
                                        <textarea id="observaciones" class="form-control col-12" style="border:0"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="aplicar" class="btn btn-success" data-dismiss="modal">Aplicar</button>
                                    <button type="button" id="descartar" class="btn btn-outline-success" data-dismiss="modal">descartar</button>
                                    <!-- <button type="button" class="btn btn-primary">Aplicar</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN DE MODAL PARA INCLUIR OBSERVACIONES -->

                    <!-- AQUÍ PONGO EL BOTÓN DE PDF -->
                    <div class="row col-2 float-right">
                        <button id="btn-pdf" type="button" class="btn btn-success">Generar Informe</button>
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

                    <!-- LO ORDENABLE ///////////////////// -->

                     <div id="ordenado">
                         <!-- DIV QUE PUEDE CONTENER EL INFORME DE OBSERVACIONES ///////////////////// -->

                        <div id="informeObservacionesDropable" ></div>




                    <!-- DIV QUE CONTIENE EL MAPA CON LA SITUACIÓN DE LA CALLE BUSCADA ///////////////////// -->
                    <div id="map" style="width:100%;height: 480px;"></div>

                    <!-- DIV QUE CONTIENE EL INFORME DE OBSERVACIONES -->
                    <br>
                    <div id="informeObservacionesDraggable" class="border border-success rounded p-2 m-2">
                        <br>
                            <div id="encabezadoDraggable">
                                <div id="encabezado" class="font-weight-bold"></div>
                            </div>
                        <br>
                            <div id="contenidoDraggable">
                                <div id="contenido" class="text-justify"></div>
                            </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <!-- <div><button id="botonArrastre" class="btn btn-outline-success btn-sm">Hacer click y arrastrar</button></div> -->
                            <div id="fechaInformeDraggable">
                                <div id="fechaInforme" class="col-md-4 offset-md-8"></div>
                            </div>
                        <br>
                        <br>
                        <br>
                            <div id="nombreFuncionarioaDraggable">
                                <div id="nombreFuncionarioa" class="col-md-4 offset-md-8"></div>
                            </div>
                        <br>
                    </div>


                     </div>
                     <!-- FIN DE LO ORDENABLE ///////////////////// -->

                </div>
                <!-- FIN DE PANEL DERECHO //////////////////////////////////////////// -->
                <br>
            </div>
        @endisset
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{url('/js/informe.js')}}"></script>

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
            map.dragging.disable();

            </script>

@endsection
