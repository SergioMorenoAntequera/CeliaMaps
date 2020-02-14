@extends('layouts.master')

@section('title', 'Celia Maps') 

@section('content')

    <div id="frame">
        <img id="map" class="mapImg" src="{{url('img/maps/mapa-prueba.png')}}">
        <!--
        <img class="mapImg" src="{ {url('img/maps/Mapa-prueba-2.png')}}">
        -->
        <input id="transparency" type="range" step="0.01" min="0" max="1" value="1" class="custom-range">
        <button id="buttonEdit"><img id="token" src="{{url('img/icons/token.svg')}}"></button>
        <img id="tokenSelected" style="width: 40px" src="{{url('img/icons/tokenSelected.svg')}}">
        @foreach ($hotspotList as $hotspot)
            <img id="{{$hotspot->id}}" style="top:{{$hotspot->point_y}};left:{{$hotspot->point_x}}" class="token" src="{{url('img/icons/token.svg')}}">
                <div id="preview{{$hotspot->id}}" class="card" style="top:{{intval($hotspot->point_y)-245}}; left:{{intval($hotspot->point_x)-129}}; max-height: 245px">
                    <img src="{{url('img/hotspots/puerta-purchena-img-01.jpg')}}" alt="Hotspot Preview" style="width:286px; max-heigth:180px">
                    <div class="card-body" style="color: black">
                      <h4><b>{{$hotspot->title}}</b></h4> 
                    </div>
                </div>
        @endforeach
    </div>

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
