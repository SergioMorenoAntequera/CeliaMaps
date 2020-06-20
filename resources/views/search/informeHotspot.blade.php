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
        /* para que al imprimir no aparezcan el encabezado y pie que viene por defecto en window.print()
           y muestra el título de la página y la dirección web*/
        @page{
            size: auto;
            margin: 0mm;
            }
        </style>
@endsection

@section('content')


    <div class="container">

        @isset($hotspot)
            <div class="wholePanel">
                <!-- PANEL IZQUIERDO, POR  AHORA NO INCLUIMOS IMAGEN, MÁS QUE NADA, PORQUE NO CABE ////////////////////////////////////////////
                <div class="leftPanel" style="width:60%;">

                </div>
                FIN DE PANEL IZQUIERDO //////////////////////////////////////////// -->

                <!-- PANEL DERECHO //////////////////////////////////////////// -->
                <div class="rightPanel" style="width:100%;">
                    <div id="cabecera" class="d-flex flex-row ml-5 mt-5">
                        <img src="{{url('img/organizations/ayto-marca-institucional-color-RGB.png')}}" alt="Logo ayto" style="width: 10%">
                        <ul id="headEditable" class="list-unstyled align-self-end pl-4">
                        <h6>
                        <li id="linea1"><b>EXCMO. AYUNTAMIENTO DE ALMERÍA</b></li>
                        <li id="linea2">AREA DE CULTURA Y EDUCACIÓN</li>
                        <li id="linea3"><b>SECCIÓN ARCHIVO Y BIBLIOTECAS</b></li>
                        <li id="linea4"><b>ARCHIVO MUNICIPAL</b></li>
                        </h6>
                        </ul>
                    </div>

                   <!-- <div id="titulos" class="d-flex flex-column align-self-center" >
                    <p id="linea1">EXCMO. AYUNTAMIENTO DE ALMERÍA</p>
                        <p id="linea2">AREA DE CULTURA Y EDUCACIÓN</p>
                        <p id="linea3">SECCIÓN ARCHIVO Y BIBLIOTECAS</p>
                        <p id="linea4">ARCHIVO MUNICIPAL</p>
                    </div>
                -->


                    <div id="contenidoHotspot">
                    <div id="nombreHotspot" class="mt-3 py-5">
                        <h2 class="text-center text-success display-4">{{$hotspot->title }}</h2>
                    </div>

                    <div id="descripcion" class="text-justify mx-5">
                    <h5 class="font-italic">{{$hotspot->description}}</h5>
                    </div>

                    <br>

                    <!-- AQUÍ PONGO EL BOTÓN DE OBSERVACIONES -->
                    <div class="row col-2 float-left ml-5">
                        <button id="botonObservaciones" type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#cuadroObservaciones">
                            Generar Informe
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
                                        <label for="funcionarioa">Persona que redacta el informe:</label>
                                        <input type="text" id="funcionarioa" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="observaciones">Redacte aquí el contenido del informe</label>
                                        <textarea id="observaciones" class="form-control col-12"></textarea>
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

                    <!-- AQUÍ PONGO EL BOTÓN DE GENERAR INFORME -->
                    <div class="row col-2 float-right mr-5">
                        <button id="btn-pdf" type="button" class="btn btn-success">Guardar/Imprimir</button>
                    </div>

                    <!-- FIN DE BOTÓN DE GENERAR INFORME -->

                    <!-- SE AÑADE EL BOTÓN "X" PARA SALIR DEL INFORME -->

                    <!-- CONTROLAMOS CON LA VARIABLE FLASH 'frontend' SI EL USUARIO VIENE DE FRONT O BACK PARA EL ENLACE -->
                    <a href="@if(session('frontend')){{route('map.map')}}@else{{route('search.index')}}@endif">
                        <div class="cornerButton">
                        <img class="center" src="{{url('img/icons/close.svg')}}" alt="">
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

                    <!-- DIV QUE CONTIENE EL MAPA CON LA SITUACIÓN DE LA CALLE BUSCADA /////////////////////
                    <div id="map" style="width:100%;height: 480px;"></div>  -->
                    <!-- AQUÍ VAN LAS IMÁGENES //////////////////////////////////////////// -->
                    <div id="allElements" style="display: flex; flex-wrap: wrap;">

                            @foreach ($hotspot->images as $image)
                            <a class="element col-md-4" name="{{$image->id}}" style="margin: 15px 0; padding: 0 15px; flex: 0 0 33.333333%; max-width: 455px; position: relative; overflow: hidden; height: 325px" href="#" data-toggle="light-box" data-gallery="gallery">
                                <img class="rounded" style="height: 100%" src="{{url('img/hotspots/', $image->file_name)}}" alt="{{$image->title}}" title="{{$image->description}}"> <br>
                            </a>
                            @endforeach


                    </div>
                    <br>

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
    <script type="text/javascript" src="{{url('/js/informeHotspot.js')}}"></script>
@endsection
