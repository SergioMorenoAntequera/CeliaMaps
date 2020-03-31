
@extends('layouts.master')

@section('title', 'Celia Maps')

@section('cdn')
    <!-- LEAFLET -->
    <script src="{{url('js/Leaflet/leaflet.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/leaflet.css')}}">
    <!-- Plugin toolbar -->
    <script src="{{url('js/Leaflet/pluginToolbar/leaflet.toolbar-src.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/pluginToolbar/leaflet.toolbar-src.css')}}">
    <!-- Plugin images -->
    <script src="{{url('js/Leaflet/pluginImages/leaflet.distortableimage.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/pluginImages/leaflet.distortableimage.css')}}">
    <!-- Plugin markers -->
    <script src="{{url('js/Leaflet/pluginMarkers/leaflet-geoman.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/pluginMarkers/leaflet-geoman.css')}}">
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="{{url('js/mapBlMenu.js')}}"></script>
    <script src="{{url('js/mapFullScreenMenu.js')}}"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- PERSONAL CSS -->
    <link rel="stylesheet" href="{{url('/css/frontend.css')}}">
@endsection

@section('content')

    {{-- To get the main point from the settings database --}}
    <script> var mainPoint = @json($mainPoint); </script>
    <div id="map"></div>

    <!-- Bottom left menu for the maps -->
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

    <!-- Button to save the alignment when it's done -->
    <div id="saveMenu">
        <form id="saveForm" method="GET" action="{{route('map.saveAlign', $map->id)}}">
            @csrf
            <input name="tlLat" type="hidden" value="{{$map->tlCornerLatitude}}">
            <input name="tlLon" type="hidden" value="{{$map->tlCornerLongitude}}">
            <input name="trLat" type="hidden" value="{{$map->trCornerLatitude}}">
            <input name="trLon" type="hidden" value="{{$map->trCornerLongitude}}">
            <input name="blLat" type="hidden" value="{{$map->blCornerLatitude}}">
            <input name="blLon" type="hidden" value="{{$map->blCornerLongitude}}">
            <input name="brLat" type="hidden" value="{{$map->brCornerLatitude}}">
            <input name="brLon" type="hidden" value="{{$map->brCornerLongitude}}">
            <button type="submit" id="saveButton" class="menu">
                <img src="{{url('img/icons/save.png')}}" alt="">
            </button>
        </form>
    </div>

    <!-- Button to put it on full screen -->
    <div id="fullScreenMenu" style="right: 180px">
        <img src="{{url('/img/icons/fsMaximize.png')}}" alt="">
    </div>

    
@endsection

@section('scripts')

    {{---------------------------------------------------------------}}
    {{-- ALL OF THE PARTS RELATED WITH SHOWING THE MAPS AND LAYERS --}}
    {{---------------------------------------------------------------}}
    <script>
        // Pagina donde están los proveedores de mapas:
        // http://leaflet-extras.github.io/leaflet-providers/preview/index.html
        var map = L.map('map', {
            minZoom: 6,  //Dont touch, recommended
        });

        map.setView([mainPoint.lat, mainPoint.lng], mainPoint.zoom);

        //Global maps from the one we will be able to pick one
        var mapTiles = [
            mapTile0 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19, //Dont touch, max zoom
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }),
            mapTile1 = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-lite/{z}/{x}/{y}{r}.png', {
                attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 20, //Dont touch, max zoom
                subdomains: 'abcd',
            }),
            mapTile2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 20, //Dont touch, max zoom
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
            })
        ];
        
        //Adding rhe layers to the map
        map.addLayer(mapTile0);
    </script>

    {{---------------------------------------------------------------}}
    {{------ ALL THE PARTS OF THE MARKERS AND THE MAP TO ALIGN ------}}
    {{---------------------------------------------------------------}}
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
    
    <script>
        // When the map is ready
        map.whenReady(function() {

            //Añadimos las formas de ayuda que llegan de la base de datos
            addMarkersJS();
            
            var img = addMapImg();

            // Codigo del botón de guardar
            $('#saveMenu').click(function(e){
                e.preventDefault();
                var corners = img.getCorners();
                var test = jQuery($("#saveForm").children()[1]).attr("value", corners[0].lat);
                var test = jQuery($("#saveForm").children()[2]).attr("value", corners[0].lng);
                var test = jQuery($("#saveForm").children()[3]).attr("value", corners[1].lat);
                var test = jQuery($("#saveForm").children()[4]).attr("value", corners[1].lng);
                var test = jQuery($("#saveForm").children()[5]).attr("value", corners[2].lat);
                var test = jQuery($("#saveForm").children()[6]).attr("value", corners[2].lng);
                var test = jQuery($("#saveForm").children()[7]).attr("value", corners[3].lat);
                var test = jQuery($("#saveForm").children()[8]).attr("value", corners[3].lng);
                $("#saveForm").submit();
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

                } else if(markerJS.type == "line"){
                    //Si es una linea
                    var linePoints = [];
                    markerJS.points.forEach(point => {
                        linePoints.push([point.lat, point.lng]);
                    });
                    layer = L.polyline([linePoints]);
                    
                } else if(markerJS.type == "circle") {
                    // Si es un Circulo
                    layer = L.circle([markerJS.points[0].lat, markerJS.points[0].lng], {
                        color: 'rgb(51, 136, 255)',
                        fillColor: 'rgb(51, 136, 255)',
                        fillOpacity: 0.2,
                        radius: markerJS.radius,
                    });

                } else if(markerJS.type == "marker") {
                    // Si es un marcador
                    layer = L.marker([markerJS.points[0].lat, markerJS.points[0].lng]).addTo(map);
                }

                if(markerJS.name != ""){
                    layer.bindPopup(markerJS.name);
                }
                
                layer.addTo(map);
            });
        };

        // Añade el mapa que hay que alinear
        function addMapImg(){
            //Añadimos las imágenes y sus propiedade
            var cornerCheck = "{{$map->tlCornerLatitude}}";
            var img = 0;
            if (cornerCheck !== "") {
                img = L.distortableImageOverlay("{{url('img/maps/'.$map->image.'')}}", {
                    //Hacemos que se pueda editar
                    selected: true,
                    actions: [L.ScaleAction, L.RotateAction,  L.FreeRotateAction, L.DistortAction, L.EditAction, L.BorderAction, L.OpacityAction, L.RevertAction, L.LockAction],
                    corners: [
                        L.latLng('{{$map->tlCornerLatitude}}', '{{$map->tlCornerLongitude}}'),
                        L.latLng('{{$map->trCornerLatitude}}', '{{$map->trCornerLongitude}}'),
                        L.latLng('{{$map->blCornerLatitude}}', '{{$map->blCornerLongitude}}'),
                        L.latLng('{{$map->brCornerLatitude}}', '{{$map->brCornerLongitude}}'),
                    ],
                });
            } else {
                img = L.distortableImageOverlay("{{url('img/maps/'.$map->image.'')}}", {
                    //Hacemos que se pueda editar
                    selected: true,
                    actions: [L.ScaleAction, L.RotateAction,  L.FreeRotateAction, L.DistortAction, L.EditAction, L.BorderAction, L.OpacityAction, L.RevertAction, L.LockAction],
                });
            }
            //Añadimos la imagen al mapa
            map.addLayer(img);
            
            return img;
        };

    </script>

@endsection
