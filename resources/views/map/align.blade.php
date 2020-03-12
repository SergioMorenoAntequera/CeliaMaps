<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Celia Maps</title>

    <!-- LEAFLET -->
    <script src="{{url('js/Leaflet/leaflet.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/leaflet.css')}}">
    <!-- Plugin toolbar -->
    <script src="{{url('js/Leaflet/pluginToolbar/leaflet.toolbar-src.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/pluginToolbar/leaflet.toolbar-src.css')}}">
    <!-- Plugin images -->
    <script src="{{url('js/Leaflet/pluginImages/leaflet.distortableimage.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/pluginImages/leaflet.distortableimage.css')}}">
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="{{url('js/mapBlMenu.js')}}"></script>
    <script src="{{url('js/mapFullScreenMenu.js')}}"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- PERSONAL CSS -->
    <link rel="stylesheet" href="{{url('/css/frontend.css')}}">
</head>
<body style="overflow: hidden;">
    
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
            <button type="submit">
                <img src="{{url('img/icons/save.png')}}" alt="">
            </button>
        </form>
    </div>

    <!-- Button to put it on full screen -->
    <div id="fullScreenMenu" style="right: 125px">
        <img src="{{url('/img/icons/fsMaximize.png')}}" alt="">
    </div>

    <script>
        // Pagina donde están los proveedores de mapas:
        // http://leaflet-extras.github.io/leaflet-providers/preview/index.html
        var map = L.map('map', {
            minZoom: 6,  //Dont touch, recommended
        });
        map.setView([36.844092, -2.457840], 14);
    
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
    
        //Here we are adding the images on top of the map
        map.whenReady(function() {

            //Añadimos los polígonos que nos ayudarán para alinear
            // CATEDRAL /////////////////////////////////////////////////////
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

            // OBISPO ORBERÁ /////////////////////////////////////////////////////
            var paseo = L.polygon([
                [36.84140409008731, -2.4636570926916073],
                [36.84146419394736, -2.463565888170392],
                [36.8403866104306, -2.4617153195696733],
                [36.83970398990894, -2.4605295467098314],
                [36.83934765098976, -2.459982201068001],
                [36.83926607919642, -2.460035604419602],
                [36.83964388466547, -2.4605992830366046]],
                { color: 'blue',}
            ).addTo(map);
            paseo.bindPopup("Calle Rambla Obispo Orberá");

            // PASEO /////////////////////////////////////////////////////////////
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

            // AVENIDA FEDERICO GARCÍA LORCA /////////////////////////////////////////////////////////////
            var federico = L.polygon([
                [36.84138691754718, -2.458614455011248],
                [36.841189433058595, -2.4581316075459974],
                [36.83638095770797, -2.461345009137555],
                [36.83500275858721, -2.4622515819394235],
                [36.83390361625576, -2.4629167348853254],
                [36.83421704517093, -2.4636410060832015],
                [36.834959823636304, -2.4630081653594975],
                [36.83526466126582, -2.462723851203919],
                [36.83632943669233, -2.462063749221704],
                [36.837093661530595, -2.461505868022207],
                [36.8375659314896, -2.4611786529213524],
                ],
                { color: 'blue',}
            ).addTo(map);
            federico.bindPopup("Avenida Federico García Lorca");

            // PLAZA DE TOROS ////////////////////////////////////////////////////
            var plazaDeToros = L.circle([36.84686046942511, -2.4616509675979614], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 35
            }).addTo(map);
            plazaDeToros.bindPopup("Plaza de toros de Almería.");
            
            //Añadimos las imágenes y sus propiedade
            var cornerCheck = {{$map->tlCornerLatitude}}0;
            console.log(cornerCheck);
            var img = 0;
            if (cornerCheck !== 0) {
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

            //Imagen si este tiene esquinas registradas(Ya ha sido colocado)
            
            //Añadimos la imagen al mapa
            map.addLayer(img);
            
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
    </script>

</body>
</html>