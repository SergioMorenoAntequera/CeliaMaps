@extends('layouts.master')

@section('title', 'Celia Maps')

@section('cdn')
    <!-- LEAFLET -->
    <script src="{{url('js/Leaflet/leaflet.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/leaflet.css')}}">
    <!-- Plugin Marker -->
    <script src="{{url('js/Leaflet/pluginMarkers/leaflet-geoman.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/pluginMarkers/leaflet-geoman.css')}}">
    
    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    {{-- BOOTSTRAP --}}
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- PERSONAL CSS -->
    <link rel="stylesheet" href="{{url('/css/frontend.css')}}">
    <link rel="stylesheet" href="{{url('/css/Backend.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@endsection

@section('content')
    <!-- Div where the map and all the menus will
    go so we are able to drag booth the menues and go 
    trought the map -->
    <div id="draggableArea">

        {{-- Mapa --}}
        <div id="map"></div>

        {{-----------------------------------------------------------}}
        {{-- BOTTOM LEFT MENU TO CHANGE THE KIND OF MAP TO DISPLAY --}}
        {{-----------------------------------------------------------}}
        <div id="tilesMenu">
            <div id="tilesShow">
                <i class="fa fa-chevron-down"></i>
            </div>
            <div id="tileChooser">
                <div class="tiles"> 
                    <img src="{{url("img/maps/KindOfMap1.png")}}">
                </div>
                <div class="tiles"> 
                    <img src="{{url("img/maps/KindOfMap2.png")}}">
                </div>
                <div class="tiles"> 
                    <img src="{{url("img/maps/KindOfMap3.png")}}">
                </div>
            </div>
        </div>


        {{-------------------------------------------------------------}}
        {{-- BOTTOM RIGHT MENU SO WE CAN DISPLAY S WE CAN FULLSCREEN --}}
        {{-------------------------------------------------------------}}
        <div id="fullScreenMenu">
            <img src="{{url('img/icons/fsMaximize.png')}}">
        </div>

        {{-------------------------------------------------------------}}
        {{-------- MENU THAT APPEARS WHEN YOU CLICK IN THE MAP --------}}
        {{-------------------------------------------------------------}}
        <div class="cMenu noselect">
            {{-- Se muestra este si se clicka en el mapa --}}
            <div class="csMenu add">
                <div class="option" action="Remove"> <img src="{{url('js/Leaflet/pluginMarkers/img/remove.svg')}}"> </div>
                <div class="option" action="Marker"> <img src="{{url('js/Leaflet/pluginMarkers/img/marker.svg')}}"> </div>
                <div class="option" action="Circle"> <img src="{{url('js/Leaflet/pluginMarkers/img/circle.svg')}}"> </div>
                <div class="option" action="Rectangle"> <img src="{{url('js/Leaflet/pluginMarkers/img/rectangle.svg')}}"> </div>
                <div class="option" action="Polygon"> <img src="{{url('js/Leaflet/pluginMarkers/img/polygon.svg')}}"> </div>
                <div class="option" action="Line"> <img src="{{url('js/Leaflet/pluginMarkers/img/line.svg')}}"> </div>
            </div>
            {{-- Se muestra este si se clicka en una layer --}}
            <div class="csMenu edit">
                <div class="option" action="Edit"> <img src="{{url('js/Leaflet/pluginMarkers/img/edit.svg')}}"> </div>
                <div class="option" action="Drag">  <img src="{{url('js/Leaflet/pluginMarkers/img/drag.svg')}}"> </div>
                <div class="option" action="Remove"> <img src="{{url('js/Leaflet/pluginMarkers/img/remove.svg')}}"> </div>
                <div class="option renameOption" action="Rename"> <img src="{{url('js/Leaflet/pluginMarkers/img/name.svg')}}"> </div>
            </div>
        </div>
        <div class="bubble rename">
            <input type="text" class="form-control" name="Rename" placeholder="Introduce nombre">
            <button type="submit" class="btn btn-success mt-2"> Confirmar </button>
            
            <div class="cornerButton" style="width: 40px; height: 40px"> 
                <img class="center" src="{{url('img/icons/close.svg')}}"> 
            </div>
        </div>
    </div>

    {{-- We prepare the php variables into JS --}}
    <script> var markersJS = []; </script>
    @foreach ($markers as $marker)
        <script>
            markersJS.push({
                "id":{{$marker->id}}, 
                "name":"{{$marker->name}}", 
                "type":"{{$marker->type}}",
                "radius":"{{$marker->radius}}",
                "points": [ 
                @foreach ($marker->points as $point)
                    {
                        "id":{{$point->id}},
                        "lat":{{$point->lat}},
                        "lng":{{$point->lng}},
                    },
                @endforeach
                ],
            });
        </script>
    @endforeach
    <script> var lastID = markersJS[markersJS.length-1].id;</script>
    {{-- Now we can work with the markers in JS (markersJS) --}}
    
@endsection

@section('scripts')
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    {{---------------------------------------------------------------}}
    {{-- ALL OF THE PARTS RELATED WITH SHOWING THE MAPS AND LAYERS --}}
    {{---------------------------------------------------------------}}
    <script>
        // Pagina donde están los proveedores de mapas:
        // http://leaflet-extras.github.io/leaflet-providers/preview/index.html
        map = L.map('map', {
            minZoom: 6,  //Dont touch, recommended
            zoomControl: false,
        });
        map.setView([36.83855339561703, -2.468887563476574], 14);
        
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
    </script>

    {{---------------------------------------------------------------}}
    {{-------- ALL THE PARTS RELATED WITH THE MARKERS PLUGIN --------}}
    {{---------------------------------------------------------------}}
    
    
    <script>
        
        $(document).ready(function(){
            var layer;
            var userBusy = false;
            var currentAction = "none";

            map.whenReady(function() {
                // We add the markers that come from the database
                addMarkersJS();

                // AÑADE TODOS LOS LESTENERS AL MAPA
                addMapListeners();

                // Comenzar una acción de las que salen en el menú ciruclar
                $(".option").on("click", function(e){
                    e.stopPropagation();
                    enableAction($(this).attr("action"));
                });
            });
            
            // Fución que añade todos los narcadres que llegan de la base de datos al principio
            function addMarkersJS(){
                markersJS.forEach(markerJS => {
                    //El resultado
                    var layer;
                    if(markerJS.type == "polygon"){
                        // Si es un polígono
                        var polygonPoints = [];
                        markerJS.points.forEach(point => {
                            polygonPoints.push([point.lat, point.lng]);
                        });
                        layer = L.polygon([polygonPoints]);

                        // Si es un Circulo
                    } else if(markerJS.type == "circle") {
                        layer = L.circle([markerJS.points[0].lat, markerJS.points[0].lng], {
                            color: 'rgb(51, 136, 255)',
                            fillColor: 'rgb(51, 136, 255)',
                            fillOpacity: 0.2,
                            radius: markerJS.radius,
                        });

                    }  else if(markerJS.type == "marker") {
                        // Si es un marcador
                        layer = L.marker([markerJS.points[0].lat, markerJS.points[0].lng]).addTo(map);
                    }
                    layer.db = {"id":markerJS.id, "name":markerJS.name, "type":markerJS.type, "points":markerJS.points, "radius":markerJS.radius}
                    layer.addTo(map);
                    addLayerListeners(layer);
                });
            };
            
            // Enseña el menú indicado en csMenu
            function showMenu(e, csMenu){
                // // We place the menu in the middle
                let localClicks = {top: e.originalEvent.clientY - 30, left: e.originalEvent.clientX - $("#leftNavBar").width() - 30};
                if(!userBusy){
                    if($(".cMenu").css("display") == "none"){
                        $(".cMenu").css({"left":localClicks.left, "top":localClicks.top});
                        $(".cMenu").show();

                        $("."+csMenu).fadeIn(150);
                        let options = $("."+csMenu).find(".option");
                        for (let i = 0; i < options.length; i++) {
                            jQuery(options[i]).animate({
                                top: (Math.sin( i / options.length * 2 * Math.PI) * 60) + 5, 
                                left: (Math.cos( i / options.length * 2 * Math.PI) * 60) + 5
                            }, 150);
                        }
                    } else { 
                        $(".cMenu").animate({"left":left, "top":top}, 150);
                    }
                }
            };

            // Oculta el menú que se esté mostrando
            function hideMenu(){
                if($(".cMenu").css("display") == "block"){
                    $(".cMenu").fadeOut(150, function(e){
                        // Por cada subMenu
                        $(".cMenu").children().each(function(e){
                            // Miramos si se está enseñando
                            if($(this).css("display") == "block"){
                                // Si lo está lo ocultamos
                                $(this).hide();
                                $(this).children().each(function(e) {
                                    $(this).css({top:5, left:5});
                                });
                            }
                        });
                    });
                }
            };

            // Ejecuta la acción que se le indique
            function enableAction(action){
                userBusy = true;
                currentAction = action;
                hideMenu();

                if(action == "Drag"){
                    map.pm.enableGlobalDragMode();
                } else if(action == "Remove") {
                    map.pm.enableGlobalRemovalMode();
                } else if(action == "Edit") {
                    map.pm.toggleGlobalEditMode(); 
                } else if(action == "Rename") {
                    userBusy = false;
                    currentAction = "none";
                } else if(action != undefined) {
                    map.pm.enableDraw(action, {
                        snappable: true,
                        snapDistance: 10,
                        tooltips: true,
                    });
                } else {
                    userBusy = false;
                    currentAction = "none";
                }
            };

            // Acciones que tienen que ver con el mapa
            function addMapListeners(){
                // We show the menu when we click
                map.on('click', function(e){
                    hideMenu();
                    $(".cMenu").fadeOut(150, function(){
                        showMenu(e, "add");                    
                    });
                });
                // We hide the menu when we move
                map.on('move', function(e) {
                    hideMenu();
                });
                //When we are done creating a new marker
                map.on('pm:create', e => {
                    // We let the user do other stuff
                    userBusy = false;
                    map.pm.disableDraw(currentAction);
                    currentAction = "none";
                    
                    // We add our layer
                    layer = e.layer;
                    addLayerListeners(layer);
                    
                    // Variable que mandamos al server para guardarla
                    layer.db = {"id":++lastID, "name":null};
                    if(layer._latlngs != undefined){
                        // Polygons
                        layer.db.type = "polygon";
                        layer.db.points = layer._latlngs[0];
                        layer.db.radius = null;
                    } else {
                        // Circle and Marker
                        if(layer.options.radius != undefined){
                            // Circle
                            layer.db.type = "circle";
                            layer.db.radius = layer.options.radius;
                        } else {
                            // Marker
                            layer.db.type = "marker";
                            layer.db.radius = null;
                        }
                        layer.db.points = layer._latlng;  
                    }
                    console.log("linea 331");
                    console.log(layer);
                });
                // Cuando acabe de borrar nos vuelva al estado normal
                map.on('pm:remove', e => {
                    if(map.pm.globalRemovalEnabled()){
                        map.pm.disableGlobalRemovalMode();
                        userBusy = false;
                    }
                });
                // Si se cancela el borrado nos vuelve al estado normal
                map.on('click', e => {
                    if(map.pm.globalRemovalEnabled()){
                        map.pm.disableGlobalRemovalMode();
                        userBusy = false;
                    }
                });
            };
            
            // Acciones que tienen que ver con las capas
            function addLayerListeners(layer) {
                // Listener de clickar en la layer
                layer.on('click', function(e) {
                    // Para no clickar el mapa
                    L.DomEvent.stopPropagation(e);
                    // Mostramos el menú de edición
                    hideMenu();
                    $(".cMenu").fadeOut(150, function(){
                        showMenu(e, "edit");
                    })
                    console.log("linea 361");
                    console.log(layer);
                });

                // Cunado acabe de mover nos vuelva al estado normal
                layer.on('pm:dragend', e => {
                    map.pm.disableGlobalDragMode();
                    userBusy = false
                });
                
                // Cunado acabe de editar nos vuelva al estado normal
                layer.on('pm:markerdragend', e => {
                    map.pm.disableGlobalEditMode(); 
                    userBusy = false
                });
            };

            // El rename ya que es más complicado
            $(".option[action='Rename']").click(function(e){
                let localClicks = {top: e.originalEvent.clientY - 30, left: e.originalEvent.clientX - $("#leftNavBar").width() - 30};
                $(".bubble.rename").css({top:localClicks.top - $(".bubble.rename").height(), left:localClicks.left - $(".bubble.rename").width() / 2});
                $(".bubble.rename").fadeIn(150);
            });
            $(".cornerButton").click(function(e){
                $(this).parent().fadeOut(150);
            });
        });
    </script>

    <script src="{{url('js/mapBlMenu.js')}}"></script>
    <script src="{{url('js/mapFullScreenMenu.js')}}"></script>
@endsection