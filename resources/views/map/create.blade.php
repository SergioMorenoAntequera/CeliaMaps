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
                {{-- Control de errores del Auth  --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin: 0px">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulario --}}
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

                    {{-- Show more para pooder heredar calles --}}
                    <div class="showMore noselect mt-3">
                        <p><i class="fa fa-caret-right"></i> Heredar calles de otro mapa </p>
                    </div>
                    <div class="more" style="display: none; max-height: 500px">
                        
                        {{-- Campo invisible que vamos actualizando para enviar el mapa del que heredar --}}
                        <input id="inherateInput" type="hidden" name="inherit" value="Ninguno">

                        <div class="row ml-1 mr-1">
                            {{-- Listado  de mapas --}}
                            <div id="mapsList" class="col-4 border-right border-success">
                                <p><b> Listado de Mapas </b></p> 
                                <p class="mapToInherit selected"> Ninguno </p>
                                @foreach ($maps as $map)
                                    <p class="mapToInherit"> {{$map->title}} </p>
                                @endforeach
                            </div>
                            {{-- Listado de calles --}}
                            <div class="col-8">
                                <p>
                                    <input type="checkbox" class="selectAllCB" checked>
                                    <b> Calles que se heredarán </b>
                                </p>
                                <input style="display: none" type="text" class="streetFilter form-control mb-2" placeholder="Filtrador de calles">
                                <div id="streetsList">
                                    <p> Selecciona el nombre de un mapa a la izquierda para ver sus calles y heredarlas </p>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    {{-- Botón para ir al alineado del mapa --}}
                    <button id="btnAlign" class="mt-3 btn btn-success"> Continuar </button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    {{-- Para que aparezcan los ShowMore y todo el rollo --}}
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


    {{-- El mapa en el que se pincha a la hora de heredar de un mapa
    Petición ajax para pedir las calles dentro --}}
    {{-- Preparo la url fuera por si esto lo quiero llevar a un cifhero externo --}}
    <script> var getStreetsUrl = "{{route('map.streets')}}"; </script>
    <script>
        $(".mapToInherit").on("click", function(){
            var mapTitle = $(this).text();
            $("#mapsList .selected").removeClass("selected");
            $(this).addClass("selected");
            $("#inherateInput").val(mapTitle.trim());
            
            if(mapTitle.includes("Ninguno")){
                $("#streetsList").empty();
                $(".streetFilter").hide();
                $("#streetsList").append("<p> Selecciona el nombre de un mapa a la izquierda para ver sus calles y heredarlas </p>");
                
            } else {
                // Petición ajax para recuperar las calles de los mapas
                // También se encarga de colocarlo en la pantalla
                var data = getStreetsAjax(mapTitle);
            }

        });

        function getStreetsAjax(mapTitle) {
            $.ajax({
                url: getStreetsUrl,
                data: {title : mapTitle},
                success: function(data) {
                    //Limpiamos la lista
                    $("#streetsList").empty();

                    //Ponemos la lista de calles nueva si la hay
                    if(data.streets.length != 0){
                        data.streets.forEach(street => {
                            $(".streetFilter").show();
                            $(".streetFilter").val("");
                            $(".selectAllCB").prop("checked", true);
                            $("#streetsList").append("<p class='mb-0 mr-1 streetFound'> <input class='cbStreet' type='checkbox' name='streetsInMap[]' value='"+ street.id +"' checked><span>"+ street.type.name + " " + street.name +"</span></p>");
                        });
                    } else {
                        $(".streetFilter").hide();
                        $(".selectAllCB").prop("checked", false);
                        $("#streetsList").append("<p class = 'text-danger'> Este mapa no contiene ninguna calle que puedas heredar </p>");
                    }
                },
            });
        };
    </script>


    {{-- Dentro del menú de herencia para seleccionar los cb 
    y el filtrado de las calles --}}
    <script>
        // Checkbox que selecciona todos 
        $(".selectAllCB").change(function(){
            var cbs = $(".cbStreet");
            if($(this).is(":checked")){
                for (let i = 0; i < cbs.length; i++) {
                    const checkboxInList = jQuery(cbs[i]);
                    checkboxInList.prop("checked", true);
                }
            } else {
                for (let i = 0; i < cbs.length; i++) {
                    const checkboxInList = jQuery(cbs[i]);
                    checkboxInList.prop("checked", false);
                }
            }
        });

        // Input que filtra las calles 
        $(".streetFilter").keyup(function(){
            var text = $(this).val();
            var streetContainer = $("#streetsList");
            streetContainer.children().each(function(e){
                var streetName = $(this).find("span").text();
                if(streetName.toLowerCase().includes(text.toLowerCase())){
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    </script>

@endsection