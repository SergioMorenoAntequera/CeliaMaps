@extends('layouts.master')

@section('title', 'Celia Maps')

@section('cdn')
@endsection

@section('content')
    <div class="container">
        <div class="wholePanel">
            <div class="leftPanel">
                <div class="content">
                   Inserción de mapa
                   <br>
                   <img src="{{url('img/icons/tlMenuMapWhite.png')}}" alt="CeliaMaps" class="img-fluid"> 
                </div>
            </div>    
            <div class="rightPanel">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin: 0px">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="createForm" method="POST" class="text-left" action="{{route('map.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Título <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Almería XXI">
                    </div>
                    <div class="form-group">
                        <label>Fecha <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="date" value="{{old('date')}}" placeholder="2020">
                    </div>
                    <div class="form-group">
                        <label>Imagen del mapa <span class="text-danger">*</span></label>
                        <input id="uploadImage" type="file" accept=".png, .jpeg, .jpg" value="{{old('image')}}" class="form-control clearInput" name="image" placeholder="Archivo del mapa">
                    </div>

                    {{-- Show more para poder meter información adicional --}}
                    <div class="showMore noselect">
                        <p><i class="fa fa-caret-right"></i> Información adicional </p>
                    </div>
                    <div class="more" style="display: none">
                        <div class="form-group">
                            <label>Descripción</label>
                            <input type="text" class="form-control" name="description" value="{{old('description')}}" placeholder="Mapa de Almería en el 2020">
                        </div>
                        <div class="form-group">
                            <label>Ciudad</label>
                            <input type="text" class="form-control" name="city" value="{{old('city')}}" placeholder="Almería, Aguadulce...">
                        </div>
                        <div class="form-group">
                            <label>Miniatura</label>
                            <input type="file" class="form-control clearInput" accept=".png, .jpeg, .jpg" name="miniature" value="{{old('miniature')}}" placeholder="Miniatura del mapa">
                        </div>
                    </div>

                    {{-- Show more para pooder herdar calles --}}
                    <div class="showMore noselect mt-3">
                        <p><i class="fa fa-caret-right"></i> Heredar calles de otro mapa </p>
                    </div>
                    <div class="more" style="display: none; max-height: 500px">
                        {{-- Campo invisible que vamos actualizando para enviar el mapa del que heredar --}}
                        <input id="inherateInput" type="hidden" name="inherit" value="Ninguno">

                        <div class="row ml-1 mr-1">
                            <div id="mapsList" class="col-4 border-right border-success">
                                <p><b> Listado de Mapas </b></p> 
                                <p class="mapToInherit selected"> Ninguno </p>
                                @foreach ($maps as $map)
                                    <p class="mapToInherit"> {{$map->title}} </p>
                                @endforeach
                            </div>
                            <div class="col-8">
                                <p><b> Calles que se heredarán </b></p> 
                                <div id="streetsList">
                                    <p> Selecciona el nombre de un mapa a la izquierda para ver sus calles y heredarlas </p>
                                </div>
                            </div>
                            <script>
                                $(".mapToInherit").on("click", function(){
                                    $("#mapsList .selected").removeClass("selected");
                                    $(this).addClass("selected");
                                    $("#inherateInput").val($(this).text().trim());
                                    
                                    if($(this).text().includes("Ninguno")){
                                        $("#streetsList").empty();
                                        $("#streetsList").append("<p> Selecciona el nombre de un mapa a la izquierda para ver sus calles y heredarlas </p>");
                                        return;
                                    }

                                    var url = window.location.href.replace("create", "streets");
                                    console.log(url);
                                    //Petición ajax para recuperar las calles de los mapas
                                    $.ajax({
                                        type: 'GET',
                                        url: url,
                                        data: {title : $(this).text()},

                                        success: function(data) {
                                            $("#streetsList").empty();
                                            if(data.streets.length == 0){
                                                $("#streetsList").append("<p class='text-danger'> Este mapa no contiene ninguna calle que puedas heredar </p>");
                                                return;
                                            }
                                            
                                            data.streets.forEach(street => {
                                                $("#streetsList").append("<p>"+ street.type.name + " " + street.name +"</p>");
                                            });
                                        },
                                    });
                                });
                            </script>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function(){
                            $(".showMore").on("click", function(){
                                if($(this).find(".fa").hasClass("fa-caret-right")){
                                    $(this).find(".fa").removeClass("fa-caret-right");
                                    $(this).find(".fa").addClass("fa-caret-down");
                                } else {
                                    $(this).find(".fa").removeClass("fa-caret-down");
                                    $(this).find(".fa").addClass("fa-caret-right");
                                }
                                $(this).next(".more").slideToggle(200);
                            });
                        });
                    </script>
                    <button id="btnAlign" class="mt-3 btn btn-success"> Continuar </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    footer
@endsection