
@extends('layouts.master')

@section('title', 'Celia Maps')

@section('cdn')
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- PERSONAL CSS -->
    <link rel="stylesheet" href="{{url('/css/frontend.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{url('js/mapTlMenu.js')}}"></script>
    <script src="{{url('js/mapBlMenu.js')}}"></script>
    <script src="{{url('js/mapFullScreenMenu.js')}}"></script>
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
                                        }// else {
                                        //     $('#streetsFound').append("<div style=\"display: none;\" class='street'>"+streets[i].name +"</div>");
                                        // }
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
                            <select name="type_id" class="form-control">
                                @foreach ($streetsTypes as $streetType)
                                <option value="{{$streetType->id}}">({{$streetType->abbreviation}}) {{$streetType->type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Street name -->
                        <div class="form-group">
                            <label class="text-dark">Nombre de la vía</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <!-- Street maps -->
                        <div class="form-group">
                            <label class="text-dark">Mapas que lo contienen</label><br>
                            @foreach ($maps as $map)
                            
                                <input type="checkbox" class="checkbox-text" name="maps_id[]" value="{{$map->id}}" checked>
                                <span class="text-dark checkbox-text">{{$map->title}} ({{$map->city}} - {{$map->date}})</span>
                            
                                <input id="input_map{{$map->id}}" class="form-control" type="text" name="maps_name[]" placeholder="Sobreescribir el nombre de la vía en el mapa {{$map->title}}">
                                <br>
                            @endforeach
                        </div>
                        <!-- Street points -->
                        <div>
                            <input type="hidden" id="lat" name="lat">
                            <input type="hidden" id="lng" name="lng">
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
                    <button id="btn-cancel" type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                    <button id="btn-confirm" type="button" class="btn btn-danger deleteConfirm" data-dismiss="modal">Eliminar</button>
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
        map.addLayer(mapTile2);

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
            var newStreet = true;
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

                // Write saved streets
                @foreach ($streets as $street)
                    // Creating a Marker
                    var marker{{$street->id}} = L.marker([{{$street->points[0]->lat}}, {{$street->points[0]->lng}}],{icon: markerImage, alt:"{{$street->id}}", draggable:false});
                    // Adding marker to the markers list
                    markersList.push(marker{{$street->id}});
                    // Adding marker to the map
                    marker{{$street->id}}.addTo(map); 
                @endforeach
            @endisset
            /*
            if(newStreet){
                // Map images click handler
                $(".leaflet-image-layer").click(function(e){
                    console.log(e);
                    // Calculate backend menu width
                    let menuWidth = screen.width * 0.05;
                    // Create leaflet point with client x/y coordinates
                    let point = L.point(e.clientX-menuWidth, e.clientY);
                    // Conversion from point to leaflet latitude longitude object
                    let latlng = map.containerPointToLatLng(point);
                    // Create modal trigger
                    createStreet(latlng.lat, latlng.lng);
                });
                // Leaflet map click handler
                map.on('click', function(e) {
                    // Create modal trigger with lat/lng coordinates
                    createStreet(e.latlng.lat, e.latlng.lng);
                });
            }
            */
            $('.leaflet-marker-icon').on('mouseenter', function(){
                newStreet = false;
                console.log(newStreet);
            });
            
            $('.leaflet-marker-icon').on('mouseleave', function(){
                //newStreet = true;
                console.log(newStreet);
            });
            $('#modal').on('mouseenter', function(){
                //newStreet = true;
                console.log(newStreet);
            });
            // Leaflet mark click handler
            $('.leaflet-marker-icon').on('click', function(){
                // Selected street searching
                let street;
                for (let i = 0; i < streets.length; i++) {
                    if(streets[i].id == this.alt)
                        street = streets[i]; // Streets of array with selected street comparison
                }
                // Edit modal trigger with selected street
                editStreet(street); 
            });

            // Rename streets fields
            $(".checkbox-text").on("click", function(){
                // Hide forms fields
                $("#input_map"+this.value).slideToggle(200, function(){
                    // Disable inputs to do not send
                    $("#input_map"+this.value).prop("disabled", function(){
                    return !($(this).prop("disabled"));
                    });
                });
            });
            // Replace street position
            $("#btn-position").on("click", function(){
                //console.log($(".leaflet-marker-pane img[alt='"+this.value+"']"));

                let markerId = $(".leaflet-marker-pane img[alt='"+this.value+"']")[0].alt;
                let markerVarName = "marker"+markerId;
                let leafletMarker = eval(markerVarName);
                console.log(leafletMarker.getLatLng());
                leafletMarker.dragging.enable();
                $('#modal').modal('hide');
                leafletMarker.on("moveend", function(e){
                    leafletMarker.dragging.disable();
                    console.log(leafletMarker.getLatLng());
                    $(".modal-body #lat").val(leafletMarker.getLatLng().lat);
                    $(".modal-body #lng").val(leafletMarker.getLatLng().lng);
                    $('#modal').modal('show');
                    console.log($(".modal-body #lat").val())
                    console.log($(".modal-body #lng").val())
                });
                
            });


            function createStreet(lat, lng) {
                //
                let newMark = L.marker([lat, lng],{icon: markerImage});    // Creating a Marker
                        newMark.addTo(map); // Adding marker to the map
                //

                // Create form attributes
                $("#modal-form").attr("action", "{{route('street.store')}}");
                $("input[name='_method']").val("POST");
                // Clear fields
                $("select[name='type_id']").val("");
                $("input[name='name']").val("");
                // Fill position values
                $(".modal-body #lat").val(lat);
                $(".modal-body #lng").val(lng);
                // Modal display
                $("#modal-title").text("Nueva vía");
                $("#btn-remove").prop("disabled", true);
                $("#btn-remove").css("display", "none");
                $("#btn-position").prop("disabled", true);
                $("#btn-position").css("display", "none");
                $('#modal').modal('show');
                
                $("#btn-submit").click(function(){
                    let newMark = L.marker([lat, lng],{icon: markerImage});    // Creating a Marker
                    newMark.addTo(map); // Adding marker to the map
                });
            }
            function editStreet(street) {
                // Edit form attributes
                $("#modal-form").attr("action", "{{route('street.store')}}/"+street.id);
                $("input[name='_method']").val("PUT");
                // Fill inputs fields
                $("select[name='type_id']").val(street.type_id);
                $("input[name='name']").val(street.name);
                // Fill hidden values
                $(".modal-body #lat").val(street.points.lat);
                $(".modal-body #lng").val(street.points.lng);
                $(".modal-body #id").val(street.id);

                // fill streets maps

                // Modal display
                $("#modal-title").text("Editar vía");
                $("#btn-remove").prop("disabled", false);
                $("#btn-remove").prop("value", street.id);
                $("#btn-remove").css("display", "initial");
                $("#btn-position").prop("disabled", false);
                $("#btn-position").prop("value", street.id);
                $("#btn-position").css("display", "initial");
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
                        $('#confirmModal').modal('hide');
                        $('#modal').modal('show');
                    });
                });
            
            }
        });
    </script>
@endsection