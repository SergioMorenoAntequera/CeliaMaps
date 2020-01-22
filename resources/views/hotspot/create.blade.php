@extends('layouts.master')

@section('title', 'Celia Maps') 

@section('content')

    <div id="frame">
        <img id="map" class="mapImg" src="{{url('img/maps/mapa-prueba.png')}}">
        <img class="mapImg" src="{{url('img/maps/Mapa-prueba-2.png')}}">
        <input id="transparency" type="range" step="0.01" min="0" max="1" value="1" class="custom-range">
        <img id="token" src="{{url('img/icons/token.svg')}}">
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
                            <div class="form-group">
                                <label class="text-dark">Mapas que lo contienen</label><br>
                                @foreach ($mapList as $map)
                                    <input type="checkbox" name="map_id[]" value="{{$map->id}}" checked>
                                    <span class="text-dark">{{$map->title}} ({{$map->city}} - {{$map->date}})</span>
                                    <input id="input_map{{$map->id}}" class="form-control" type="text" name="name_map{{$map->id}}" placeholder="Sobreescribir el nombre del hotspot en el mapa {{$map->title}}">
                                    <br>
                                @endforeach
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

@endsection


@section('scripts')
    <script>
        $(document).ready(function(){
        
        $("input[name='map_id']").click(function(){
            $("#input_map"+this.value).toggle();
            console.log(this.value);
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
            $("#token").css("top",point_y-27);
            $("#token").show();
            });
            // Maps opacities
            $("#transparency").change(function(){
                $("#map").css("opacity",this.value);
            });
        });
    </script>
@endsection
