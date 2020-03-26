@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se crean modifican los mapas
@endsection

@section('content')
    <script>var currentMapId = "{{$map->id}}";</script>
    <div class="container text-center">
        <div class="wholePanel">
            <div class="leftPanel">
                <div class="mt-3 content justify-content-center align-items-center">
                    Modificando mapa
                    <br>
                    <p class="mb-3" style="margin-bottom: 0px;  font-size: 50px">{{$map->title}}</p>
                    @if ($map->miniature != "")
                        <img class="mb-4" src="{{url('img/miniatures/'.$map->miniature.'')}}" alt="Miniatura">  
                    @else 
                        <img class="mb-4" src="{{url('img/maps/NoMap.png')}}" alt="Sin Miniatura">  
                    @endif
                </div>
            </div>    
           <div class="rightPanel">
                {{-- Errores de validación y todo eso --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin: 0px">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulario con todos los campos que rellenar --}}
               <form method="POST" action="{{route('map.update', $map->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    
                    <div class="form-group">
                        <label>Título <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{$map->title}}" placeholder="Almería XXI">
                    </div>
                    <div class="form-group">
                        <label>Fecha <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="date" value="{{$map->date}}" placeholder="2020">
                    </div>
                    <div class="form-group">
                        <label>Imagen del mapa <span class="text-danger">*</span></label>
                        <input id="uploadImage" type="file" accept=".png, .jpeg, .jpg" value="{{$map->image}}" class="form-control clearInput" name="image" placeholder="Archivo del mapa">
                    </div>

                    {{-- Un more info donde se muestra información adicional del mapa --}}
                    <div class="showMore noselect">
                        <p><i class="fa fa-caret-right"></i> Información adicional </p>
                    </div>
                    <div class="more" style="display: none">
                        <div class="form-group">
                            <label>Descripción</label>
                            <input type="text" class="form-control" name="description" value="{{$map->description}}" placeholder="Mapa de Almería en el 2020">
                        </div>
                        <div class="form-group">
                            <label>Ciudad</label>
                            <input type="text" class="form-control" name="city" value="{{$map->city}}" placeholder="Almería, Aguadulce...">
                        </div>
                        <div class="form-group">
                            <label>Miniatura</label>
                            <input type="file" class="form-control clearInput" accept=".png, .jpeg, .jpg" name="miniature" value="{{$map->miniature}}" placeholder="Miniatura del mapa">
                        </div>
                    </div>

                    {{-- Un more info donde se muestran las calles de los mapas --}}
                    <div class="showMore noselect mt-4">
                        <p><i class="fa fa-caret-right"></i> Calles asociadas </p>
                    </div>
                    <div class="more" style="display: none; overflow-y: hidden">
                        
                        {{-- Input escondido paraver lo que queremos hacer con las callles --}}
                        <div class="form-group">
                            <input type="hidden" id="streetsToDo" class="form-control" name="streetsToDo" value="Calles actuales">
                        </div>
                        
                        {{-- Barra de navegación para ver que queremos hacer --}}
                        <nav class="mt-2">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <a style="color:#3ab398" class="nav-item nav-link active " id="nav-streets-tab" data-toggle="tab" href="#nav-streets" role="tab" aria-controls="nav-streets" aria-selected="true">Calles actuales</a>
                              <a style="color:#3ab398" class="nav-item nav-link" id="nav-inherit-tab" data-toggle="tab" href="#nav-inherit" role="tab" aria-controls="nav-inherit" aria-selected="false">Heredar</a>
                            </div>
                        </nav>

                        {{-- Tabs con la info --}}
                        <div class="tab-content pt-4" id="nav-tabContent">
                            
                            {{-- CALLES ACTUALES --}}
                            <div style="max-height: 400px; overflow-y: auto;" class="tab-pane fade show active ml-2" id="nav-streets" role="tabpanel" aria-labelledby="nav-streets-tab">
                                <input type="text" class="streetFilter form-control mb-2" placeholder="Filtrador de calles">
                                
                                <div id="mapStreets">
                                    <input  type="checkbox" class="selectAllCB" checked> <b> Calles del mapa: </b>
                                    @if (sizeof($map->streets) > 0)
                                        <div class="streetList">
                                            @foreach ($map->streets as $street)
                                                <p class="mb-0 streetInList streetInMap">
                                                    <input class="cbStreet" type="checkbox" name="streetsInMap[]" value="{{$street->id}}" checked>
                                                    <span>{{$street->type->name}} {{$street->name}}</span>
                                                </p>
                                            @endforeach
                                            <div style="clear:both;"> </div>
                                        </div>
                                    @else
                                        <p class="text-danger"> Este mapa no tienen ninguna calle </p> <br>
                                    @endif
                                </div>

                                <div id="otherStreets">
                                    <input  type="checkbox" class="mt-3 selectAllCB"> <b> Añadir calles: </b> 
                                    <div class="streetList">
                                        @php $numberOfStreets = 0; @endphp
                                        @foreach ($streets as $street)
                                            @php $found = false; @endphp
    
                                            @foreach ($map->streets as $mapStreet)
                                                @if ($street->id == $mapStreet->id)
                                                    @php $found = true; @endphp
                                                @endif
                                            @endforeach
    
                                            @if (!$found)
                                                @php $numberOfStreets++; @endphp
                                                <p class="mb-0 streetInList streetInGeneral">
                                                    <input type="checkbox" name="streetsInMap[]" value="{{$street->id}}">
                                                    <span>{{$street->type->name}} {{$street->name}}</span>
                                                </p>
                                            @endif
                                        @endforeach
                                        <div style="clear:both;"></div>
                                        @if ($numberOfStreets == 0)
                                            <p class="text-warning mb-0"> No hay más calles que poder heredar </p> <br>
                                        @endif
                                    </div>
                                </div>
                                
                                
                            </div>

                            {{-- HEREDAR --}}
                            <div style="max-height: 400px; overflow-y: none;" class="tab-pane fade ml-2" id="nav-inherit" role="tabpanel" aria-labelledby="nav-inherit-tab">
                                {{-- Campo invisible que vamos actualizando para enviar el mapa del que heredar --}}
                                <input id="inherateInput" type="hidden" name="inherit" value="Ninguno">
                                <div class="row ml-1 mr-1">
                                    {{-- Lista de mapas --}}
                                    <div style="height: 400px" id="mapsList" class="col-4 border-right border-success">
                                        <p><b> Listado de Mapas </b></p> 
                                        <p class="mapToInherit selected"> Ninguno </p>
                                        @foreach ($maps as $mapInList)
                                            @if ($mapInList->title != $map->title)
                                                 <p class="mapToInherit"> {{$mapInList->title}} </p>
                                            @endif
                                        @endforeach
                                    </div>
                                    {{-- Lista de calles --}}
                                    <div class="col-8">
                                        <p>
                                            <input type="checkbox" class="selectAllCB2" checked>
                                            <b> Calles que se heredarán </b>
                                        </p> 
                                        <input style="display: none" type="text" class="streetFilter2 form-control mb-2" placeholder="Filtrador de calles">
                                        <div id="streetsList">
                                            <p> Selecciona el nombre de un mapa a la izquierda para ver sus calles y heredarlas </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    {{-- SUBMIT --}}
                    <button type="submit" class="mt-5 btn btn-success"> Confirmar Cambios </button>
                    
                    {{-- ALINEAR --}}
                    <button class="btn-align mt-5 btn text-white btn-warning"> Alinear Mapa </button>
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
    
    {{-- --------------------------------------------------------------------- --}}
    {{-- Lo relacionado con el menú de herencias --}}
    {{-- Para ver si queremos modificar calles actuales o heredar desde 0--}}
    <script>
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $("#streetsToDo").attr("value", $(this).text());
        });
    </script>

    {{-- Calles actuales --}}
    <script>
        // Seleccionar todas o no ninguna calle
        $(".selectAllCB").change(function(){
            var cbs = $(this).siblings(".streetList").children(".streetInList").children();
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

        // Filtramos los resultados
        $(".streetFilter").keyup(function(){
            var text = $(this).val();
            var streetContainer = $(this).siblings("div").find(".streetInList");
            streetContainer.each(function(e){
                var streetName = $(this).find("span").text();
                if(streetName.toLowerCase().includes(text.toLowerCase())){
                    $(this).show();
                } else {
                    $(this).hide();
                }
                
            });
        });
    </script>

    {{-- Heredar desde cero --}}
    <script>
        //Seleccionar el mapa desde el que se va a heredar
        $(".mapToInherit").on("click", function(){
            $("#mapsList .selected").removeClass("selected");
            $(this).addClass("selected");
            $("#inherateInput").val($(this).text().trim());
            
            if($(this).text().includes("Ninguno")){
                $("#streetsList").empty();
                $(".streetFilter").hide();
                $("#streetsList").append("<p> Selecciona el nombre de un mapa a la izquierda para ver sus calles y heredarlas </p>");
                return;
            }
            
            var url = window.location.href.replace(currentMapId+"/edit", "streets");
            //Petición ajax para recuperar las calles de los mapas
            $.ajax({
                type: 'GET',
                url: url,
                data: {title : $(this).text()},

                success: function(data) {
                    $("#streetsList").empty();
                    if(data.streets.length != 0){
                        data.streets.forEach(street => {
                            $(".streetFilter2").show();
                            $(".streetFilter2").val("");
                            $(".selectAllCB2").prop("checked", true);
                            $("#streetsList").append("<p class='mb-0 streetFound'> <input class='cbStreet mr-1' type='checkbox' name='streetsInMap2[]' value='"+ street.id +"' checked><span>"+ street.type.name + " " + street.name +"</span></p>");
                        });
                    } else {
                        $(".streetFilter2").hide();
                        $(".selectAllCB2").prop("checked", false);
                        $("#streetsList").append("<p class='text-danger'> Este mapa no contiene ninguna calle que puedas heredar </p>");
                    }
                },
            });
        });

        // Checkbox que selecciona todos 
        $(".selectAllCB2").change(function(){
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

        $(".streetFilter2").keyup(function(){
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

    {{-- --------------------------------------------------------------------- --}}
    {{-- Codigo botón alinear --}}
    <script>
        $(document).ready(function(){
            $(".btn-align").on("click", function(e){
                e.preventDefault();
                location.href = "{{route('map.align', $map->id)}}";
            })
        });
    </script>

@endsection