 
@extends('layouts.master')

@section('title', 'Celia Maps')

@section('cdn')
    <!-- LEAFLET -->
    <script src="{{url('/js/Leaflet/leaflet.js')}}"></script>
    <link rel="stylesheet" href="{{url('/js/Leaflet/leaflet.css')}}">
    <!-- Plugin toolbar -->
    <script src="{{url('/js/Leaflet/pluginToolbar/leaflet.toolbar-src.js')}}"></script>
    <link rel="stylesheet" href="{{url('/js/Leaflet/pluginToolbar/leaflet.toolbar-src.css')}}">
    <!-- Plugin images -->
    <script src="{{url('/js/Leaflet/pluginImages/leaflet.distortableimage.js')}}"></script>
    <link rel="stylesheet" href="{{url('/js/Leaflet/pluginImages/leaflet.distortableimage.css')}}">
    <!-- Plugin clustering markers -->
    <script src="{{url('/js/Leaflet/pluginClusteringMarkers/leaflet.markercluster.js')}}"></script>
    <link rel="stylesheet" href="{{url('/js/Leaflet/pluginClusteringMarkers/MarkerCluster.css')}}">
    <link rel="stylesheet" href="{{url('/js/Leaflet/pluginClusteringMarkers/MarkerCluster.Default.css')}}">
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- PERSONAL CSS -->
    <link rel="stylesheet" href="{{url('/css/Backend.css')}}">
    <link rel="stylesheet" href="{{url('/css/frontend.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{url('js/mapTlMenu.js')}}"></script>
    <script src="{{url('js/mapBlMenu.js')}}"></script>
    <script src="{{url('js/mapFullScreenMenu.js')}}"></script>
    <!-- Disable Leaflet images clicks events -->
    <style>.ldi .leaflet-pane .leaflet-overlay-pane img{
        pointer-events:none!important}
    </style>
@endsection

@section('content')
    <!-- Div where the map and all the menus will
    go so we are able to drag booth the menues and go 
    trought the map -->
    <div id="draggableArea">

        {{-- Mapa --}}
        <div id="map"></div>
        
        {{-----------------------------------------------------------}}
        {{-- MENU DE ARRIBA A LA IZQUIERDA Y LAS VENTANAS FLOTANTE --}}
        {{-----------------------------------------------------------}}
        {{-- CONTROLADOR DEL MENÚ --}}
        <div class="ballMenu">
            <div class="ballMenuContent">
                <img class="noselect" src="{{url('img/icons/menu.png')}}" alt="">
            </div>
        </div>
        <div id="ballMaps" class="ball noselect">
            <div class="ballContent">
                <img class="noselect" src="{{url('img/icons/tlMenuMap.png')}}" title="Mapas">
            </div>
        </div>
        <div id="ballStreets" class="ball noselect">
            <div class="ballContent">   
                 <img style="width: 70%;position: absolute; top: 15%; left: 15%" class="noselect" src="{{url('img/icons/search.svg')}}" title="Buscador">
             </div>
         </div>

        {{-- CONTENIDO DE MENÚ --}}
        {{-- Todos los menús que podemos poner --}}

        {{-- Menú de los mapas --}}
        <div id="mapsMenu" style="max-height: 300px; font-family: Arial, Helvetica, sans-serif" class="menu noselect">
                <!-- Todo el menú -->
                <div class="closeMenuButton">
                    <i class="fa fa-times"></i>
                </div>
                <div class="pinMenuButton ">
                    <img class="pinIcon" src="{{url('/img/icons/pin.svg')}}" alt="">
                </div>

                <img src="{{url('img/icons/tlMenuMap.png')}}" title="Mapas">
                <div id="mapsTrans" style="max-height: 270px; overflow-y: auto;">
                    {{-- Para activar el primer mapa y los otros no  --}}
                    @php $first = true; @endphp
                    {{-- Variables donde metemos los mapas --}}
                    <script> var images = new Array(); </script>
                    {{-- Por cada mapa que encontramos en la base de datos  --}}
                    @foreach ($maps as $map)
                        {{-- Comprobamos que tenga una posición en el mapa --}}
                        @if (!empty($map->tlCornerLatitude))
                            {{-- Si es el primero aparece activado --}}
                            @if ($first)
                                <!-- Si es el primero quitamos la variable de en medio -->
                                @php $first = false; @endphp
                                <!-- Cada una de las filas para los mapas -->
                                <div id="mapTrans{{$map->level}}" class="mapTrans">
                                    <!-- The eye and thr title -->
                                    <div class="contEye">
                                        <i class="eye fa fa-eye fa-2x"></i><h2 class="noselect title">{{$map->title}}</h2>
                                    </div>
                                    <!-- The slider and the number-->
                                    <div class="contSlider slider">
                                        <input id="transparency{{$map->id}}" type="range" min="0" max="100" value="100" class="sliderVar" oninput="sliderChange(this.value, this.id)">
                                        <span class="noselect opacity">100</span>
                                    </div>
                                </div>
                            @else
                                <!-- Si no lo es hacemos que no esté seleccionado -->
                                <div id="mapTrans{{$map->level}}" class="mapTrans">
                                    <!-- The eye and thr title -->
                                    <div style="opacity:0.50;" class="contEye">
                                        <i class="eye fa fa-eye-slash fa-2x"></i><h2 class="noselect title">{{$map->title}}</h2>
                                    </div>
                                    <!-- The slider and the number-->
                                    <div style="display: none;" class="contSlider ">
                                        <input id="transparency{{$map->id}}" type="range" min="0" max="100" value="100" class="sliderVar"  oninput="sliderChange(this.value, this.id)">
                                        <span class="noselect opacity">0</span>
                                    </div>
                                </div>
                            @endif
                            <script>
                                //Añadimos las imágenes y sus propiedades
                                var img = L.distortableImageOverlay("{{url('img/maps/'.$map->image.'')}}", {
                                    //Hacemos que no pue pueda editar
                                    editable: false,
                                    corners: [
                                        L.latLng('{{$map->tlCornerLatitude}}', '{{$map->tlCornerLongitude}}'),
                                        L.latLng('{{$map->trCornerLatitude}}', '{{$map->trCornerLongitude}}'),
                                        L.latLng('{{$map->blCornerLatitude}}', '{{$map->blCornerLongitude}}'),
                                        L.latLng('{{$map->brCornerLatitude}}', '{{$map->brCornerLongitude}}'),
                                    ],
                                });
                                images.push(img);
                            </script>
                        @endif <!-- Si no tiene alineamiento no se pone el mapa -->
                    @endforeach
                </div>
        </div>

        {{-- Menú del callejero --}}
        <div id="streetsMenu" class="menu noselect">
            {{-- Cruz para cerrar el menú --}}
            <div class="closeMenuButton">
                <i class="fa fa-times"></i>
            </div>
            {{-- Iconito del pin para fijarla --}}
            <div class="pinMenuButton ">
                <img class="pinIcon" src="{{url('/img/icons/pin.svg')}}" alt="">
            </div>
            {{-- Icono que representa & Contenido de la ventana --}}
            <div id="searchBar">    
                {{-- Icono de la lupa --}}
                <div class="divImg">
                    <img class="noselect" src="{{url('img/icons/search.svg')}}" title="Callejero">
                </div>
                {{-- Barra de input para las calles --}}
                <div class="divInput">
                    <input id="streetsInput" placeholder="Buscar en el mapa...">
                </div>
            </div> 

            {{-- Contenido de las busquedas y petición con AJAX --}}
            <div id="searchContent">
                {{-- div donde se mostrarán todas las calles --}}
                <div id="streetsFound">
                    {{-- <div class="street"> 
                        test
                    </div> --}}
                </div>

                <script>
                    // ************************************************
                    // CODIGO DE LA BARRA DE BSUCAR CALLES Y HOTSPOTS 
                    // ************************************************
                    //tHE VARIABLES TAHT WE ARE GONNA USE ALONG THE PROGRAM
                    //We will fill this in the ajax request
                    var streets = [];
                    //When we first click in the search bar (AJAX)
                    $("#streetsInput").on("focusin", function(e){
                        if($(this).val().length != 0){
                            if($('#streetsFound').children().length == 0){
                                lookByText();
                            }  
                        }
                    });

                    // When we look for something we remove options depending of
                    // the text in the box looking inside the first ajax request
                    $("#streetsInput").on("input", function(e){
                        $('#streetsFound').empty();
                        if($(this).val().length != 0)
                            lookByText();
                    });

                    // We hide everything when we unfocus
                    $("#streetsInput").on("focusout", function(e){
                        // $('#streetsFound').empty();
                    });

                    // Auxiliar function
                    function lookByText(){
                        c = 0;
                        console.log(streets);
                        streets.forEach(street => {
                            if(street.fullName.toLowerCase().includes($('#streetsInput').val().toLowerCase())){
                                // Deprecated street will appear in italic font
                                if(street.deprecated == true)
                                    $('#streetsFound').append("<div id='"+ street.id +"' style='font-style:italic;opacity:0.8' class='street'> <img style='width:5%;' src='{{url('img/icons/tokenSelected.svg')}}'>"+ street.fullName + "</div>");
                                else
                                    $('#streetsFound').append("<div id='"+ street.id +"' class='street'> <img style='width:5%;' src='{{url('img/icons/tokenSelected.svg')}}'>"+ street.fullName + "</div>");
                                if(++c == 5){
                                    return;
                                }                                
                            }
                        });
                    }
                </script>
            </div>
        </div>

        {{-----------------------------------------------------------}}
        {{-- BOTTOM LEFT MENU TO CHANGE THE KIND OF MAP TO DISPLAY --}}
        {{-----------------------------------------------------------}}
        <div id="tilesMenu">
            <div id="tilesShow">
                <i class="fa fa-chevron-down"></i>
            </div>
            <div id="tileChooser">
                <div class="tiles"> 
                    <img src="{{url("img/maps/KindOfMap1.png")}}" alt="">
                </div>
                <div class="tiles"> 
                    <img src="{{url("img/maps/KindOfMap2.png")}}" alt="">
                </div>
                <div class="tiles"> 
                    <img src="{{url("img/maps/KindOfMap3.png")}}" alt="">
                </div>
            </div>
        </div>

        {{-------------------------------------------------------------}}
        {{-- BOTTOM RIGHT MENU SO WE CAN DISPLAY S WE CAN FULLSCREEN --}}
        {{-------------------------------------------------------------}}
        <div id="fullScreenMenu">
            <img src="{{url('/img/icons/fsMaximize.png')}}" alt="">
        </div>

        {{-------------------------------------------------------------}}
        {{-------- MENU THAT APPEARS WHEN YOU CLICK IN A MARKER -------}}
        {{-------------------------------------------------------------}}
        <div class="cMenu noselect">
            {{-- Se muestra este si se clicka en una layer --}}
            <div class="csMenu edit">
                <div class="option" action="Edit"> <img src="{{url('js/Leaflet/pluginMarkers/img/name.svg')}}"> </div>
                <div class="option" action="Drag">  <img src="{{url('js/Leaflet/pluginMarkers/img/drag.svg')}}"> </div>
                <div class="option" action="Remove"> <img src="{{url('js/Leaflet/pluginMarkers/img/remove.svg')}}"> </div>
            </div>
        </div>
    </div>

    <!-- Create/edit hotspot modal -->
    <div class="modal fade" id="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="modal-form" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method">
                    <div class="modal-header border-bottom-0">
                        <h5 id="modal-title" class="modal-title text-primary"></h5>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <!-- Hotspot title -->
                        <div class="form-group">
                            <b> <label>Titulo del Hotspot</label> <span class="text-danger">*</span> </b>
                            <input required type="text" class="form-control" name="title">
                            <label class="text-danger inputs-errors mt-3">@error('title') {{$message}} @enderror</label>
                        </div>
                        <!-- Hotspot description -->
                        <div class="form-group">
                            <b> <label> Descripcion del Hotspot </label> <span class="text-danger">*</span> </b>
                            <input required type="text" class="form-control" name="description">
                            <label class="text-danger inputs-errors mt-3">@error('description') {{$message}} @enderror</label>
                        </div>
                        <!-- Hotspot images -->
                        <div class="form-group">
                            <b> <label> Imagenes del Hotspot </label> <span class="text-danger">*</span> </b>
                            <input required type="file" name="images[]" class="fileToUpload">
                            <b><label class="text-danger inputs-errors mt-3">@error('images[]') {{$message}} @enderror</label></b>
                        </div>
                        <div class="form-group images-fields" id="filePathUpdate">
                            <input type="hidden" name="filePath" value="/img/hotspots/" disabled>
                        </div>
                        <div class="form-group">
                            <b> <label> Titulo de la imagen </label> <span class="text-danger">*</span> </b>
                            <input required type="text" class="form-control" name="titleImage">
                        </div>
                        <div class="form-group">
                            <b> <label> Descripcion de la imagen </label> <span class="text-danger">*</span> </b>
                            <input required type="text" class="form-control" name="descriptionImage">
                        </div>
                        <!-- Hotspot points -->
                        <div>
                            <input type="hidden" id="modal-lat" name="lat">
                            <input type="hidden" id="modal-lng" name="lng">
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button id="btn-remove" value="" type="button" class="btn btn-danger">Eliminar</button>
                        <button id="btn-position" value="" type="button" class="btn text-white btn-warning mr-auto">Cambiar posición</button> --}}
                        <button id="btn-submit" type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal to confirm -->
    <div id="confirmModal" class="modal fade text-dark" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="confirm-modal-title" class="modal-title">Eliminar Hotspot</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar el hotspot?</p>
                    <button id="btn-confirm" type="button" class="btn btn-danger float-right deleteConfirm" data-dismiss="modal">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Hotspots -->
    <div id="preview" class="card">
        <img id="previewImage" src="" alt="Hotspot Preview" style="width:286px; height: 180px">
        <div class="card-body" style="color: black">
          <h4 id="previewTitle"><b></b></h4> 
        </div>
    </div>
    
@endsection

@section('scripts')
    {{-- ALL OF THE PARTS RELATED WITH SHOWING THE MAPS AND LAYERS --}}
    <script>
        // Pagina donde están los proveedores de mapas:
        // http://leaflet-extras.github.io/leaflet-providers/preview/index.html
        var map = L.map('map', {
            minZoom: 6,  //Dont touch, recommended
            // maxZoom: 2, //Dont touch, max zoom 
            zoomControl: false,
        });
        map.setView([36.844092, -2.457840], 14);

        //Global maps from the one we will be able to pick one
        var mapTiles = [
            mapTile0 = L.tileLayer.wms('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19, //Dont touch, max zoom 
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }),
            mapTile1 = L.tileLayer.wms('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-lite/{z}/{x}/{y}{r}.png', {
                attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 20, //Dont touch, max zoom
                subdomains: 'abcd',
            }),
            mapTile2 = L.tileLayer.wms('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 20, //Dont touch, max zoom 
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
            })
        ];
        //Adding rhe layers to the map
        map.addLayer(mapTile0);

        //Here we are adding the images(of the diferent maps) on top of the map
        map.whenReady(function() {

            //Añadimos la imagen al mapa
            images.forEach(function(img) {
                //Then we add all the different maps
                map.addLayer(img);
                img.bringToFront();
                //And if they are not the first one
                if(img != images[0]){
                    //We take the opacity to 0 so they are hidding now
                    img.setOpacity(0);
                }
            });

            // Small arrow to allow us to hide the menu at the bottom left
            $('#mapsShow').click(function(){
                // We control it using the icon
                var icono = $(this).find('i');
                //If it's up(Menu closed)
                if(icono.hasClass("fa-chevron-up")){
                    //We show it by moving it up
                    $(this).parent().animate({
                        top: "0px",
                    }, 300);
                } else {
                    //If the menu is down we move it up
                    $(this).parent().animate({
                        top: "15px",
                    }, 300);
                }
            });
        });
    </script>
    
    {{-- HOTSPOT MANAGEMENT --}}

    