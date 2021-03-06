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





    <style type="text/css" media="print">
    /*para que al imprimir no aparezcan el encabezado y pie que viene por defecto en window.print()
    y muestra el título de la página y la dirección web se ponen los márgenes a cero*/

                @page :first{
                    /* para que la cabecera, que se ve solo en la primera página
                    aparezca arriba del todo*/
                    margin-top: 0mm;
                }

                @page{
                    /*para el resto de las páginas*/
                    margin-top: 45mm;
                    margin-bottom: 45mm;
                }

                #map{
                    page-break-inside: avoid;
                    }


    </style>

    <!-- PARA QUE FUNCIONE EL EDITOR -->
    <link rel="stylesheet"  href="{{url('js/editor_informes/jqwidgets/styles/jqx.base.css')}}" type="text/css" />
    <link rel="stylesheet"  href="{{url('js/editor_informes/jqwidgets/styles/jqx.material-green.css')}}" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />
    <script src="{{url('js/editor_informes/scripts/demos.js')}}"></script>
    <script src="{{url('js/editor_informes/jqwidgets/jqxcore.js')}}"></script>
    <script src="{{url('js/editor_informes/jqwidgets/jqxbuttons.js')}}"></script>
    <script src="{{url('js/editor_informes/jqwidgets/jqxscrollbar.js')}}"></script>
    <script src="{{url('js/editor_informes/jqwidgets/jqxlistbox.js')}}"></script>
    <script src="{{url('js/editor_informes/jqwidgets/jqxdropdownlist.js')}}"></script>
    <script src="{{url('js/editor_informes/jqwidgets/jqxdropdownbutton.js')}}"></script>
    <script src="{{url('js/editor_informes/jqwidgets/jqxcolorpicker.js')}}"></script>
    <script src="{{url('js/editor_informes/jqwidgets/jqxwindow.js')}}"></script>
    <script src="{{url('js/editor_informes/jqwidgets/jqxeditor.js')}}"></script>
    <script src="{{url('js/editor_informes/jqwidgets/jqxtooltip.js')}}"></script>
    <script src="{{url('js/editor_informes/jqwidgets/jqxcheckbox.js')}}"></script>

    <!-- PARA INICIALIZAR EL EDITOR -->

    <script type="text/javascript">
        $(document).ready(function () {
            // EDITOR PARA EL TEXTO EN EL QUE APARECEN LOS NOMBRES DE LOS MAPAS Y EL ANTERIOR NOMBRE DE LAS VÍAS /////////////////////
            $('#textoMapas').jqxEditor({
                height: 255,
                width: '100%',
                theme : 'material-green',
                //tools: 'bold italic underline | format font size | color background | left center right | outdent indent | ul ol | link'
            });

            // EDITOR PARA INCLUIR EL TEXTO DEL INFORME ////////////////////////////////////////////////////////////////////////////////
            $('#textoInforme').jqxEditor({
                height: 500,
                width: '100%',
                theme : 'material-green'
            });

            // EDITOR PARA LA CABECERA /////////////////////
            $('#headEditable').jqxEditor({
                height: 255,
                width: '100%',
                theme : 'material-green',
                //tools: 'bold italic underline | format font size | color background | left center right | outdent indent | ul ol | link'
            });

            // AQUÍ OBTENEMOS EL CONTENIDO DEL EDITOR Y LO COLOCAMOS DONDE QUEREMOS /////////////////////////////////////////////////////
            /*
            var cabecera = $('#situacionMapa').val();
            document.getElementById('probando').innerHTML = ' ' + cabecera;
            var informe = $('#observaciones').val();
            document.getElementById('contenido').innerHTML = ' ' + informe;
            //console.log(informe);
            */
        });
    </script>

@endsection

@section('content')

    <div class="container">
        <div class="wholePanel">
            <div class="rightPanel" style="width:100%;">
                <div id="cabecera" class="d-flex flex-row ml-5 mt-5">
                    <img src="{{url('img/organizations/ayto-marca-institucional-color-RGB.png')}}" alt="Logo ayto" style="width: 10%">
                    <ul id="headEditable" class="list-unstyled align-self-end pl-4" contenteditable="true" style="width: 70%;">
                    <h6>
                    <li id="linea1"><b>EXCMO. AYUNTAMIENTO DE ALMERÍA</b></li>
                    <li id="linea2">AREA DE CULTURA Y EDUCACIÓN</li>
                    <li id="linea3"><b>SECCIÓN ARCHIVO Y BIBLIOTECAS</b></li>
                    <li id="linea4"><b>ARCHIVO MUNICIPAL</b></li>
                    </h6>
                    </ul>
                </div>
                <div id="texto">
                    <button id="btn-pdf" type="button" class="btn btn-success mr-5 btn-sm float-right">Guardar/Imprimir</button>
                    <!-- <button id="probando" type="button" class="btn btn-success mr-5 btn-sm float-right">probando</button> -->
                    <div id="nombreVia" class="mt-3">
                        <h2 class="text-center text-success display-4"> {{$street->type->name}} {{$street->name}}</h2>
                    </div>
                    <!-- TEXTO DE AYUDA CONTEXTUAL -->
                    <div id="cPopUp" class="number1" style="transform:translate(20%); display: none; position: static;">
                        <div class="cornerButton"> X </div>
                        <div class="textContent" style="text-align: justify; font-size: 13px;">
                            <p>
                            Este texto es editable, es decir, puede ser modificado o borrado o añadir más texto si lo desea, para ello sólo <br>
                            tiene que hacer click en la zona indicada en color verde y
                            podrá comenzar la edición.</p>
                            <div class="d-flex flex-row mt-0">
                                <p id="enlace1" class="font-italic" style=" background-color: white; box-shadow: 10px 10px 5px rgba(56, 193, 114, 0.25); width:300px; border-radius: 12px; cursor: pointer;"><b class="text-success">"Click sobre el texto</b> para modificarlo."</p>
                                <div>
                                    <button id="noVolverAMostrar" type="button" class="btn btn-success btn-sm rounded-pill ml-5">Eliminar ayuda permanentemente</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- AQUÍ VA EL TEXTO CON LOS MAPAS EN LOS QUE APARECE LA CALLE EN CUESTIÓN -->
                    <div id="textoMapas" contenteditable="true">
                        <p id="introduccionMapa" class="font-weight-light mx-5 font-italic"><span class="intro1"><b class="text-success">Click sobre el texto</b> para modificarlo.</span></p><br>
                        @isset($street)
                            <div id="textoIntroduccion" class="mx-5">
                                <h5>Se encuentra
                                    @if (count($street->maps) > 1)
                                        en los siguientes mapas
                                        @else
                                        en el mapa
                                    @endif
                                        :
                                </h5>
                            </div>
                            <div id="nombreMapas" class="ml-5 text-justify">
                                @foreach($street->maps as $map)
                                    <h5>
                                        Mapa : {{$map->title}}
                                    </h5>
                                        @isset($map->pivot->alternative_name)
                                            @if (count($street->maps) > 1)
                                                <div class="row ml-2">
                                                    <p>
                                                        En este mapa no existía como tal, en su lugar se ubicaba: &nbsp;
                                                        <h6>
                                                            {{$map->pivot->alternative_name}}
                                                        </h6>
                                                    </p>
                                                </div>
                                            @endif
                                        @endisset
                                @endforeach
                                    <br>
                                    <br>
                            </div>
                        @endisset
                    </div>
                    <!-- DIV QUE CONTIENE EL MAPA CON LA SITUACIÓN DE LA CALLE BUSCADA ///////////////////// -->
                    <div id="map" style="width:90%;height: 225px;" class="mx-5 my-1"></div>
                    <br><br>

                     <!-- TEXTO DE AYUDA CONTEXTUAL -->
                     <div id="cPopUp1" class="number2" style="transform:translate(15%); display: none; position: static;">
                        <div class="cornerButton"> X </div>
                        <div class="textContent" style="text-align: justify; font-size: 13px;">
                            <p>En la zona editable bajo el mapa también basta con hacer click
                               en la zona indicada en color verde para poder comenzar a escribir.</p>
                            <div class="d-flex flex-row mt-0" style="z-index: 3;">
                                <p id="enlace2" class="font-italic" style=" background-color: white; box-shadow: 10px 10px 5px rgba(56, 193, 114, 0.25); width:275px; border-radius: 12px; cursor: pointer;"><b class="text-success">"Click aquí</b> para redactar su informe."</p>
                                <div>
                                    <button id="noVolverAMostrar1" type="button" class="btn btn-success btn-sm rounded-pill ml-5">Eliminar ayuda permanentemente</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- AQUÍ VA EL TEXTO CON EL INFORME QUE REDACTAMOS -->
                    <div id="textoInforme" contenteditable="true" class="mx-5 text-justify">
                        <p id="introduccionInforme" class="">
                            <span class="intro2 font-weight-light font-italic"> <br>
                                <b class="text-success">Click aquí </b> para redactar su informe.
                            </span>
                        </p>
                        <div>
                            <br>
                            <br>
                            <br>
                            <div id="fechaInforme" class="col-4 offset-8"></div>
                            <div id="firmado" class="col-4 offset-8"></div>
                        </div>
                    </div>
                <!-- <p id="pie">este es el pie de página</p> -->

                <!-- LOS BOTONES -->

                <!-- Se añade el botón "X" para salir del informe y volver a la página anterior -->
                <!-- controlamos con la variable flash 'frontend' si el usuario viene de front o back para el enlace -->

                <a href="@if(session('frontend')){{route('map.map')}}@else{{route('search.index')}}@endif">
                    <div class="cornerButton">
                        <img class="center" src="{{url('img/icons/close.svg')}}" alt="">
                    </div>
                </a>
                <!-- Fin de botón "X" para salir del informe -->
            </div>
        </div>
    </div>



@endsection

@section('scripts')

        <!-- LINK A JQUERY UI PARA EL DRAG AND DROP -->
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
     <script type="text/javascript" src="{{url('/js/informe.js')}}"></script>
     <!-- {{--<script type="text/javascript" src="{{url('/js/cPopUp.js')}}"></script>--}} -->
     <script type="text/javascript" src="{{url('/js/js.cookie.js')}}"></script>


            <!--SCRIPT QUE NOS MUESTRA LA SITUACIÓN DE LA CALLE EN EL MAPA ////////////////////// -->
            <script>
                map = L.map('map', {
                minZoom: 10,  //Dont touch, recommended
                zoomControl: false,
                attributionControl: false
            });
            /* LATITUD Y LONGITUD */
            map.setView([{{$street->points[0]->lat}}, {{$street->points[0]->lng}}], 17);
            let mapTile = L.tileLayer.wms('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-lite/{z}/{x}/{y}{r}.png', {
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
            });
            map.dragging.disable();
            </script>

@endsection


