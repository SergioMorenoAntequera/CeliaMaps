@extends('layouts.master')

@section('title', 'Celia Maps') 

@section('cdn')

    <!-- Leaflet -->
    <script src="{{url('/js/Leaflet/leaflet.js')}}"></script>
    <link rel="stylesheet" href="{{'/js/Leaflet/leaflet.css'}}">

@endsection

@section('header')
    <!--  Header html  -->
@endsection

@section('content')

    <!-- Maps -->

    <div id="frame">

        <img id="map" src="{{url('img/maps/mapa-prueba.png')}}">
        <input id="transparency" type="range" step="0.01" min="0" max="1" value="1" class="custom-range">
        
        @foreach ($hotspotList as $hotspot)
            <img id="{{$hotspot->id}}" style="top:{{$hotspot->point_y}};left:{{$hotspot->point_x}}" class="token" src="{{url('img/icons/token.svg')}}">
                <div id="preview{{$hotspot->id}}" class="card" style="top:{{intval($hotspot->point_y)-245}}; left:{{intval($hotspot->point_x)-129}}; max-height: 245px">
                    <img src="{{url('img/hotspots/puerta-purchena-img-01.jpg')}}" alt="Hotspot Preview" style="width:286px; max-heigth:180px">
                    <div class="card-body" style="color: black">
                      <h4><b>{{$hotspot->title}}</b></h4> 
                    </div>
                </div>
        @endforeach

        <div id="draggable">
            <img id="token" src="{{url('img/icons/token.svg')}}">
        </div>

    </div>

    <!-- Create street modal -->

    <div class="modal fade" id="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Crear nuevo Hotspot</h5>
                    <button type="button" class="close"  aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-dark pb-0">
                    <form method="POST" action="{{route('hotspot.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" class="form-control" name="title" placeholder="Title of the hotspot">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" name="description" placeholder="Description of the hotspot">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="point_x" id="point_x" placeholder="Point X of the hotspot">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="point_y" id="point_y" placeholder="Point Y of the hotspot" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Añadir nuevo hotspot</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>     

    <!-- Edit street modal -->

    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-dark pb-0">
                    <div id="show{{$hotspot->id}}" class="show">
                        <div id="carousel" class="carousel slide" data-ride="carousel" data-interval="10000">
                            <ol class="carousel-indicators">
                              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img class="d-block w-100" src="{{url('img/hotspots/puerta-purchena-img-01.jpg')}}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{url('img/hotspots/puerta-purchena-img-02.jpg')}}" alt="Second slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" src="{{url('img/hotspots/puerta-purchena-img-03.jpg')}}" alt="Third slide">
                            </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <div class="card-body" style="color: black">
                            <form method="POST" action="{{route('hotspot.update', $hotspot->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method("PATCH")
                                <h4 style="margin-top: 0.5rem"><b><textarea class="form-control" rows="1">{{$hotspot->title}}</textarea></b></h4>
                                <textarea class="form-control" rows="4">{{$hotspot->description}}</textarea><br>
                                <button id="btn-remove" type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
                                <button id="btn-position" type="button" class="btn btn-warning mr-auto" data-dismiss="modal">Cambiar posición</button>
                                <button id="btn-cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button id="btn-submit" type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
        $(document).ready(function(){
        
        //  Hotspots to JavaScript
        /*
        let hotspots = @ j so n($hotspots);
        @ f or ( $i=0;$i<count($hotspots);$i++) 
            hotspots[{ {     $i}}].maps =  @ j so n($hotspots[$i]->maps)
        @ e ndf or
        */
        
        $("input[type='checkbox']").click(function(){
            // Hide forms fields
            $("#input_map"+this.value).toggle();
            // Disable inputs to do not send
            $("#input_map"+this.value).prop("disabled", function(){
                return !($(this).prop("disabled"));
            });
        });
    
        $('.mapImg').click(function(e){
            var point_x = e.pageX - this.offsetLeft;
            var point_y = e.pageY - this.offsetTop;
            console.log("X: " + point_x + " Y: " + point_y); 
            // Modal
            setTimeout(function() {
                $('#modal').modal('show');
            }, 250);
            // Coordenadas punto
            $(".modal-body #point_x").val(point_x);
            $(".modal-body #point_y").val(point_y);
            // Ficha
            $("#token").css("left",point_x-15);
            $("#tokenSelected").css("left",point_x-20);
            $("#token").css("top",point_y-27);
            $("#tokenSelected").css("top",point_y-35);
            $("#token").show();
            });
            // Maps opacities
            $("#transparency").change(function(){
                $("#map").css("opacity",this.value);
            });
        });

        $('.token').hover(function(){
            // Preview
            $('#preview'+this.id).css("display", "block");
        }, function(){
            $('#preview'+this.id).css("display", "none");
        });

        $('.token').click(function(){
            // Preview
            $('#modalEdit').modal('show');
        });
    </script>
@endsection
