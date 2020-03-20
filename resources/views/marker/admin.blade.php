@extends('layouts.master')

@section('title', 'Celia Maps')

@section('cdn')
    <!-- LEAFLET -->
    <script src="{{url('js/Leaflet/leaflet.js')}}"></script>
    <link rel="stylesheet" href="{{'js/Leaflet/leaflet.css'}}">
    <!-- Plugin Marker -->
    <script src="{{url('js/Leaflet/pluginMarkers/leaflet-geoman.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/pluginMarkers/leaflet-geoman.css')}}">
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- PERSONAL CSS -->
    <link rel="stylesheet" href="{{url('/css/frontend.css')}}">
    <link rel="stylesheet" href="{{url('/css/Backend.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
            <img src="{{url('img/icons/fsMaximize.png')}}" alt="">
        </div>

        {{-------------------------------------------------------------}}
        {{-------- MENU THAT APPEARS WHEN YOU CLICK IN THE MAP --------}}
        {{-------------------------------------------------------------}}
        <div class="cMenu">
            {{-- Se muestra este si se clicka en el mapa --}}
            <div class="add hidden">
                <div class="option addMarker"> <img src="{{url('js/Leaflet/pluginMarkers/img/marker.svg')}}" alt=""> </div>
                <div class="option addCircle"> <img src="{{url('js/Leaflet/pluginMarkers/img/circle.svg')}}" alt=""> </div>
                <div class="option addRectangle"> <img src="{{url('js/Leaflet/pluginMarkers/img/rectangle.svg')}}" alt=""> </div>
                <div class="option addPolygon"> <img src="{{url('js/Leaflet/pluginMarkers/img/polygon.svg')}}" alt=""> </div>
                <div class="option addLine"> <img src="{{url('js/Leaflet/pluginMarkers/img/line.svg')}}" alt=""> </div>
            </div>
            {{-- Se muestra este si se clicka en una layer compleja --}}
            <div class="edit4 hidden">
                <div class="option"> pra </div>
                <div class="option"> pra </div>
                <div class="option"> pra </div>
                <div class="option"> pra </div>
            </div>
            {{-- Se muestra este si se clicka en una layer simple --}}
            <div class="edit3 hidden">
                <div class="option"> pra </div>
                <div class="option"> pra </div>
                <div class="option"> pra </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
        map.whenReady(function() {
            // add leaflet-geoman controls with some options to the map
            map.pm.addControls({
                position: 'topleft',
                drawCircle: false,
            });

            // SHOW MENU
            map.on('click', function(e){
                // We place the menu in the middle
                let localClicks = {top: e.originalEvent.clientY - 30, left: e.originalEvent.clientX - $("#leftNavBar").width() - 30};
                $(".cMenu").css({top:localClicks.top, left:localClicks.left});
                
                // Prepare the options
                let options = $(".cMenu").find(".add").find(".option");
                for (let i = 0; i < options.length; i++) {
                    const option = jQuery(options[i]);
                    let optionX = ( Math.sin( i / options.length * 2 * Math.PI) * 50) + 5;
                    let optionY = ( Math.cos( i / options.length * 2 * Math.PI) * 50) + 5;
                    option.css({top:optionY, left:optionX});
                }

                // Select the menu that we want to show (the add one in this case) and show it
                $(".cMenu").children().hide();
                $(".cMenu").find(".add").show();
                $(".cMenu").fadeIn(200);
            });

            // HIDE MENU
            map.on('move', function(e) { $(".cMenu").fadeOut(200); });

            // // enable polygon drawing mode
            // map.pm.enableDraw('Polygon', {
            //     snappable: true,
            //     snapDistance: 20,
            //     tooltips: true,
            // });

            var layer;
            map.on('pm:create', e => {
                console.log("EN: pm:create");
                console.log(e);
                layer = e.layer;
                layer.on('click', e => {
                    console.log("CLICK")
                    console.log(e);
                }); 
                console.log(layer);
            });

            

            map.pm.Draw.getShapes();
        });
    </script>

    <script src="{{url('js/mapBlMenu.js')}}"></script>
    <script src="{{url('js/mapFullScreenMenu.js')}}"></script>
@endsection