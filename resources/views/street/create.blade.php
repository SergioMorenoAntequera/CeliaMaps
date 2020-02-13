@extends('layouts.master')

@section('title', 'Celia Maps')

@section('cdn')
    <!-- LEAFLET -->
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
        
        @foreach ($streets as $street)    
            <img id="{{$street->id}}" style="top:{{$street->points[0]->y}};left:{{$street->points[0]->x}}" class="token" src="{{url('img/icons/token.svg')}}">
        @endforeach
        <div id="draggable">
            <img id="token" src="{{url('img/icons/token.svg')}}">
        </div>

    </div>


    <!-- Create/edit street modal -->

    <div class="modal fade" id="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                    <form id="modal-form" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title text-primary"></h5>
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
                            <button id="btn-remove" type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
                            <button id="btn-position" type="button" class="btn btn-warning mr-auto" data-dismiss="modal">Cambiar posición</button>
                            <button id="btn-cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button id="btn-submit" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    

    
@endsection

@section('footer')
    <!--  Footer html  -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            
            let streets = @json($streets);
            @for ($i=0;$i<count($streets);$i++) 
                streets[{{$i}}].maps =  @json($streets[$i]->maps)
            @endfor

            // Create street modal
            $('#map').click(function(e){
                $("#modal-form").attr("action", "{{route('street.store')}}");
                $("input[name='_method']").val("POST");
                // Handle click point
                var point_x = e.pageX - this.offsetLeft;
                var point_y = e.pageY - this.offsetTop;
                $(".modal-body #point_x").val(point_x);
                $(".modal-body #point_y").val(point_y);
                // Empty fields
                $("select[name='type_id']").val("");
                $("input[name='name']").val("");
                // Token location and display
                $("#token").css("left",point_x-15);
                $("#token").css("top",point_y-27);
                $("#token").show();
                // Modal display
                $(".modal-title").text("Nueva vía");
                $("#btn-remove").prop("disabled", true);
                $("#btn-remove").css("display", "none");
                $("#btn-position").prop("disabled", true);
                $("#btn-position").css("display", "none");
                setTimeout(function() {
                    $('#modal').modal('show');
                }, 250);
            });
            // Edit street modal
            $('#token, .token').on('click', function(){
                $("#modal-form").attr("action", "{{route('street.store')}}/"+this.id);
                $("input[name='_method']").val("PUT");
                let street;
                for (let i = 0; i < streets.length; i++) {
                    if(streets[i].id == this.id)
                        street = streets[i];
                }

                // Token change

                //$("#token").prop("src", "{{url('img/icons/token-selected.svg')}}" );
                
                // Fill inputs fields
                $("select[name='type_id']").val(street.type_id);
                $("input[name='name']").val(street.name);
                
                console.log(street);
                let streetMaps = new Array();
                for (let i = 0; i < street.maps.length; i++) {
                    streetMaps.push(street.maps[i].id);
                }
                let maps = $("input[name='maps_id[]']");
                for (let j = 0; j < maps.length; j++) {
                    if(streetMaps.includes(parseInt(maps[j].value))){
                        //$("input_map"+maps[j].value).val(street.)
                    }
                }

                // Modal display
                $(".modal-title").text("Editar vía");
                $("#btn-remove").prop("disabled", false);
                $("#btn-remove").css("display", "initial");
                $("#btn-position").prop("disabled", false);
                $("#btn-position").css("display", "initial");
                setTimeout(function() {
                    $('#modal').modal('show');
                }, 250);
            });
            // Rename streets fields
            $("input[type='checkbox']").click(function(){
                // Hide forms fields
                $("#input_map"+this.value).toggle();
                // Disable inputs to do not send
                $("#input_map"+this.value).prop("disabled", function(){
                    return !($(this).prop("disabled"));
                });
            });
            // Re locate street
            $("#btn-position").click(function(){
                //$("#modal").modal("hide");
                

            })
            // Maps opacities
            $("#transparency").change(function(){
                $("#map").css("opacity",this.value);
            });
            // Restore token style
            /*
            $("#modal").click(function(){
                $("#token").prop("src", "{{url('img/icons/token.svg')}}" );
            });
            */
    });
    </script>
@endsection