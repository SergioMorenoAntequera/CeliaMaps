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
                                <input type="checkbox" name="maps_id[]" value="{{$map->id}}" checked>
                                <span class="text-dark">{{$map->title}} ({{$map->city}} - {{$map->date}})</span>
                                <input id="input_map{{$map->id}}" class="form-control" type="text" name="maps_name[]" placeholder="Sobreescribir el nombre de la vía en el mapa {{$map->title}}">
                                <br>
                            @endforeach
                        </div>
                        <!-- Street points -->
                        <div>
                            <input type="hidden" id="point_x" name="point_x">
                            <input type="hidden" id="point_y" name="point_y">
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
            // Rename streets toggle display
            $("input[name='map_id']").click(function(){
                $("#input_map"+this.value).toggle();
                console.log(this.value);
            });
            // Create street modal
            $('#map').click(function(e){
                // Handle click point
                var point_x = e.pageX - this.offsetLeft;
                var point_y = e.pageY - this.offsetTop;
                console.log("X: " + point_x + " Y: " + point_y); 
                // Modal display
                setTimeout(function() {
                    $('#modal').modal('show');
                }, 250);
                // Coordenadas punto
                $(".modal-body #point_x").val(point_x);
                $(".modal-body #point_y").val(point_y);
                // Token location and display
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