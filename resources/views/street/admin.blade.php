
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
                Haz click en el mapa para añadir calles <br> o click en una de ellas para modificarla.
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

    <!-- Create/edit street modal -->
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
                        <!-- Street type -->
                        <div class="form-group">
                            <b> <label>Tipo de vía</label> <span class="text-danger">*</span> </b>
                            <select required name="type_id" class="form-control">
                                @foreach ($streetsTypes as $streetType)
                                <option value="{{$streetType->id}}">({{$streetType->abbreviation}}) {{$streetType->type}}</option>
                                @endforeach
                            </select>
                            <label class="text-danger inputs-errors mt-3">@error('type_id') {{$message}} @enderror</label>
                        </div>
                        <!-- Street name -->
                        <div class="form-group">
                            <b> <label> Nombre de la vía </label> <span class="text-danger">*</span> </b>
                            <input required type="text" class="form-control" name="name">
                            <label class="text-danger inputs-errors mt-3">@error('name') {{$message}} @enderror</label>
                        </div>
                        <!-- Street maps -->
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
                        <!-- Street points -->
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
    
    <div id="confirmModal" class="modal fade text-dark" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="confirm-modal-title" class="modal-title">Eliminar vía</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar la vía?</p>
                    <button id="btn-cancel" type="button" class="btn btn-success float-left" data-dismiss="modal">Cancelar</button>
                    <button id="btn-confirm" type="button" class="btn btn-danger float-right deleteConfirm" data-dismiss="modal">Eliminar</button>
                </div>
            </div>
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
    
    {{-- STREET MANAGEMENT --}}
    <script>
        var activeLayer;
        var userBusy = false;
        var currentAction = "none";
        $(function(){
            //-------------------------------------------------------------}}
            //--------------------- SETTING UP THE MAP --------------------}}
            //-------------------------------------------------------------}}
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
            
            // CHECK SAVED STREETS
            @isset($streets)
                // Streets php array conversion to js array
                let streetsJSON = @json($streets);
                streetsJSON.forEach(street => {
                    // Save actual street
                    street.fullName = street.typeName + " " + street.name;
                    addStreetToArray(street);
                });
                console.log(streets);
                // Write saved streets
                @foreach ($streets as $street)
                    // Creating a Marker
                    var marker{{$street->id}} = L.marker([{{$street->points[0]->lat}}, {{$street->points[0]->lng}}],{icon: markerImage, alt:"{{$street->id}}", draggable:false});
                    marker{{$street->id}}.id = {{$street->id}};
                    // Adding marker to the markers list
                    markersList.push(marker{{$street->id}});
                    // Adding marker to the map
                    //marker{{$street->id}}.addTo(map);
                    clusterMarkers.addLayer(marker{{$street->id}});
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


            //-------------------------------------------------------------}}
            //----------------- CMENU COMPONENTS CONTROLLER ---------------}}
            //-------------------------------------------------------------}}
            //EDIT BUTTON
            $(".option[action='Edit']").on("click", function(e){
                // first is an aux var to get first id coincidence
                // because deprecated streets will cause multiple
                // coincidences and the first one will be actual data
                let first = true;
                streets.forEach(street => {
                    if(first && street.id == activeMarker.id){
                        hideMenu();
                        cpuHide();
                        showEditForm(street);
                        first = false;
                    }
                });
            });

            // SAVE BUTTON
            $("#btn-submit").on("click", function(e){
                e.preventDefault();
                
                // AJAX CREATE AND UPDATE
                switch(action){
                    case "create": {
                        // We get the info from the form
                        let newStreet = getFormData();
                        storeAjax(newStreet);
                    } break;
                    case "update": {
                        // We get the info from the form
                        let updatedStreet = getFormData();
                        updateAjax(updatedStreet);
                    } break;
                    default:{
                        alert("Que?");
                    }
                }
            });

            // DRAG BUTTON
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

            // REMOVE BUTTON
            $(".option[action='Remove']").on("click", function(){
                hideMenu();
                $('#modal').modal('hide');
                $('#confirmModal').modal('show');
                cpuHide();
            });
            // REMOVE BUTTON CANCEL
            $("#btn-cancel").click(function(){
                $('#confirmModal').modal('hide');
                cpuShowText("Borrado de calle cancelado");
            });
            // REMOVE BUTTON CONFIRM
            $("#btn-confirm").click(function(){
                deleteAjax(activeMarker.id);
            });

            // HIDE INPUT WHEN UNSELECT CHECKBOX STREET NAME 
            // Rename streets fields display
            $(".checkbox-text").on("click", function(){
                // Map id getted from checkbox value
                let fieldId = this.value;
                // Hide forms fields
                $("#input_map"+fieldId).slideToggle(200, function(){
                    // Disable inputs to do not send
                    $("#input_map"+fieldId).prop("disabled", function(){
                        return !($(this).prop("disabled"));
                    });
                });
            });
            
            // CLEAN SEARCH FIELD ON MAP CLICK
            map.on("click", function(){
                $('#streetsFound').empty();
            });

            //-------------------------------------------------------------}}
            //------------------------ AUXILIAR METHODS -------------------}}
            //-------------------------------------------------------------}}
            //PREPARES AND SHOWS THE FORM
            function showCreateForm(lat, lng) {
                action = "create";
                // Create form attributes
                $("#modal-form").attr("action", "{{route('street.store')}}");
                $("input[name='_method']").val("POST");
                // Clear fields
                $("select[name='type_id']").val("");
                $("input[name='name']").val("");
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
            function showEditForm(street) {
                action = "update";
                // Edit form attributes
                $("#modal-form").attr("action", "{{route('street.store')}}/"+street.id);
                $("input[name='_method']").val("PUT");
                $(".inputs-errors").html("");
                // Fill inputs fields
                $("select[name='type_id']").val(street.type_id);
                $("input[name='name']").val(street.name);
                // Fill hidden values
                console.log(activeMarker);
                $("#modal-lat").val(activeMarker._latlng.lat);
                $("#modal-lng").val(activeMarker._latlng.lng);
                $(".modal-body #id").val(street.id);

                // Clear maps alternatives names fields
                let mapsList = $("input[name='maps_name[]']");
                for (let i = 0; i < mapsList.length; i++) {
                    mapsList[i].value = "";
                    $(mapsList[i]).hide();
                    $(mapsList[i]).prop("disabled", true);
                    $("#checkbox_map"+mapsList[i].id.substring(9)).prop("checked", false);
                }
                // Uncheck maps
                // Fill alternatives names
                for (let i = 0; i < street.maps.length; i++) {
                    $("#checkbox_map"+street.maps[i].id).prop("checked", true);
                    $("#input_map"+street.maps[i].id).prop("disabled", false);
                    $("#input_map"+street.maps[i].id).show();
                    if(street.maps[i].pivot.alternative_name !== null){
                        $("#input_map"+street.maps[i].id).val(street.maps[i].pivot.alternative_name);
                    }
                }

                $("#modal-title").text("Editar vía");
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

            
            // GET DATA FROM THE FORM
            function getFormData(){
                var newStreet = {
                    type_id: $("select[name='type_id']").val(),
                    name: $("input[name='name']").val(),
                    maps_id: [],
                    maps_name: [],
                }
                $("input[name='maps_id[]']").each(function(e){
                    let cbMap = $(this);
                    let textMap = $(this).siblings("input");

                    if(cbMap.is(":checked")) {
                        newStreet.maps_id.push($(this).val());
                        if(textMap.val() != ""){
                            newStreet.maps_name.push(textMap.val());
                        } else {
                            newStreet.maps_name.push(null);
                        }
                    }
                });
                newStreet.lat = $("input[name='lat']").attr("value");
                newStreet.lng = $("input[name='lng']").attr("value");
                newStreet.id = $("input[name='id']").attr("value");
                
                return newStreet;
            };
            // FORMAT THE DATA SO WE CAN USE IT
            function formatStreetObject(data){
                //El formato que hay que copiar
                // console.log(streets[0]);

                // Objeto Street recuperado
                let formatedStreet = data.street;

                // Comletamos la información como la tiene Luis
                formatedStreet.type_id = parseInt(formatedStreet.type_id);
                // Puntos
                formatedStreet.points = data.points;
                // Mapas con los pivots
                formatedStreet.maps = data.maps;

                return formatedStreet;
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
                    console.log(e.target);
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
                    if(errors["type_id"] !== undefined) {
                        $('#maps-error').append("Tipo de vía requerido <br>")
                    }
                    if(errors["name"] !== undefined) {
                        $('#maps-error').append("Nombre de la vía requerido ")
                    }
                }
            };
            

            // AJAX METHODS
            function storeAjax(street){
                $.ajax({
                    url:"{{route('street.storeAjax')}}",
                    data: street,
                    success: function(data) {
                        let ajaxStreet = formatStreetObject(data);
                        
                        addStreetToArray(ajaxStreet);
                        
                        // CREATE A MARKER
                        var ajaxStreetMarker = L.marker(
                            [ajaxStreet.lat, ajaxStreet.lng], 
                            {
                                icon: markerImage, 
                                alt:ajaxStreet.id, 
                                id: ajaxStreet.id,
                                draggable:false,
                            }
                        );
                        ajaxStreetMarker.id = ajaxStreet.id;
                        
                        // ADD IT TO THE MAP
                        markersList.push(ajaxStreetMarker);
                        clusterMarkers.addLayer(ajaxStreetMarker);
                        
                        // ADD THE EVENTS
                        addMarkerEvents(ajaxStreetMarker);

                        // HIDE THE FORM
                        $("button[class='close']").click();
                        cpuShowText("Calle creada con exito");
                    },
                    error: function(data) {
                        // Se ha producido un error de validación
                        showValidationErrors(data);
                    },
                });
            };
            function updateAjax(street){
                $.ajax({
                    url:"{{route('street.updateAjax')}}",
                    data: street,
                    success: function(data) {
                        let ajaxStreetUpdated = formatStreetObject(data);

                        // Look for streets to be updated
                        let streetsToUpdate = new Array();
                        streets.forEach(street => {
                            if(street.id == ajaxStreetUpdated.id){
                                streetsToUpdate.push(street);
                            }                        
                        });

                        // Removes streets to be updated 
                        // First street to remove from array
                        let index = streets.indexOf(streetsToUpdate[0]);
                        // Removes as much as streets to delete length
                        streets.splice(index, streetsToUpdate.length);
                        markersList.splice(index, streetsToUpdate.length);

                        // Add updated streets to the array
                        addStreetToArray(ajaxStreetUpdated);

                        //Update the street markers
                        markersList.forEach(marker => {
                            if(marker.id == ajaxStreetUpdated.id){
                                marker._latlng = {lat:ajaxStreetUpdated.lat, lng:ajaxStreetUpdated.lng};
                            }
                        });
                        
                        // HIDE THE FORM
                        $("button[class='close']").click();
                        cpuShowText("Calle actualizada con exito");
                    },
                    error: function(data) {
                        // Se ha producido un error de validación
                        showValidationErrors(data);
                    },
                });
            };
            function updatePositionAjax(id, lat, lng){
                $.ajax({
                    url:"{{route('street.updatePositionAjax')}}",
                    data: {"id":id, "lat":lat, "lng":lng},
                    success: function(data) {
                        cpuShowText("Posición actualizada con exito");
                    },
                });
                
            }
            function deleteAjax(streetID){
              $.ajax({
                url:"{{route('street.destroyAjax')}}",
                data: {"id": streetID},
                success: function(data){

                    let streetsToDelete = new Array();
                    streets.forEach(street => {
                        if(street.id == streetID){
                            streetsToDelete.push(street);
                        }                        
                    });

                    // First street to remove from array
                    let index = streets.indexOf(streetsToDelete[0]);
                    // Removes as much as streets to delete length
                    streets.splice(index, streetsToDelete.length);
                    markersList.splice(index, streetsToDelete.length);
                    
                    clusterMarkers.removeLayer(activeMarker);
                    map.removeLayer(activeMarker);
                    cpuShowText("Calle borrada con exito");
                },
              })  
            };
            
            
            // STREET FOUND IN SEARCH BAR
            $(document).on("click","div.street",function(){
                console.log(this);
                $('#streetsFound').empty();
                let id = this.id;
                clusterMarkers.eachLayer(function(layer){
                    if(id == layer.id)
                        map.setView([layer.getLatLng().lat, layer.getLatLng().lng], 18);
                });
            });

            // Add a street and likely deprecated streets to global streets array
            function addStreetToArray(street){
                // Add actual street
                streets.push(street);
                // Check for deprecated street names in maps relationship
                if (street.maps.length > 0){
                    // Foreach street in map 
                    for (let i = 0; i < street.maps.length; i++) {
                        // Check alternatives street names in maps                            
                        if(street.maps[i].pivot.alternative_name !== null){
                            // New street object
                            let alternativeStreet = {...street};
                            // Update new object data
                            alternativeStreet.name = street.maps[i].pivot.alternative_name;
                            alternativeStreet.fullName = alternativeStreet.typeName + " " + alternativeStreet.name;
                            // Deprecated attribute
                            alternativeStreet.deprecated = true;
                            // Save deprecated street into array
                            streets.push(alternativeStreet);
                        }
                    }
                }
            }
        });
    </script>
    <script src="{{url('js/cPopUp.js')}}"></script>
    <script src="{{url('js/cMenu.js')}}"></script>
@endsection