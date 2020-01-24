<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Celia Maps</title>

    <!-- LEAFLET -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
    <script src="{{url('/js/leaflet-providers.js')}}"></script> 
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- PERSONAL CSS -->
    <link rel="stylesheet" href="{{url('/css/frontend.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body >
    <div id="mapid"></div>

    <!-- Upper left menu for the maps -->
    <div id="mapsMenu">
        <div id="mapsTrans">
            <h1> <b>Mapas:</b></h1>
            @foreach ($maps as $map)
                <div id="mapTrans{{$map->id}}" class="mapTrans">
                    <!-- The eye and thr title -->
                    <div class="contEye">
                        <i class="eye fa fa-eye fa-2x"></i><h2 class="title">{{$map->title}}</h2>
                    </div>
                    <!-- The slider and the -->
                    <div class="contSlider">
                        <input type="range" min="0" max="100" value="50" class="slider" id="transparency{{$map->id}}">
                        <span class="opacity">50</span>
                    </div>
                </div>
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
    

    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="{{url('js/tlMenu.js')}}"></script>
    <script>
    // Pagina donde están los proveedores de mapas:
    // http://leaflet-extras.github.io/leaflet-providers/preview/index.html
    var map = L.map('mapid', {
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

    map.addLayer(mapTile0);
    
    $(document).ready(function(){
        // Change kind of map in the background ///////////////////////////////////////////////////
        $('.tiles').click(function() {
            var parent = $('#tileChooser');
            mapTiles.forEach(function(e){
                map.removeLayer(e);
            });
            map.addLayer(mapTiles[parent.children().index($(this))]);
        });

        // We hide the menu and all that //////////////////////////////////////////////////////////
        $('#tilesShow').click(function(){
            var icono = $(this).find('i');
            var chooser = $(this).siblings();

            if(icono.hasClass("fa-chevron-down")){
                icono.removeClass("fa-chevron-down");
                icono.addClass("fa-chevron-up");
                $(this).parent().animate({
                    bottom: "-100px",
                }, 300);
            } else {
                icono.removeClass("fa-chevron-up");
                icono.addClass("fa-chevron-down");
                $(this).parent().animate({
                    bottom: "15px",
                }, 300);
            }
        });
    });

    </script>

</body>
</html>