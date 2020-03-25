
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
    <!-- Plugin clustering markers -->
    <script src="{{url('/js/Leaflet/pluginClusteringMarkers/leaflet.markercluster.js')}}"></script>
    <link rel="stylesheet" href="{{url('/js/Leaflet/pluginClusteringMarkers/MarkerCluster.css')}}">
    <link rel="stylesheet" href="{{url('/js/Leaflet/pluginClusteringMarkers/MarkerCluster.Default.css')}}">
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
                <div id="mapsTrans" style="max-height: 270px; overflow-y: auto;">
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
                    //When we first click in the search bar (AJAX)
                    $("#streetsInput").on("focusin", function(e){
                        if($(this).val().length == 0){
                            var url = "{{url("map/search")}}";
                            $.ajax({
                                type: 'GET',
                                url: url,
                                // data: { text : text },
                                success: function(data) {
                                    $('#streetsFound').empty();
                                    console.log(data);
                                    streets = [];
                                    
                                    data.streets.forEach(street => {
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
                                    console.log(streets)
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
                        streets.forEach(street => {
                            if(street.fullName.toLowerCase().includes($('#streetsInput').val().toLowerCase())){
                                // Deprecated street will appear in italic font
                                if(street.deprecated == true)
                                    $('#streetsFound').append("<div id='"+ street.id +"' style='font-style:italic;opacity:0.8' class='street'> <img style='width:5%;' src='{{url('img/icons/token.svg')}}'>"+ street.fullName + "</div>");
                                else
                                    $('#streetsFound').append("<div id='"+ street.id +"' class='street'> <img style='width:5%;' src='{{url('img/icons/token.svg')}}'>"+ street.fullName + "</div>");
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
        <div id="tilesShow" style="margin-left: 62px">
            <i class="fa fa-chevron-down"></i>
        </div>
        <div id="tileChooser" style="margin-left: 72px">
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
    

    <!-- Create/edit street modal -->

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
                    <!-- Street type -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="text-dark">Tipo de vía</label>
                            <select required name="type_id" class="form-control">
                                @foreach ($streetsTypes as $streetType)
                                <option value="{{$streetType->id}}">({{$streetType->abbreviation}}) {{$streetType->type}}</option>
                                @endforeach
                            </select>
                            <label class="text-danger inputs-errors mt-3">@error('type_id') {{$message}} @enderror</label>
                        </div>
                        <!-- Street name -->
                        <div class="form-group">
                            <label class="text-dark">Nombre de la vía</label>
                            <input required type="text" class="form-control" name="name">
                            <label class="text-danger inputs-errors mt-3">@error('name') {{$message}} @enderror</label>
                        </div>
                        <!-- Street maps -->
                        <div class="form-group">
                            <label class="text-dark">Mapas que la contienen</label><br>
                            @foreach ($maps as $map)
                            
                                <input id="checkbox_map{{$map->id}}" type="checkbox" class="checkbox-text" name="maps_id[]" value="{{$map->id}}" checked>
                                <span class="text-dark checkbox-text">{{$map->title}} ({{$map->city}} - {{$map->date}})</span>
                            
                                <input id="input_map{{$map->id}}" class="form-control" type="text" name="maps_name[]" placeholder="Sobreescribir el nombre de la vía en el mapa {{$map->title}}">
                                <br>
                            @endforeach
                            <label id="maps-error" class='text-danger mt-3 inputs-errors'></label>
                        </div>
                        <!-- Street points -->
                        <div>
                            <input type="hidden" id="modal-lat" name="lat">
                            <input type="hidden" id="modal-lng" name="lng">
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn-remove" value="" type="button" class="btn btn-danger">Eliminar</button>
                        <button id="btn-position" value="" type="button" class="btn text-white btn-warning mr-auto">Cambiar posición</button>
                        <!--
                        <button id="btn-cancel" type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                        -->
                        <button id="btn-submit" type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="confirmModal" class="modal fade text-dark" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="confirm-modal-title" class="modal-title">Eliminar vía</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar la vía?</p>
                    <button id="btn-cancel" type="button" class="btn btn-success float-left" data-dismiss="modal">Cancelar</button>
                    <button id="btn-confirm" type="button" class="btn btn-danger float-right deleteConfirm" data-dismiss="modal">Eliminar</button>
                </div>
            </div>
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
        map.addLayer(mapTile0);

        //Here we are adding the images(of the diferent maps) on top of the map
        map.whenReady(function() {

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
    {{-- STREET MANAGEMENT --}}
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
            // Check saved streets
            
            @isset($streets)
                // Streets php array conversion to js array
                let streets = @json($streets);
                // Complete array with map relationship data
                @for ($i=0;$i<count($streets);$i++) 
                    streets[{{$i}}].maps =  @json($streets[$i]->maps);
                @endfor
                // Complete array with points relationship data
                @for ($i=0;$i<count($streets);$i++) 
                    streets[{{$i}}].points =  @json($streets[$i]->points[0]);
                @endfor

                let clusterMarkers = L.markerClusterGroup();

                // Write saved streets
                @foreach ($streets as $street)
                    // Creating a Marker
                    var marker{{$street->id}} = L.marker([{{$street->points[0]->lat}}, {{$street->points[0]->lng}}],{icon: markerImage, alt:"{{$street->id}}", draggable:false});
                    // Adding marker to the markers list
                    markersList.push(marker{{$street->id}});
                    // Adding marker to the map
                    //marker{{$street->id}}.addTo(map);
                    clusterMarkers.addLayer(marker{{$street->id}});
                @endforeach
                map.addLayer(clusterMarkers);
            @endisset
            
            /*  Old overlay imagles click handler based
             *  on click point over image to generate a 
             *  leaflet point to be translated to latlng

            // Map images click handler
            $(".leaflet-image-layer").click(function(e){
                console.log("imagen");
                // Calculate backend menu width
                let menuWidth = screen.width * 0.05;
                // Create leaflet point with client x/y coordinates
                let point = L.point(e.clientX-menuWidth, e.clientY);
                // Conversion from point to leaflet latitude longitude object
                let latlng = map.containerPointToLatLng(point);
                // Create modal trigger
                createStreet(latlng.lat, latlng.lng);
            });
            */

            // Leaflet map click handler
            map.on('click', function(e) {
                console.log("mapa");
                // Create modal trigger with lat/lng coordinates
                createStreet(e.latlng.lat, e.latlng.lng);
            });
        
            // Leaflet mark click handler
            $(document).on('click','img.leaflet-marker-icon', function(e){
                console.log("hola");
                // Stop event bubbling to prevent map object clicks
                e.stopPropagation();
                // Check if clicks comes from dragging or not
                if(dragging){
                    // After drag turn off dragging mode on after click
                    dragging = false;
                }else{
                    // Search for selected street
                    let street;
                    for (let i = 0; i < streets.length; i++) {
                        if(streets[i].id == this.alt)
                            street = streets[i]; // Streets of array with selected street comparison
                    }
                    // Edit modal trigger with selected street
                    editStreet(street); 
                }
            });






            function createStreet(lat, lng) {
                // Create form attributes
                $("#modal-form").attr("action", "{{route('street.store')}}");
                $("input[name='_method']").val("POST");
                // Clear fields
                $("select[name='type_id']").val("");
                $("input[name='name']").val("");
                // Clear maps alternatives names fields
                let mapsList = $("input[name='maps_name[]']");
                for (let i = 0; i < mapsList.length; i++) {
                    mapsList[i].value = "";
                    $(mapsList[i]).show();
                    $(mapsList[i]).prop("disabled", false);
                    $("#checkbox_map"+mapsList[i].id.substring(9)).prop("checked", true);
                }
                // Fill position values
                $("#modal-lat").val(lat);
                $("#modal-lng").val(lng);
                // Modal display
                $("#modal-title").text("Nueva vía");
                $("#btn-remove").prop("disabled", true);
                $("#btn-remove").css("display", "none");
                $("#btn-position").prop("disabled", true);
                $("#btn-position").css("display", "none");
                $(".inputs-errors").html("");
                $('#modal').modal('show');
                /* Add marker to the map when we use ajax to insert
                $("#btn-submit").click(function(){
                    let newMark = L.marker([lat, lng],{icon: markerImage});    // Creating a Marker
                    newMark.addTo(map); // Adding marker to the map
                });*/
            }
            function editStreet(street) {
                // Edit form attributes
                $("#modal-form").attr("action", "{{route('street.store')}}/"+street.id);
                $("input[name='_method']").val("PUT");
                $(".inputs-errors").html("");
                // Fill inputs fields
                $("select[name='type_id']").val(street.type_id);
                $("input[name='name']").val(street.name);
                // Fill hidden values
                console.log("edit street latlng");
                $("#modal-lat").val(street.points.lat);
                $("#modal-lng").val(street.points.lng);
                $(".modal-body #id").val(street.id);

                // Clear maps alternatives names fields
                let mapsList = $("input[name='maps_name[]']");
                for (let i = 0; i < mapsList.length; i++) {
                    mapsList[i].value = "";
                    $(mapsList[i]).hide();
                    $(mapsList[i]).prop("disabled", true);
                    $("#checkbox_map"+mapsList[i].id.substring(9)).prop("checked", false);
                }
                // Uncheck maps
                // Fill alternatives names
                for (let i = 0; i < street.maps.length; i++) {
                    $("#checkbox_map"+street.maps[i].id).prop("checked", true);
                    $("#input_map"+street.maps[i].id).prop("disabled", false);
                    $("#input_map"+street.maps[i].id).show();
                    if(street.maps[i].pivot.alternative_name !== null){
                        $("#input_map"+street.maps[i].id).val(street.maps[i].pivot.alternative_name);
                    }
                }
                // Fill null names
      /*          let mapsListElements = $("input[name='maps_name[]']");

                let mapsListId = new Array();
                for (let i = 0; i < mapsList.length; i++) {
                    mapsListId.push(mapsListElements[i].id.substring(9));
                }
                let belongsMaps = new Array();
                street.maps.forEach(map => {
                    belongsMaps.push(mapsListElements[i].id.substring(9));
                });
                for (let i = 0; i < street.maps.length; i++) {
                    belongsMaps.push(mapsListElements[i].id.substring(9));
                }
                for (let i = 0; i < mapsListElements.length; i++) {
                    
                }

                belongsMaps.forEach(mapId => {
                    let alternative_name = street.maps[i].pivot.alternative_name;
                    $("#input_map"+street.maps[i].id).val(alternative_name);
                });
                console.log(belongsMaps);
*/
                $("#modal-title").text("Editar vía");
                // Show and enable buttons and also fill value with street id
                $("#btn-remove").prop("disabled", false);
                $("#btn-remove").prop("value", street.id);
                $("#btn-remove").css("display", "initial");
                $("#btn-position").prop("disabled", false);
                $("#btn-position").prop("value", street.id);
                $("#btn-position").css("display", "initial");
                // Modal display
                $('#modal').modal('show');

                // Delete street button
                $("#btn-remove").on("click", function(){
                    $("#modal-form").attr("action", "{{route('street.store')}}/"+this.value);
                    $("input[name='_method']").val("DELETE");
                    $('#modal').modal('hide');
                    $('#confirmModal').modal('show');
                    $("#btn-confirm").click(function(){
                        $("#modal-form").submit();
                    });
                    $("#btn-cancel").click(function(){
                        //$("#modal-form").attr("action", "{{route('street.store')}}/"+street.id);
                        //$("input[name='_method']").val("PUT");
                        $('#confirmModal').modal('hide');
                        //$('#modal').modal('show');
                    });
                });
                
                // Replace street position
                $("#btn-position").on("click", function(){
                    // Turn dragging variable to true to disable marker click handle
                    dragging = true;
                    // Search for right marker
                    let markerId = $(".leaflet-marker-pane img[alt='"+this.value+"']")[0].alt;
                    // Build of marker variable name
                    let markerVarName = "marker"+markerId;
                    // Get marker js object
                    let leafletMarker = eval(markerVarName);
                    console.log("antes de mover "+leafletMarker.getLatLng());
                    // Enable marker dragging mode
                    leafletMarker.dragging.enable();
                    // Hide edition modal
                    $('#modal').modal('hide');
                    // Dragging event handle
                    leafletMarker.on("moveend", function(){
                        // Disable dragging mode
                        leafletMarker.dragging.disable();
                        console.log("después de mover "+leafletMarker.getLatLng().lat);
                        console.log("replace position street latlng");
                        // Fill new position values
                        $("#modal-lat").val(leafletMarker.getLatLng().lat);
                        $("#modal-lng").val(leafletMarker.getLatLng().lng);
                        // Show again edition modal
                        $('#modal').modal('show');
                        // Dragging will be set to false in click event triggered later
                    });
                });
            }
            
            // Save street button
            $("#modal-form").submit(function(e){
                let belongsToMap = false;
                $("#modal-form input[name='maps_id[]']").each(function(){
                    if($(this).prop("checked"))
                        belongsToMap = true;           
                });
                if(!belongsToMap)
                    $("#maps-error").html("*La vía debe de pertenecer al menos a un mapa.");
                return belongsToMap;
            });/*
            $("#btn-submit").on("click", function(e){
                
            });
*/
            // Rename streets fields display
            $(".checkbox-text").on("click", function(){
                // Map id getted from checkbox value
                let fieldId = this.value;
                // Hide forms fields
                $("#input_map"+fieldId).slideToggle(200, function(){
                    // Disable inputs to do not send
                    $("#input_map"+fieldId).prop("disabled", function(){
                        return !($(this).prop("disabled"));
                    });
                });
            });

            // Found street click event handler
            $(document).on("click","div.street",function(){
                $('#streetsFound').empty();
                // Build of marker variable name
                let markerVarName = "marker"+this.id;
                // Get marker js object
                let leafletMarker = eval(markerVarName);
                // Set view over street
                map.setView([leafletMarker.getLatLng().lat, leafletMarker.getLatLng().lng], 99);
                // Display modal
                setTimeout(() => {
                    $("img[alt='" + this.id + "']").click()    
                }, 250);
            });
        });
    </script>
@endsection