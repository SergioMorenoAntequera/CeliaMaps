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

    <script src="{{url('js/mapBlMenu.js')}}"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- PERSONAL CSS -->
    <link rel="stylesheet" href="{{url('/css/Frontend.css')}}">
</head>
<body style="overflow: hidden;">
    
    <div id="map"></div>

    <div id="saveMenu">
        <a href=""><button> <i class="fa fa-save fa-5x"></i> </button></a>
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

            //Añadimos los polígonos que nos ayudarán para alinear
            var catedral = L.polygon([
                [36.83843318327438, -2.4676001071929936],
                [36.838274330960374, -2.467042207717896],
                [36.83828291758038, -2.4669617414474487],
                [36.838218517906846, -2.466913461685181],
                [36.838179878076694, -2.4669617414474487],
                [36.83814982486198, -2.4669027328491215],
                [36.837844998731036, -2.4670314788818364],
                [36.83789222539424, -2.467219233512879],
                [36.83761315832511, -2.4673479795455937],
                [36.837772012012366, -2.4679058790206914]],
                {color: 'red',}
            ).addTo(map);
            catedral.bindPopup("Catedral de Almería.");
            //Paseo de Almería
            var paseo = L.polygon([
                [36.8413697450032, -2.4639040231704716],
                [36.84138262441155, -2.463791370391846],
                [36.8354406937098, -2.4628579616546635],
                [36.83526466126582, -2.462723851203919],
                [36.834959823636304, -2.4630081653594975],
                [36.83531618299866, -2.4629491567611694]],
                { color: 'blue',}
            ).addTo(map);
            paseo.bindPopup("Paseo de Almería.");
            //Plaza de toros
            var plazaDeToros = L.circle([36.84686046942511, -2.4616509675979614], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 35
            }).addTo(map);
            plazaDeToros.bindPopup("Plaza de toros de Almería.");
            
            
            //Añadimos las imágenes y sus propiedades
            //URL de la imagen
            var img = L.distortableImageOverlay("{{url('img/maps/'.$map->image.'')}}", {
                //HAcemos que no pue pueda editar
                selected: true,
                actions: [L.ScaleAction, L.FreeRotateAction, L.RotateAction , L.DistortAction, L.EditAction, L.BorderAction, L.OpacityAction, L.RevertAction, L.LockAction, L.DeleteAction],
                corners: [
                    L.latLng('{{$map->tlCornerLatitude}}', '{{$map->tlCornerLongitude}}'),
                    L.latLng('{{$map->trCornerLatitude}}', '{{$map->trCornerLongitude}}'),
                    L.latLng('{{$map->blCornerLatitude}}', '{{$map->blCornerLongitude}}'),
                    L.latLng('{{$map->brCornerLatitude}}', '{{$map->brCornerLongitude}}'),
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