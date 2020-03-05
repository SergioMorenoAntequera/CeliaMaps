
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

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- PERSONAL CSS -->
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

@section('header')
    <!--  Header html  -->
@endsection

@section('content')
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
                <img class="noselect" src="{{url('img/icons/tlMenuToken.png')}}" title="Puntos de interés">
            </div>
        </div>

        {{-- CONTENIDO DE MENÚ --}}
        {{-- Todos los menús que podemos poner --}}

        {{-- Menú de los mapas --}}
        <div id="mapsMenu" class="menu noselect">
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
        <div id="hotspotsMenu" class="menu noselect">
            {{-- Cruz para cerrar el menú --}}
            <div class="closeMenuButton">
                <i class="fa fa-times"></i>
            </div>
            {{-- Iconito del pin para fijarla --}}
            <div class="pinMenuButton ">
                <img class="pinIcon" src="{{url('/img/icons/pin.svg')}}" alt="">
            </div>
            {{-- Icono que representa y contenido de la ventana --}}
            <img class="noselect" src="{{url('img/icons/tlMenuToken.png')}}" title="Puntos de interés">
            <div id="hotspotsContent">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium deserunt sint omnis, fuga nam blanditiis qui pariatur quidem repellat labore facere consequatur neque accusamus amet aspernatur fugit, enim aliquid autl!
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis architecto odit itaque incidunt necessitatibus cum, soluta quam beatae vel odio reiciendis repudiandae nam nobis optio vero corporis voluptatibus earum similique.
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
                    {{-- <div class="street"> 
                        test
                    </div> --}}
                </div>

                <script>
                    //We prepare the url for ajax
                    var url = window.location.href + "map/search";
                    //We prepare  the arrays of data that we will recieve
                    var streets = []; 
                    var hotspots = [];
                    //If we put data inside the input
                    $("#streetsInput").on("input", function(e){
                        //We get the text in the box
                        var text = $(this).val();
                        //Me da palo escribir inglés
                        //Si es el primero o cada 3 hacemos una petición ajax
                        //para evitar sobrecargar la base de datos
                        if(text.length > 0){
                            //Petición ajax, mandamos el texto de la caja
                            $.ajax({
                                type: 'GET',
                                url: url,
                                data: { text : text },
                                success: function(data) {
                                    //Nos devuelve un array con los elementos que contengan ese aspecto
                                    //Quitramos lo que ya tenemos
                                    $('#streetsFound .street').remove();
                                    //Guardamos las cosas en los arrays por comodidad
                                    hotspots = data.hotspots;
                                    streets = data.streets;
                                    //Ponemos los hotspots primero aquí y si es más de 4 en hidden
                                    for(var i = 0; i < hotspots.length; i++){
                                        if(i < 4){
                                            $('#streetsFound').append("<div class='street'>"+hotspots[i].title +"</div>");
                                        }// else {
                                        //     $('#streetsFound').append("<div style=\"display: none;\" class='street'>"+hotspots[i].title +"</div>");
                                        // }
                                    }
                                    //Ponemos las calles después aquí y si es más de 4 en hidden
                                    for(var i = 0; i < streets.length; i++){
                                        if(i < 4){
                                            $('#streetsFound').append("<div class='street'>"+streets[i].type.name + " " + streets[i].name +"</div>");
                                        }
                                    }
                                },
                            }); // FIN AJAX
                        //If there is nothing in the bar we remove everything
                        } else if(text.length == 0){
                            $('#streetsFound .street').remove();
                        }
                    });
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

    <!-- HOTSPOTS -->

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
                    <!-- Hotspot title -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="text-dark">Titulo del Hotspot</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <!-- Hotspot description -->
                        <div class="form-group">
                            <label class="text-dark">Descripcion del Hotspot</label>
                            <input type="text" class="form-control" name="description">
                        </div>
                        <!-- Hotspot images -->
                        <div class="form-group images-fields" id="imagesUpload">
                            <label class="text-dark">Imagenes del Hotspot</label><br>
                            <input type="file" name="images[]" class="fileToUpload">
                        </div>
                        <div class="form-group images-fields" id="filePathUpdate">
                            <input type="hidden" name="filePath" value="/img/hotspots/" disabled>
                        </div>
                        <div class="form-group images-fields">
                            <label class="text-dark">Titulo de la imagen</label>
                            <input type="text" class="form-control" name="titleImage">
                        </div>
                        <div class="form-group images-fields">
                            <label class="text-dark">Descripcion de la imagen</label>
                            <input type="text" class="form-control" name="descriptionImage">
                        </div>
                        <!-- Hotspot points -->
                        <div>
                            <input type="hidden" id="modal-lat" name="lat">
                            <input type="hidden" id="modal-lng" name="lng">
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn-remove" value="" type="button" class="btn btn-danger">Eliminar</button>
                        <button id="btn-position" value="" type="button" class="btn text-white btn-warning mr-auto">Cambiar posición</button>
                        <button id="btn-submit" type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


        <!-- Modal to confirm -->
        <div id="confirmModal" class="modal fade text-dark" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="confirm-modal-title" class="modal-title">Eliminar hotspot</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
    
                    <div class="modal-body">
                        <p>¿Está seguro de que desea eliminar el hotspot?</p>
                        <button id="btn-confirm" type="button" class="btn btn-danger float-right deleteConfirm" data-dismiss="modal">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Preview Hotspots -->
        <div id="preview" class="card">
            <img id="previewImage" src="" alt="Hotspot Preview" style="width:286px; max-heigth:180px">
            <div class="card-body" style="color: black">
              <h4 id="previewTitle"><b></b></h4> 
            </div>
        </div>
    
    
@endsection

@section('footer')
    <!--  Footer html  -->
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
        map.setView([36.844092, -2.457840], 14);

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
        map.addLayer(mapTile2);

        //Here we are adding the images(of the diferent maps) on top of the map
        map.whenReady(function() {
            
            map.on('click', function(e) {
                console.log(map._layers );
                console.log(e.latlng .lat + ", " + e.latlng.lng);    
            });
            images[0].on('click', function(e) {
                console.log("PRA");
                console.log(e.latlng.lat + ", " + e.latlng.lng);
            });
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
    {{-- HOTSPOT MANAGEMENT --}}
    <script>
        $(function(){
            // Mark icon design
            var markerImage = L.icon({
                iconUrl: "{{url('img/icons/token.svg')}}",
                iconSize:     [30, 90],
                iconAnchor:   [15,60],
            });

            // Marker collection
            var markersList = new Array();
            var dragging = false;
        
            // Saved hotspots checking
            @isset($hotspots)
                // Hotspots php array conversion to js
                let hotspots = @json($hotspots);
                // Hotspots images relationships
                @for ($i=0;$i<count($hotspots);$i++) 
                    hotspots[{{$i}}].images =  @json($hotspots[$i]->images);
                @endfor
                console.log(hotspots)

                // Write saved streets
                @foreach ($hotspots as $hotspot)
                    // Creating a Marker
                    var marker{{$hotspot->id}} = L.marker([{{$hotspot->lat}}, {{$hotspot->lng}}],{icon: markerImage, alt:"{{$hotspot->id}}", draggable:false});
                    // Adding marker to the markers list
                    markersList.push(marker{{$hotspot->id}});
                    // Adding marker to the map
                    marker{{$hotspot->id}}.addTo(map); 
                @endforeach
            @endisset
        

            // Leaflet map click handler
            map.on('click', function(e) {
                // Create modal trigger with lat/lng coordinates
                createHotspot(e.latlng.lat, e.latlng.lng);
            });


            // Leaflet mark click handler
            $('.leaflet-marker-icon').on('click', function(e){
                // Stop event bubbling to prevent map object clicks
                e.stopPropagation();
                // Check if clicks comes from dragging or not
                if(dragging){
                    // After drag turn off dragging mode
                    dragging = false
                }else{
                    // Selected hotspot searching
                    let hotspot;
                    for (let i = 0; i < hotspots.length; i++) {
                        if(hotspots[i].id == this.alt)
                            hotspot = hotspots[i]; // Hotspots of array with selected hotspot comparison
                    }
                    // Edit modal trigger with selected hotspot
                    editHotspot(hotspot); 
                }
            });

            function createHotspot(lat, lng) {
                // Create form attributes
                $("#modal-form").attr("action", "{{route('hotspot.store')}}");
                $("input[name='_method']").val("POST");
                // Clear fields
                $("input[name='title']").val("");
                $("input[name='description']").val("");
                // Fill position values
                $("#modal-lat").val(lat);
                $("#modal-lng").val(lng);
                // Modal display
                $("#modal-title").text("Nuevo hotspot");
                $("#btn-remove").prop("disabled", true);
                $("#btn-remove").css("display", "none");
                $("#btn-position").prop("disabled", true);
                $("#btn-position").css("display", "none");
                $('#modal').modal('show');
            }

            function editHotspot(hotspot) {
                // Edit form attributes
                $("#modal-form").attr("action", "{{route('hotspot.store')}}/"+hotspot.id);
                $("input[name='_method']").val("PUT");
                // Image filds
                $(".images-fields").hide();
                $(".images-fields input").prop('disabled', true);
                // Fill inputs fields
                $("input[name='title']").val(hotspot.title);
                $("input[name='description']").val(hotspot.description);
                ///////$("input[name='description']").val(hotspot->images[]);
                // Fill hidden values
                $("#modal-lat").val(hotspot.lat);
                $("#modal-lng").val(hotspot.lng);
                $(".modal-body #id").val(hotspot.id);
                $("#modal-title").text("Editar hotspot");
                // Show and enable buttons and also fill value with hotspot id
                $("#btn-remove").prop("disabled", false);
                $("#btn-remove").prop("value", hotspot.id);
                $("#btn-remove").css("display", "initial");
                $("#btn-position").prop("disabled", false);
                $("#btn-position").prop("value", hotspot.id);
                $("#btn-position").css("display", "initial");
                // Modal display
                $('#modal').modal('show');

                // Delete hotspot button
                $("#btn-remove").on("click", function(){
                    $("#modal-form").attr("action", "{{route('hotspot.store')}}/"+this.value);
                    $("input[name='_method']").val("DELETE");
                    $('#modal').modal('hide');
                    $('#confirmModal').modal('show');
                    $("#btn-confirm").click(function(){
                        $("#modal-form").submit();
                    });
                    $("#btn-cancel").click(function(){
                        $('#confirmModal').modal('hide');
                    });
                });
                
                // Replace hotspot position
                $("#btn-position").on("click", function(){
                    // Turn dragging variable to true to disable marker click handle
                    dragging = true;
                    // Search for right marker
                    let markerId = $(".leaflet-marker-pane img[alt='"+this.value+"']")[0].alt;
                    // Build of marker variable name
                    let markerVarName = "marker"+markerId;
                    // Get marker js object
                    let leafletMarker = eval(markerVarName);
                    // Enable marker dragging mode
                    leafletMarker.dragging.enable();
                    // Hide edition modal
                    $('#modal').modal('hide');
                    // Dragging event handle
                    leafletMarker.on("moveend", function(){
                        // Disable dragging mode
                        leafletMarker.dragging.disable();
                        // Fill new position values
                        $("#modal-lat").val(leafletMarker.getLatLng().lat);
                        $("#modal-lng").val(leafletMarker.getLatLng().lng);
                        // Show again edition modal
                        $('#modal').modal('show');
                        // Dragging will be set to false in click event triggered later
                    });
                });
            }

            
            // Hotspots preview
            $('.leaflet-marker-icon').hover(function(){
                console.log(this.alt);
                let hotspot;
                for (let i = 0; i < hotspots.length; i++) {
                    if(hotspots[i].id == this.alt)
                        hotspot = hotspots[i];
                }

                let host = "{{url('')}}";
                $("#previewImage").attr("src", host+"/"+hotspot.images[0].file_path+"/"+hotspot.images[0].file_name);

                // Coordinates mouse
                $('.leaflet-marker-icon').mousemove(function(event){
                    var latPreview = event.screenY -424;
                    var lgnPreview = event.screenX -140;

                    // Display block no funciona con css
                    $("#preview").attr('style', 'display: block !important');
                    $("#preview").css({top: latPreview, left: lgnPreview});
                });
                $("#previewTitle").text(hotspot.title);

            }, function(){
                $('#preview').attr('style', 'display: none !important');

            });

            // Hotspot images file 
            $('.fileToUpload').on('click', function(){
                $('#imagesUpload').append("<input name='images[]' type='file' class='fileToUpload'>");
            });

        });
    </script>
@endsection