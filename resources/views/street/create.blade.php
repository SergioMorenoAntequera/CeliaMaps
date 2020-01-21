@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    <!--  Header html  -->
@endsection

@section('content')

    <!-- Maps -->

    <div id="frame">
    <img id="map" src="{{url('img/maps/mapa-prueba.png')}}">
        <input id="transparency" type="range" step="0.01" min="0" max="1" value="1" class="custom-range">
        <img id="token" src="{{url('img/icons/token.svg')}}">
    </div>


    <!-- Add street modal -->

    <div class="modal fade" id="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                    <form method="POST" action="{{route('street.store')}}" enctype="multipart/form-data">
                        @csrf
                        @method("POST")
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title text-primary">Nueva vía</h5>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                        </div>

                        <div class="modal-body">
                        <div class="form-group">
                            <label class="text-dark">Tipo de vía</label>
                            <select name="type_id" class="form-control">
                                @foreach ($streetsTypes as $streetType)
                                <option value="{{$streetType->id}}">({{$streetType->abbreviation}}) {{$streetType->type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Nombre de la vía</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Mapas que lo contienen</label><br>
                            @foreach ($maps as $map)
                                <input type="checkbox" name="map_id" value="{{$map->id}}" checked>
                                <span class="text-dark">{{$map->title}} ({{$map->city}} - {{$map->date}})</span>
                                <input id="input_map{{$map->id}}" class="form-control" type="text" name="name_map{{$map->id}}" placeholder="Sobreescribir el nombre de la vía en el mapa {{$map->title}}">
                                <br>
                            @endforeach
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    <!-- Modify street modal -->

    
    
@endsection

@section('footer')
    <!--  Footer html  -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            // Rename streets
            $("input[name='map_id']").click(function(){
                $("#input_map"+this.value).toggle();
                console.log(this.value);
            });
            // Modal
            $('#map').click(function(e){
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