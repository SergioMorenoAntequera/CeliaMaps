<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Celia Maps</title>
    <link rel="icon" type="image/png" href="{{url('img/icons/icon.png')}}" sizes="64x64">
    <!-- LEAFLET -->
    <script src="{{url('js/Leaflet/leaflet.js')}}"></script>
    <link rel="stylesheet" href="{{'js/Leaflet/leaflet.css'}}">
    <!-- Plugin toolbar -->
    <script src="{{url('js/Leaflet/pluginToolbar/leaflet.toolbar-src.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/pluginToolbar/leaflet.toolbar-src.css')}}">
    <!-- Plugin images -->
    <script src="{{url('js/Leaflet/pluginImages/leaflet.distortableimage.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/Leaflet/pluginImages/leaflet.distortableimage.css')}}">
    <!-- Plugin clustering markers -->
    <script src="{{url('/js/Leaflet/pluginClusteringMarkers/leaflet.markercluster.js')}}"></script>
    <link rel="stylesheet" href="{{url('/js/Leaflet/pluginClusteringMarkers/MarkerCluster.css')}}">
    <link rel="stylesheet" href="{{url('/js/Leaflet/pluginClusteringMarkers/MarkerCluster.Default.css')}}">
    
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- PERSONAL CSS -->
    <link rel="stylesheet" href="{{url('/css/frontend.css')}}"> 
    
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body id="body">
    <!-- Div where the map and all the menus will
    go so we are able to drag booth the menues and go 
    trought the map -->
    <div id="draggableArea">

        {{-- To get the main point in JS --}}
        <script> var mainPoint = @json($mainPoint); </script>
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
        <div id="ballStreets" class="ball noselect">
            <div class="ballContent">   
                <img style="width: 70%;position: absolute; top: 10%; left: 10%" class="noselect" src="{{url('img/icons/search.svg')}}" title="Buscador">
            </div>
        </div>
        <div id="ballMaps" class="ball noselect">
            <div class="ballContent">
                <img style="width: 90%;position: absolute;" class="noselect" src="{{url('img/icons/tlMenuMap.png')}}" title="Mapas">
            </div>
        </div>
        <div id="ballHotspots" class="ball noselect">
            <div class="ballContent">
                <img style="opacity: 0.2; position: absolute; bottom: 6%; right: 6%;" class="noselect" src="{{url('img/icons/tlMenuToken.png')}}" title="Puntos de interés">
            </div>
        </div>
        <div id="ballShowStreets" class="ball noselect">
            <div class="ballContent">
                <img style="width: 80%; position: absolute; top: 2%; right: 13%; opacity: 0.2;" class="noselect" src="{{url('img/icons/tlMenuStreet.png')}}" title="Calles">
            </div>
        </div>


        {{-- CONTENIDO DE MENÚ --}}
        {{-- Todos los menús que podemos poner --}}

        {{-- Menú de los mapas --}}
        <div id="mapsMenu" style="max-height: 300px; font-family: Arial, Helvetica, sans-serif" class="menu noselect">
                <!-- Todo el menú -->
                <div class="closeMenuButton">
                    <i class="fa fa-times"></i>
                </div>
                <div class="pinMenuButton ">
                    <img class="pinIcon" src="{{url('/img/icons/pin.svg')}}" alt="">
                </div>

                <img src="{{url('img/icons/tlMenuMap.png')}}" title="Mapas">
                <div id="mapsTrans" style="max-height: 270px; overflow: hidden;">
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
                    {{-- 
                    <div class="street"> 
                        test
                    </div> 
                    --}}
                </div>

            </div>
        </div>

        {{-- Menú con la info de lps hotspots --}}
        <div id="hotspotMenu" class="menu">
            {{-- Cruz para cerrar el menú --}}
            <div class="closeMenuButton" style="z-index: 1; right: 10px">
                <i class="fa fa-times"></i>
            </div>
            {{-- Iconito del pin para fijarla --}}
            <div class="pinMenuButton" style="z-index: 1; right: 20px">
                <img class="pinIcon" src="{{url('/img/icons/pin.svg')}}" style="margin-right: 10px">
            </div>
            <div class="content">
                <div class="header">
                    <img id="hp-img" class="noselect" src="{{url('img/hotspots/alcazaba-almeria-img-01.jpg')}}" alt="">
                </div>
                <div class="body">
                    <img id="hp-gallery" src="{{url('img/icons/gallery.svg')}}" alt="">
                    <p id="hp-title"></p>
                    <div style="clear: both;"></div>
                    <p id="hp-description"></p>
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
        <div id="fullScreenMenu" style="width:44px;height:44px">
            <img src="{{url('/img/icons/fsMaximize.png')}}" alt="">
        </div>


        {{-----------------------------------------------------------}}
        {{------------------------ CAROUSEL -------------------------}}
        {{-----------------------------------------------------------}}
        <div id="carousel"> 
            <div class="content">
                <div class="upperPart">
                    <img class="X" src="{{url('img/icons/close.svg')}}" alt=""> 
                    {{-- <img class="arrow left" src="{{url('img/icons/arrowUp.svg')}}" alt="">
                    <img class="arrow right" src="{{url('img/icons/arrowUp.svg')}}" alt=""> --}}
                    
                    <img class="bigImg" src="{{url('img/resources/sergio.jpg')}}" alt="">
                </div>
                <div class="lowerPart"> 
                    <div class="images">
                        {{-- <img class="selected" src="{{url('img/resources/sergio.jpg')}}" alt="">
                        <img src="{{url('img/resources/sergio.jpg')}}" alt="">
                        <img src="{{url('img/resources/sergio.jpg')}}" alt=""> --}}
                    </div>
                </div>
            </div>
        </div>
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
            //Añadimos la primera imagen para que se vea algo
            map.addLayer(images[0]);
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

        var selection;
        // Barra de busqueda y como nos mueve al punto en el que se encuentre el 
        // hotspot o la calle en la que se pinche
        $('#streetsFound').on('click', '.street', function(){
            jsHotspots.forEach(hotspot => {
                if($(this).text().trim() == hotspot.title){
                    selection = hotspot;
                    return;
                }
            });
            streets.forEach(street => {
                if($(this).text().trim() == street.fullName){
                    selection = street;
                    return;
                }
            });

            // Clear search field
            $('#streetsFound').empty();
            // Zoom to selection position
            map.setView([selection.lat, parseFloat(selection.lng) + 0.00041], 18);
            // Fill modal data
            if($(this).hasClass("hotspot")){
                // Enable hotspots
                if($("#ballHotspots img").css("opacity") != 1)
                    $("#ballHotspots").click();
                // Hotspot data
                $("#hp-gallery").show();
                $("#hp-title").text(selection.title);
                $("#hp-img").attr("src", selection.images[0].file_path + "/" + selection.images[0].file_name);
                $("#hp-description").text(selection.description);

            }else{ 
                // Enable streets
                if($("#ballShowStreets img").css("opacity") != 1)
                    $("#ballShowStreets").click();
                // Streets data
                $("#hp-gallery").hide();
                $("#hp-img").attr("src", "");
                $("#hp-title").text(selection.fullName);
                let content = "";
                if(selection.maps.length > 1)
                    content = "<br>Existe en los mapas:<br><br>";
                else
                    content = "<br>Existe en el mapa:<br><br>";
                selection.maps.forEach(map => {
                    content += map.title;
                    if(map.pivot.alternative_name !== null)
                        content += " con el nombre <em>" + map.pivot.alternative_name + "</em>";
                    content += "<br><br>";
                });
                content += "<br><a style='color:black' href={{url('search/inform')}}/" + selection.id + ">Imprimir</a><br><br>";
                $("#hp-description").html(content);

            }
            // Show street modal
            $("#hotspotMenu").fadeIn(200);
        });
    </script>

    {{-- Hotspots and streets from database   --}}
    <script>
        //We will fill this in the ajax request
        var streets = [];
        var hotspots = [];
        
        @isset($hotspots)
            // Hotspots php array conversion to js json
            var jsHotspots = @json($hotspots)
        @endisset

        // Luis David
        @isset($streets)
            // Streets php array conversion to js json
            //hotspots = @json($hotspots);
            streetsJSON = @json($streets);
            streetsJSON.forEach(street => {
                // Save actual street
                street.fullName = street.typeName + " " + street.name;
                streets.push(street);
                // Duplicate object for older streets
                let alternativeStreet = {...street};
                alternativeStreet.maps.forEach(mapStreet => {
                    if(mapStreet.pivot.alternative_name !== null){
                        alternativeStreet.name = mapStreet.pivot.alternative_name;
                        alternativeStreet.fullName = alternativeStreet.typeName + " " + alternativeStreet.name;
                        alternativeStreet.deprecated = true;
                        streets.push(alternativeStreet);
                    }
                });
            });
            
            let clusterMarkers = L.markerClusterGroup();
            
            streets.forEach(street => {
                if(street.deprecated != true){
                    var marker = L.marker([street.lat, street.lng],{icon: markerStreet, alt: street.id, draggable:false});
                    marker.street = street;
                    marker.on('click', function(e){
                        console.log(this);
                        map.setView([this.street.lat, parseFloat(this.street.lng) + 0.00041], 18);
                        // Modal data
                        $("#hp-img").attr("src", "");
                        $("#hp-title").text(this.street.fullName);
                        let content = "";
                        if(this.street.maps.length > 1)
                            content = "<br>Existe en los mapas:<br><br>";
                        else
                            content = "<br>Existe en el mapa:<br><br>";
                        this.street.maps.forEach(map => {
                            content += "<b>" + map.title + "</b>";
                            if(map.pivot.alternative_name !== null)
                                content += " con el nombre <em>" + map.pivot.alternative_name + "</em>";
                            content += "<br>";
                        });
                        content += "<br><a style='color:black' href={{url('search/inform')}}/" + this.street.id + ">Imprimir</a><br><br>";
                        $("#hp-description").html(content);
                        // Display modal
                        $("#hotspotMenu").fadeIn(200);
                    });
                    clusterMarkers.addLayer(marker);
                }
            });
            map.addLayer(clusterMarkers);
        @endisset
    </script>
    {{---------------------------------------------------------------}}
    {{------ CODIGO DE LA BARRA DE BSUCAR CALLES Y HOTSPOTS ---------}}
    {{---------------------------------------------------------------}}
    <script>
        //When we first click in the search bar (AJAX)
        $("#streetsInput").on("focusin", function(e){
            if($(this).val().length == 0){
                
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
            jsHotspots.forEach(hotspot => {
                if(hotspot.title.toLowerCase().includes($('#streetsInput').val().toLowerCase())){
                    $('#streetsFound').append("<div class='hotspot street'> <img style='width:5%;' src='{{url('img/icons/token.svg')}}'>"+ hotspot.title + "</div>"); 
                }
            });
            streets.forEach(street => {
                if(street.fullName.toLowerCase().includes($('#streetsInput').val().toLowerCase())){
                    // Deprecated street will appear in italic font
                    if(street.deprecated == true)
                        $('#streetsFound').append("<div id='"+ street.id +"' style='font-style:italic;opacity:0.8' class='street'> <img style='width:5%;' src='{{url('img/icons/tokenSelected.svg')}}'>"+ street.fullName + "</div>");
                    else
                        $('#streetsFound').append("<div id='"+ street.id +"' class='street'> <img style='width:5%;' src='{{url('img/icons/tokenSelected.svg')}}'>"+ street.fullName + "</div>");
                }
            });
        }

        map.on("click", function(){
            $('#streetsFound').empty();
        });
        map.removeLayer(clusterMarkers);
    </script>

    {{-----------------------------------------------------------}}
    {{--------------------- CAROUSEL CODE -----------------------}}
    {{-----------------------------------------------------------}}
    <script>
        // Mostrarlo 
        $("#hp-img, #hp-gallery").click(function(e){
            showGallery();
        });
        

        function showGallery(){
            $("#carousel .images").empty();
            let mainImgUrl = selection.images[0].file_path +"/"+ selection.images[0].file_name;
            $("#carousel .bigImg").attr("src", window.location.href + mainImgUrl);
            
            for (let i = 0; i < selection.images.length; i++) {
                let imgUrl = selection.images[i].file_path +"/"+ selection.images[i].file_name;
                if(i == 0){
                    $("#carousel .images").append("<img class='selected' src='"+imgUrl+"' alt=''>");
                } else {
                    $("#carousel .images").append("<img src='"+imgUrl+"' alt=''>");
                }
            }
            
            $("#carousel").fadeIn(150);
        }

        // Ocultarlo
        $("#carousel .X").click(function(e){
            $("#carousel").fadeOut(150);
        });
        
        //Cambiar de foto 
        $("#carousel .images").on("click", 'img', function(e){
            let imgSelected = $(this);
            if(!imgSelected.hasClass("selected")){
                $("#carousel .images").find(".selected").removeClass("selected");
                imgSelected.addClass("selected"); 

                $("#carousel .bigImg").attr("src", imgSelected.attr("src"));
            }
        });
        
    </script>

    
    <script src="{{url('js/mapTlMenu.js')}}"></script>
    <script src="{{url('js/mapBlMenu.js')}}"></script>
    <script src="{{url('js/mapFullScreenMenu.js')}}"></script>
</body>

    
</html>
