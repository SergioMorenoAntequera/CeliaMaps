<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Celia Maps</title>

    <!-- LEAFLET -->
    <script src="{{url('js/Leaflet/leaflet.js')}}"></script>
    <link rel="stylesheet" href="{{'js/Leaflet/leaflet.css'}}">
    <!-- Plugin toolbar -->
    <script src="{{url('js/Leaflet/pluginToolbar/leaflet.toolbar-src.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/pluginToolbar/leaflet.toolbar-src.css')}}">
    <!-- Plugin images -->
    <script src="{{url('js/Leaflet/pluginImages/leaflet.distortableimage.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/pluginImages/leaflet.distortableimage.css')}}">

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- PERSONAL CSS -->
    <link rel="stylesheet" href="{{url('/css/frontend.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">    
    <script>
    // Put all locations into array
    var map;
    var activeMarkers = [];
    var tokenIcon = L.icon({
        iconUrl: "{{url('img/icons/token.svg')}}",
        iconSize:     [40, 100], // size of the icon
        iconAnchor:   [15, 60], // point of the icon which will correspond to marker's location
    });
    var hotspotsFull = [
        @foreach ($hotspots as $hotspot)
            {title:"{{ $hotspot->title }}", image:"{{$hotspot->image}}", lat:"{{ $hotspot->lat }}", lng:"{{ $hotspot->lng }}" }, 
        @endforeach
    ];
    </script>
    <script src="{{url('js/mapTlMenu.js')}}"></script>
    <script src="{{url('js/mapBlMenu.js')}}"></script>
    <script src="{{url('js/mapFullScreenMenu.js')}}"></script>
</head>

<body id="body">
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
        <div id="ballHotspots" class="ball noselect">
            <div class="ballContent">
                <img style="opacity: 0.2" class="noselect" src="{{url('img/icons/tlMenuToken.png')}}" title="Puntos de interés">
            </div>
        </div>

        {{-- CONTENIDO DE MENÚ --}}
        {{-- Todos los menús que podemos poner --}}

        {{-- Menú de los mapas --}}
        <div id="mapsMenu" style="font-family: Arial, Helvetica, sans-serif" class="menu noselect">
                <!-- Todo el menú -->
                <div class="closeMenuButton">
                    <i class="fa fa-times"></i>
                </div>
                <div class="pinMenuButton ">
                    <img class="pinIcon" src="{{url('/img/icons/pin.svg')}}" alt="">
                </div>

                <img src="{{url('img/icons/tlMenuMap.png')}}" title="Mapas">
                <div id="mapsTrans">
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
            
        {{-- Manú de los hotspots --}}
        {{-- <div id="hotspotsMenu" class="menu noselect">

            <div class="closeMenuButton">
                <i class="fa fa-times"></i>
            </div>

            <div class="pinMenuButton ">
                <img class="pinIcon" src="{{url('/img/icons/pin.svg')}}" alt="">
            </div>

            <img class="noselect" src="{{url('img/icons/tlMenuToken.png')}}" title="Puntos de interés">
            <div id="hotspotsContent">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium deserunt sint omnis, fuga nam blanditiis qui pariatur quidem repellat labore facere consequatur neque accusamus amet aspernatur fugit, enim aliquid autl!
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis architecto odit itaque incidunt necessitatibus cum, soluta quam beatae vel odio reiciendis repudiandae nam nobis optio vero corporis voluptatibus earum similique.
            </div>
        </div> --}}

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
                    var hotspots = [];
                    //When we first click in the search bar (AJAX)
                    $("#streetsInput").on("focusin", function(e){
                        if($(this).val().length == 0){
                            var url = window.location.href + "map/search";
                            $.ajax({
                                type: 'GET',
                                url: url,
                                // data: { text : text },
                                success: function(data) {
                                    $('#streetsFound').empty();
                                    streets = [];
                                    hotspots = [];
                                    
                                    data.streets.forEach(street => {
                                        street.fullName = street.typeName + " " + street.name;
                                        streets.push(street);
                                    });
                                    hotspots = data.hotspots;
                                },
                            }); // FIN AJAX
                        } else {
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
                        hotspots.forEach(hotspot => {
                            if(hotspot.title.toLowerCase().includes($('#streetsInput').val().toLowerCase())){
                                $('#streetsFound').append("<div class='hotspot street'> <img style='width:5%;' src='{{url('img/icons/token.svg')}}'>"+ hotspot.title + "</div>");
                                if(++c == 5){
                                    return;
                                }  
                            }
                        });
                        c = 0;
                        streets.forEach(street => {
                            if(street.name.toLowerCase().includes($('#streetsInput').val().toLowerCase())){
                                $('#streetsFound').append("<div class='street'> <img style='width:5%;' src='{{url('img/icons/token-selected.svg')}}'>"+ street.fullName + "</div>");
                                if(++c == 5){
                                    return;
                                }                                
                            }
                        });
                    }
                </script>
            </div>
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

        //Here we are adding the images(of the diferent maps) on top of the map
        map.whenReady(function() {
            //Añadimos la primera imagen para que se vea algo
            map.addLayer(images[0]);

            // map.on('click', function(e) {
            //     console.log(map._layers );
            //     console.log(e.latlng .lat + ", " + e.latlng.lng);    
            // });
        });

        
        // Creamos los iconos del marcador
        let markerHotspot = L.icon({
            iconUrl: "{{url('img/icons/token.svg')}}",
            iconSize:     [40, 100],
            iconAnchor:   [15,60],
        });
        let markerStreet = L.icon({
            iconUrl: "{{url('img/icons/token-selected.svg')}}",
            iconSize:     [40, 100],
            iconAnchor:   [15,60],
        });
        // Creamos un marcador global
        let marker = L.marker([0,0],{icon:markerStreet ,opacity:0});
        marker.addTo(map);


        // Barra de busqueda y como nos mueve al punto en el que se encuentre el 
        // hotspot o la calle en la que se pinche
        $('#streetsFound').on('click', '.street', function(){
            var lat, lng;
            
            hotspots.forEach(hotspot => {
                if($(this).text().trim() == hotspot.title){
                    lat = hotspot.lat;
                    lng = hotspot.lng;
                    return;
                }
            });
            streets.forEach(street => {
                if($(this).text().trim() == street.fullName){
                    lat = street.lat;
                    lng = street.lng;
                    return;
                }
            });

            // Comprobamos el tipo de marcador a mostrar para elegir icono
            if($(this).hasClass("hotspot")){
                marker.setIcon(markerHotspot);
            }else{
                marker.setIcon(markerStreet);
            }
            // Ubicamos el marcador en la posicion de la calle
            marker.setLatLng([lat,lng]);
            // Mostramos el marcador
            marker.setOpacity(1);

            // Centramos la pantalla en el marcador de la calle
            map.setView([lat, lng], 18);

            $('#streetsFound').empty();
        });
    </script>
</body>
</html>