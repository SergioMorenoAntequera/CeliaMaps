<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Celia Maps</title>

    <!-- LEAFLET -->
    <script src="{{url('/js/Leaflet/leaflet.js')}}"></script>
    <link rel="stylesheet" href="{{'/js/Leaflet/leaflet.css'}}">
    <!-- Plugin toolbar -->
    <script src="{{url('/js/Leaflet/pluginToolbar/leaflet.toolbar-src.js')}}"></script>
    <link rel="stylesheet" href="{{'/js/Leaflet/pluginToolbar/leaflet.toolbar-src.css'}}">
    <!-- Plugin images -->
    <script src="{{url('/js/Leaflet/pluginImages/leaflet.distortableimage.js')}}"></script>
    <link rel="stylesheet" href="{{'/js/Leaflet/pluginImages/leaflet.distortableimage.css'}}">

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- PERSONAL CSS -->
    <link rel="stylesheet" href="{{url('/css/Frontend.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{url('js/mapTlMenu.js')}}"></script>
    <script src="{{url('js/mapBlMenu.js')}}"></script>
</head>
<body>
    <div id="map"></div>

    <!-- Upper left menu for the maps -->
    <div id="mapsMenu">
        <div id="mapsTrans">
            <h1> <b>Mapas:</b></h1>
            @foreach ($maps as $map)
                @if ($map->level == 1)
                    <div id="mapTrans{{$map->id}}" class="mapTrans">
                        <!-- The eye and thr title -->
                        <div class="contEye">
                            <i class="eye fa fa-eye fa-2x"></i><h2 class="title">{{$map->title}}</h2>
                        </div>
                        <!-- The slider and the number-->
                        <div class="contSlider">
                            <input type="range" min="0" max="100" value="50" class="slider" id="transparency{{$map->id}}">
                            <span class="opacity">50</span>
                        </div>
                        
                    </div>
                @else
                    <div id="mapTrans{{$map->id}}" class="mapTrans">
                        <!-- The eye and thr title -->
                        <div style="opacity:0.50;" class="contEye">
                            <i class="eye fa fa-eye-slash fa-2x"></i><h2 class="title">{{$map->title}}</h2>
                        </div>
                        <!-- The slider and the number-->
                        <div style="display: none;" class="contSlider">
                            <input type="range" min="0" max="100" value="50" class="slider" id="transparency{{$map->id}}">
                            <span class="opacity">0</span>
                        </div>
                    </div>
                @endif
            @endforeach
            <div>
                <button> Quitar todos</button>
            </div>  
        </div>
        
        <br>
        <div id="mapsShow">
            <i class="fa fa-chevron-up"></i>
        </div>
    </div>

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
    
    <script>
    // Pagina donde están los proveedores de mapas:
    // http://leaflet-extras.github.io/leaflet-providers/preview/index.html
    var map = L.map('map', {
        minZoom: 6,  //Dont touch, recommended
        maxZoom: 18, //Dont touch, max zoom
    });
    map.setView([36.844092, -2.457840], 14);

    //Global maps from the one we will be able to pick one
    var mapTiles = [
        mapTile0 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }),
        mapTile1 = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-lite/{z}/{x}/{y}{r}.png', {
            attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            subdomains: 'abcd',
        }),
        mapTile2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        })
    ];
    //Adding rhe layers to the map
    map.addLayer(mapTile0);

    //Here we are adding the images on top of the map
    map.whenReady(function() {
        //Añadimos las imágenes y sus propiedades
        //URL de la imagen
        var img = L.distortableImageOverlay("{{url('img/maps/NoMap.png')}}", {
            //HAcemos que no pue pueda editar
            editable: false,
            corners: [
                L.latLng('{{$maps[0]->tlCornerLatitude}}', '{{$maps[0]->tlCornerLongitude}}'),
                L.latLng('{{$maps[0]->trCornerLatitude}}', '{{$maps[0]->trCornerLongitude}}'),
                L.latLng('{{$maps[0]->blCornerLatitude}}', '{{$maps[0]->blCornerLongitude}}'),
                L.latLng('{{$maps[0]->brCornerLatitude}}', '{{$maps[0]->brCornerLongitude}}'),
            ],
            //actions: [L.ScaleAction, L.RotateAction, L.FreeRotateAction, L.DistortAction, L.EditAction, L.BorderAction, L.OpacityAction, L.RevertAction, L.LockAction, L.DeleteAction],     
        });
        //Añadimos la imagen al mapa
        map.addLayer(img);

        $('#map').on('click', function(ev){
            var latlng = map.mouseEventToLatLng(ev.originalEvent);
            console.log(latlng.lat + ', ' + latlng.lng);
        });
    });
    </script>
</body>
</html>