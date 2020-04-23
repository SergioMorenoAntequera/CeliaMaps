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

        {{-- To get the main point from the settings database --}}
        <script> var mainPoint = @json($mainPoint); </script>
        {{-- Mapa --}}
        <div id="map"></div>

        <div id="cPopUp" style=" z-index: 6">
            <div class="cornerButton"> X </div>
            <span class="text"> 
                Haz click en el mapa para añadir hotspots <br> o click en uno de ellos para modificarlo.
            </span>
        </div>
        
        {{-----------------------------------------------------------}}
        {{-- MENU DE ARRIBA A LA IZQUIERDA Y LAS VENTANAS FLOTANTE --}}
        {{-----------------------------------------------------------}}
        {{-- CONTROLADOR DEL MENÚ --}}
        <div class="ballMenu" style="z-index:2">
            <div class="ballMenuContent">
                <img class="noselect" src="{{url('img/icons/menu.png')}}" alt="">
            </div>
        </div>
        <div id="ballMaps" class="ball noselect" style="z-index:1">
            <div class="ballContent">
                <img class="noselect" src="{{url('img/icons/tlMenuMap.png')}}" title="Mapas">
            </div>
        </div>
        <div id="ballStreets" class="ball noselect" style="z-index:1">
            <div class="ballContent">   
                 <img style="width: 70%;position: absolute; top: 15%; left: 15%" class="noselect" src="{{url('img/icons/search.svg')}}" title="Buscador">
             </div>
         </div>

        {{-- CONTENIDO DE MENÚ --}}
        {{-- Todos los menús que podemos poner --}}

        {{-- Menú de los mapas --}}
        <div id="mapsMenu" style="max-height: 300px; font-family: Arial, Helvetica, sans-serif z-index:0" class="menu noselect">
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
        <div id="streetsMenu" class="menu noselect" style="z-index:0">
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
        <div id="fullScreenMenu" style="width:44px;height:44px">
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
                        <!-- Images maps -->
                        <div class="form-group mb-0">
                            <b> <label> Mapas que la contienen </label></b>
                            @foreach ($maps as $map)
                                <p>
                                    @isset($map->tlCornerLatitude)
                                        <input id="checkbox_map{{$map->id}}" class="checkbox-text" type="checkbox" name="maps_id[]" value="{{$map->id}}" checked>
                                        <span class="text-dark checkbox-text">{{$map->title}} ({{$map->city}} - {{$map->date}})</span>
                                    
                                        <input id="input_map{{$map->id}}" class="form-control" type="text" name="maps_name[]" value="{{$map->title}}" placeholder="Sobreescribir el nombre de la vía en el mapa {{$map->title}}">
                                    @endisset
                                </p>
                            @endforeach
                            <b><label id="maps-error" class='text-danger mt-3 inputs-errors'> </label></b>
                        </div>
                        <!-- Hotspot points -->
                        <div>
                            <input type="hidden" id="modal-lat" name="lat">
                            <input type="hidden" id="modal-lng" name="lng">
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div>
                    <div class="modal-footer">
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
        map.setView([mainPoint.lat, mainPoint.lng], mainPoint.zoom);

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
    <script>
        var activeLayer;
        var userBusy = false;
        var currentAction = "none";

        $(function(){
            // Setting up the map
            var clusterMarkers = L.markerClusterGroup();
            var markersList = new Array();
            var activeMarker;
            var dragging = false;
            var action = "";
            var markerImage = L.icon({
                iconUrl: "{{url('img/icons/token-selected.svg')}}",
                iconSize:     [30, 90],
                iconAnchor:   [15,60],
            });

            // Check saved hotspots
            @isset($hotspots)
                // Hotspots php array conversion to js array
                let hotspotsJSON = @json($hotspots);
                hotspotsJSON.forEach(hotspot => {
                    // Save actual hotspot
                    addHotspotToArray(hotspot);
                });

                console.log(hotspots);
                // Write saved hotspots
                @foreach ($hotspots as $hotspot)
                    // Creating a Marker
                    var marker{{$hotspot->id}} = L.marker([{{$hotspot->lat}}, {{$hotspot->lng}}], {icon: markerImage, alt:"{{$hotspot->id}}", draggable:false});
                    marker{{$hotspot->id}}.id = {{$hotspot->id}};
                    // Adding marker to the markers list
                    markersList.push(marker{{$hotspot->id}});
                    // Adding marker to the map
                    clusterMarkers.addLayer(marker{{$hotspot->id}});
                @endforeach
                map.addLayer(clusterMarkers);
            @endisset

            // Leaflet map click handler
            map.on('click', function(e) {
                // Create modal trigger with lat/lng coordinates
                if(!dragging) {
                    hideMenu();  
                    cpuHide();  
                    showCreateForm(e.latlng.lat, e.latlng.lng);
                } else
                    dragging = false;
            });
            // Leaflet map click handler
            map.on('move', function(e) {
                // Create modal trigger with lat/lng coordinates
                hideMenu();
                cpuHide();
            });
 
            // ADD MARKER EVENTS TO A ALL MARKERS
            clusterMarkers.eachLayer(function(marker) {
                addMarkerEvents(marker);
            });
        });

        // CMenu components controller

        // Edit button
        $(".option[action='Edit']").on("click", function(e){
            let first = true;
            hotspots.forEach(hotspot => {
                if(first && hotspot.id == activeMarker.id){
                    hideMenu();
                    cpuHide();
                    showEditForm(hotspot);
                    first = false;
                }
            });
        });

        // Save button
        $("#btn-submit").on("click", function(e){
            e.preventDefault();
            
            // AJAX CREATE AND UPDATE
            switch(action){
                case "create": {
                    // We get the info from the form
                    let newHotspot = getFormData();
                    storeAjax(newHotspot);
                } break;
                case "update": {
                    // We get the info from the form
                    let updatedHotspot = getFormData();
                    updateAjax(updatedHotspot);
                } break;
                default:{
                    alert("Que?");
                }
            }
        });

        // Drag button
        $(".option[action='Drag']").on("click", function(){
            // Turn dragging variable to true to disable marker click handle
            hideMenu();
            dragging = true;

            // Detach current marker from the group
            clusterMarkers.removeLayer(activeMarker);
            // Disable markers group
            map.removeLayer(clusterMarkers);
            // Attach current marker directly to the map
            activeMarker.addTo(map);
            // Enable marker dragging mode

            activeMarker.dragging.enable();
            // Hide edition modal
            $('#modal').modal('hide');
            cpuShowText("Arrastra el punto a su nueva posición");

            // From here we jump to addMarkerEvents().dragend
        });

        // Remove button
        $(".option[action='Remove']").on("click", function(){
            hideMenu();
            $('#modal').modal('hide');
            $('#confirmModal').modal('show');
            cpuHide();
        });

        // Remove button cancel 
        $("#btn-cancel").click(function(){
            $('#confirmModal').modal('hide');
            cpuShowText("Borrado de hotspot cancelado");
        });

        // Remove button confirm
        $("#btn-confirm").click(function(){
            deleteAjax(activeMarker.id);
        });

        // clean search field on map click 
        map.on("click", function(){
            $('#streetsFound').empty();
        });

        // AUXILIAR METHODS

        // Prepares and shows the form
        function showCreateForm(lat, lng) {
            action = "create";
            // Create form attributes
            $("#modal-form").attr("action", "{{route('hotspot.store')}}");
            $("input[name='_method']").val("POST");
            // Clean fields
            $("input[name='title']").val("");
            $("input[name='description']").val("");
            $("input[name='titleImage']").val("");
            $("input[name='descriptionImage']").val("");
            // Clear maps alternatives names fields
            let mapsList = $("input[name='maps_name[]']");
            for (let i = 0; i < mapsList.length; i++) {
                mapsList[i].value = "";
                $(mapsList[i]).show();
                $(mapsList[i]).prop("disabled", false);
                $("#checkbox_map"+mapsList[i].id.substring(9)).prop("checked", true);
            }
            // Fill position values
            $("#modal-lat").val(lat);
            $("#modal-lng").val(lng);
            // Modal display
            $("#modal-title").text("Nueva vía");
            $("#btn-remove").prop("disabled", true);
            $("#btn-remove").css("display", "none");
            $("#btn-position").prop("disabled", true);
            $("#btn-position").css("display", "none");
            $(".inputs-errors").html("");
            $('#modal').modal('show');
        };

        function showEditForm(hotspot) {
            action = "update";
            // Edit form attributes
            $("#modal-form").attr("action", "{{route('hotspot.store')}}/"+hotspot.id);
            $("input[name='_method']").val("PUT");
            $(".inputs-errors").html("");
            // Fill inputs fields
            $("input[name='title']").val(hotspot.title);
            $("input[name='description']").val(hotspot.description);
            $("input[name='titleImage']").val(hotspot.titleImage);
            $("input[name='descriptionImage']").val(hotspot.descriptionImage);
            // Fill hidden values
            console.log(activeMarker);
            $("#modal-lat").val(activeMarker._latlng.lat);
            $("#modal-lng").val(activeMarker._latlng.lng);
            $(".modal-body #id").val(hotspot.id);

            // Clear maps
            let mapsList = $("input[name='maps_name[]']");
            for (let i = 0; i < mapsList.length; i++) {
                mapsList[i].value = "";
                $(mapsList[i]).hide();
                $(mapsList[i]).prop("disabled", true);
                $("#checkbox_map"+mapsList[i].id.substring(9)).prop("checked", false);
            }

            $("#modal-title").text("Editar Hotspot");
            // Show and enable buttons and also fill value with street id
            $("#btn-remove").prop("disabled", false);
            $("#btn-remove").prop("value", street.id);
            $("#btn-remove").css("display", "initial");
            $("#btn-position").prop("disabled", false);
            $("#btn-position").prop("value", street.id);
            $("#btn-position").css("display", "initial");
            // Modal display
            $('#modal').modal('show');
        };

        // Get data from the form
        function getFormData(){
            var newHotspot = {
                title: $("input[name='title']").val(),
                description: $("input[name='description']").val(),
                images: [],
                titleImage: $("input[name='titleImage']").val(),
                descriptionImage: $("input[name='descriptionImage']").val(),
                maps_id: [],
            }
            $("input[name='images[]']").each(function(e){


                // upload Image file using AJAX



                let arrImages = $("#images[]").files;
                console.log(arrImages);

            });
            $("input[name='maps_id[]']").each(function(e){
                let cbMap = $(this);

                if(cbMap.is(":checked")) {
                    newHotspot.maps_id.push($(this).val());
                }
            });
            
            newHotspot.lat = $("input[name='lat']").attr("value");
            newHotspot.lng = $("input[name='lng']").attr("value");
            newHotspot.id = $("input[name='id']").attr("value");
            
            return newHotspot;
        };

        // FORMAT THE DATA SO WE CAN USE IT
        function formatHotspotObject(data){
            //El formato que hay que copiar
            // Objeto Hotspot recuperado
            let formatedHotspot = data.hotspot;
            // Mapas con los pivots
            formatedHotspot.maps = data.maps;

            return formatedHotspot;
        };

        // ADD MARKER EVENTS TO A GIVEN MARKER
        function addMarkerEvents(marker){
            // CLICK
            marker.on('click', function(e){
                activeMarker = e.target;
                // When click does not come from dragg event
                if(!dragging){
                    showMenu(e, "edit");
                    cpuShowText("Selecciona una opción");
                }else{
                    // After drag click will be fired and here break dragging mode
                    dragging = false;
                }
            });

            // FINISH DRAG (MARKER MOVED)
            marker.on('dragend', function(e){
                // Disable dragging mode
                e.target.dragging.disable();

                // Attach current marker to the layer
                map.removeLayer(e.target);
                clusterMarkers.addLayer(e.target);
                // Enable markers group again
                map.addLayer(clusterMarkers);

                updatePositionAjax(e.target.id, e.target._latlng.lat, e.target._latlng.lng);
                dragging = false;
            });
        }

        // DETECS AND SHOWS AJAX ERRORS
        function showValidationErrors(data){
            if( data.status === 422 ) {
                let errors = data.responseJSON.errors;
                
                $('#maps-error').empty();
                if(errors["title"] !== undefined) {
                    $('#maps-error').append("Nombre de hotspot requerido <br>")
                }
                if(errors["description"] !== undefined) {
                    $('#maps-error').append("Descripcion de hotspot requerida <br> ")
                }
                if(errors["images[]"] !== undefined) {
                    $('#maps-error').append("Imagen de hotspot requerida <br> ")
                }
                if(errors["titleImage"] !== undefined) {
                    $('#maps-error').append("Titulo de la imagen requerido <br> ")
                }
                if(errors["descriptionImage"] !== undefined) {
                    $('#maps-error').append("Descripcion de la imagen requerida <br> ")
                } 
            }
        };

        // AJAX METHODS
        function storeAjax(street){
            $.ajax({
                url:"{{route('hotspot.storeAjax')}}",
                data: hotspot,
                success: function(data) {
                    let ajaxHotspot = formatHotspotObject(data);
                    
                    addHotspotToArray(ajaxHotspot);
                    
                    // CREATE A MARKER
                    var ajaxHotspotMarker = L.marker(
                        [ajaxHotspot.lat, ajaxHotspot.lng], 
                        {
                            icon: markerImage, 
                            alt:ajaxHotspot.id, 
                            id: ajaxHotspot.id,
                            draggable:false,
                        }
                    );
                    ajaxHotspotMarker.id = ajaxHotspot.id;
                    
                    // ADD IT TO THE MAP
                    markersList.push(ajaxHotspotMarker);
                    clusterMarkers.addLayer(ajaxHotspotMarker);
                    
                    // ADD THE EVENTS
                    addMarkerEvents(ajaxHotspotMarker);

                    // HIDE THE FORM
                    $("button[class='close']").click();
                    cpuShowText("Hotspot creado con exito");
                },
                error: function(data) {
                    // Se ha producido un error de validación
                    showValidationErrors(data);
                },
            });
        };

    </script>
@endsection