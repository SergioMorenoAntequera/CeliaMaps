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
    <!-- para que al imprimir no aparezcan el encabezado y pie que viene por defecto en window.print()
    y muestra el título de la página y la dirección web*/-->
    <style type="text/css" media="print">
    @page{
        size: auto;
        margin: 0mm;
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
            $('#situacionMapa').jqxEditor({
                height: 255,
                width: '100%',
                theme : 'material-green',
                tools: 'bold italic underline | format font size | color background | left center right | outdent indent | ul ol | link'

            });

            $('#observaciones').jqxEditor({
                height: 255,
                width: '100%',
                theme : 'material-green',
                localization: {
                    "bold": "Fett",
                    "italic": "Kursiv",
                    "underline": "Unterstreichen",
                    "format": "Block-Format",
                    "font": "Schriftname",
                    "size": "Schriftgröße",
                    "color": "Textfarbe",
                    "background": "Hintergrundfarbe",
                    "left": "Links ausrichten",
                    "center": "Mitte ausrichten",
                    "right": "Rechts ausrichten",
                    "outdent": "Weniger Einzug",
                    "indent": "Mehr Einzug",
                    "ul": "Legen Sie ungeordnete Liste",
                    "ol": "Geordnete Liste einfügen",
                    "image": "Bild einfügen",
                    "link": "Link einfügen",
                    "html": "html anzeigen",
                    "clean": "Formatierung entfernen"
                }
            });

            var cabecera = $('#situacionMapa').val();
            document.getElementById('probando').innerHTML = ' ' + cabecera;
            var informe = $('#observaciones').val();
            document.getElementById('contenido').innerHTML = ' ' + informe;
            //console.log(informe);

        });
    </script>


    <!-- para que al imprimir no aparezcan el encabezado y pie que viene por defecto en window.print()
       y muestra el título de la página y la dirección web*/-->
       <style type="text/css" media="print">
    @page{
        size: auto;
        margin: 0mm;
        }
    </style>
@endsection

@section('content')


    <div class="container">



        @isset($street)
            <div class="wholePanel">

                <!-- PANEL DERECHO //////////////////////////////////////////// -->
                <div class="rightPanel" style="width:100%;">
                    <div id="cabecera" class="d-flex flex-row ml-5 mt-5">
                        <img src="{{url('img/organizations/ayto-marca-institucional-color-RGB.png')}}" alt="Logo ayto" style="width: 12%">
                        <ul class="list-unstyled align-self-end pl-4">
                        <li id="linea1"><b>EXCMO. AYUNTAMIENTO DE ALMERÍA</b></li>
                        <li id="linea2">AREA DE CULTURA Y EDUCACIÓN</li>
                        <li id="linea3"><b>SECCIÓN ARCHIVO Y BIBLIOTECAS</b></li>
                        <li id="linea4"><b>ARCHIVO MUNICIPAL</b></li>
                        </ul>
                    </div>
                    <div id="tituloCalle" class="mt-3">

                    <h2 class="text-center display-4 text-success"> {{$street->type->name}} {{$street->name}}</h2>
                    </div>

                    <!-- AQUÍ VA EL TEXTO CON LOS MAPAS EN LOS QUE APARECE LA CALLE EN CUESTIÓN -->
                    <div id="textoMapas" contenteditable="true">
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
                            <div id="nombreMapas" class="ml-5">
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
                            </div>
                        @endisset
                    </div>

                    <!-- LO ORDENABLE ///////////////////// -->

                     <div id="ordenado">
                         <!-- DIV QUE PUEDE CONTENER EL INFORME DE OBSERVACIONES ///////////////////// -->

                        <div id="informeObservacionesDropable" ></div>
                                          <!-- DIV QUE CONTIENE EL INFORME DE OBSERVACIONES -->

                    <div id="informeObservacionesDraggable" class="p-2 mx-5">

                        <div id="encabezadoDraggable">

                            <div id="textoUbicacion" >

                            </div>
                        </div>
                        <div id="probando"></div>
                        <div id="contenido"></div>
                        <div id="contenidoDraggable">
                            <div id="contenido2">

                               <!-- <textarea name="editor" id="editor" cols="30" rows="10"></textarea>
                                <textarea name="editor" id="editor"></textarea> -->
                            </div>
                        </div>
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
                <!--  POSICIONAMIENTO DE BOTONES -->
                <div id="grupoBotones" class="d-flex justify-content-between ml-5">
                    <!-- <button id="botonCabecera" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#cuadroCabecera">Generar Cabecera</button> -->
                    <button id="mostrarocultar" type="button" class="btn btn-success btn-sm" style="float: right;">Ocultar ubicación</button>
                    <button id="volveramostrar" type="button" class="btn btn-success btn-sm" style="float: right;">Mostrar ubicación</button>
                    <button id="ocultarmapa" type="button" class="btn btn-success btn-sm" style="float: right;">Ocultar mapa</button>
                    <button id="mostrarmapa" type="button" class="btn btn-success btn-sm" style="float: right;">Mostrar mapa</button>
                    <button id="botonObservaciones" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#cuadroObservaciones">Generar Informe</button>
                    <button id="btn-pdf" type="button" class="btn btn-success mr-5 btn-sm">Guardar/Imprimir</button>
                </div>
                <!-- SE AÑADE EL BOTÓN "X" PARA SALIR DEL INFORME -->
                <!-- CONTROLAMOS CON LA VARIABLE FLASH 'frontend' SI EL USUARIO VIENE DE FRONT O BACK PARA EL ENLACE -->
                <a href="@if(session('frontend')){{route('map.map')}}@else{{route('search.index')}}@endif">
                    <div class="cornerButton">
                        <img class="center" src="{{url('img/icons/close.svg')}}" alt="">
                    </div>
                </a>
                <!-- FIN DE BOTÓN "X" PARA SALIR DEL INFORME -->

                <!-- FIN DE BOTONES  //////////////////////////////////////////// -->
                    <!-- DIV QUE CONTIENE EL MAPA CON LA SITUACIÓN DE LA CALLE BUSCADA ///////////////////// -->

                    <div id="map" style="width:90%;height: 225px;" class="mx-5 my-1"></div>



                     <!-- FIN DE LO ORDENABLE ///////////////////// -->
                     <!-- M O D A L E S //////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
                                     El informe se imprimirá, por defecto, sobre la imagen, si desea cambiar el orden, <br>
                                     haga click en ella y muévala.
                                 </p>
                                 <div class="form-group">
                                     <label for="funcionarioa">Persona que redacta el informe:</label>
                                     <input type="text" id="funcionarioa" class="form-control"/>
                                 </div>

                                <!-- <div class="form-group">
                                     <label for="observaciones">Redacte aquí el contenido del informe</label>
                                     <textarea id="observaciones" class="form-control col-12" style="border:0"></textarea>
                                 </div> -->
                                 <div id="observaciones"></div>
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
                </div>
                <!-- FIN DE PANEL DERECHO //////////////////////////////////////////// -->
                <br>
            </div>
        @endisset
    </div>


@endsection

@section('scripts')

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{url('/js/informe.js')}}"></script>
        <!--{{-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script> --}} -->




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
