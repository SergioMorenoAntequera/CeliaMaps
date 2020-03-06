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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin: 0px">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
                        {{-- Input escondido paraver lo que queremos hacer con las callles--}}
                        <div class="form-group">
                            <input type="hidden" id="streetsToDo" class="form-control" name="streetsToDo" value="Calles actuales">
                        </div>
                        {{-- Barra de navegación para ver que queremos hacer --}}
                        <nav class="mt-2">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <a class="nav-item nav-link active " id="nav-streets-tab" data-toggle="tab" href="#nav-streets" role="tab" aria-controls="nav-streets" aria-selected="true">Calles actuales</a>
                              <a class="nav-item nav-link" id="nav-inherit-tab" data-toggle="tab" href="#nav-inherit" role="tab" aria-controls="nav-inherit" aria-selected="false">Heredar</a>
                            </div>
                            {{-- Actualizar el input escondido --}}
                            <script>
                                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                                    $("#streetsToDo").attr("value", $(this).text());
                                });
                            </script>
                        </nav>
                        {{-- Tabs con la info --}}
                        <div class="tab-content pt-4" id="nav-tabContent">
                            {{-- Tab para Quitar calles de las que ya hay --}}
                            <div style="max-height: 400px; overflow-y: auto;" class="tab-pane fade show active ml-2" id="nav-streets" role="tabpanel" aria-labelledby="nav-streets-tab">
                                <div>
                                    @if (sizeof($map->streets) > 0)
                                        <b>Calles: </b> <br>
                                        @foreach ($map->streets as $street)
                                            <p class="streetInMap">
                                                <input type="checkbox" name="calles[]" value="{{$street->id}}" checked>
                                                {{$street->type->name}} {{$street->name}}
                                            </p>
                                        @endforeach
                                    @else
                                        <p class="text-danger"> Este mapa no tienen ninguna calle </p> <br>
                                    @endif
                                        
                                    <div style="clear:both;"></div>
                                </div>
                                
                            </div>
                            

                            {{-- Tab para heredar las calles de nuevo --}}
                            <div style="max-height: 400px; overflow-y: none;" class="tab-pane fade ml-2" id="nav-inherit" role="tabpanel" aria-labelledby="nav-inherit-tab">
                                {{-- Campo invisible que vamos actualizando para enviar el mapa del que heredar --}}
                                <input id="inherateInput" type="hidden" name="inherit" value="Ninguno">

                                <div class="row ml-1 mr-1">
                                    <div style="height: 400px" id="mapsList" class="col-4 border-right border-success">
                                        <p><b> Listado de Mapas </b></p> 
                                        {{-- <script>var mapsListed = [];</script> --}}
                                        <p class="mapToInherit selected"> Ninguno </p>
                                        @foreach ($maps as $mapInList)
                                            @if ($mapInList->title != $map->title)
                                                <p class="mapToInherit"> {{$mapInList->title}} </p>
                                            @endif
                                            
                                            {{-- <script> mapsListed.push({id:"{{$map->id}}", title:"{{$map->title}}"}); </script> --}}
                                        @endforeach
                                    </div>
                                    <div class="col-8">
                                        <p><b> Calles que se heredarán </b></p> 
                                        <div style="height: 350px" id="streetsList">
                                            <p> Selecciona el nombre de un mapa a la izquierda para ver sus calles y heredarlas </p>
                                        </div>
                                    </div>
                                    <script>
                                        
                                        // console.log(mapsListed);
                                        $(".mapToInherit").on("click", function(){
                                            $("#mapsList .selected").removeClass("selected");
                                            $(this).addClass("selected");
                                            $("#inherateInput").val($(this).text().trim());
                                            
                                            if($(this).text().includes("Ninguno")){
                                                $("#streetsList").empty();
                                                $("#streetsList").append("<p> Selecciona el nombre de un mapa a la izquierda para ver sus calles y heredarlas </p>");
                                                return;
                                            }
                                            
                                            // for (let i = 0; i < mapsListed.length; i++) {
                                            //     const map = mapsListed[i];
                                                
                                            //     if($(this).text().trim() == map.title.trim()){
                                            //         var id = map.id;
                                            //     }
                                            // }
                                            var url = window.location.href.replace(currentMapId+"/edit", "streets");
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
                        </div>
                    </div>
                    
                    {{-- Para que secierren bien las cosas --}}
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
                    
                    <button type="submit" class="mt-5 btn btn-success"> Confirmar Cambios </button>
                    
                    <a href="{{route('map.align', $map->id)}}"> 
                        <button class="btn-align mt-5 btn btn-warning"> Alinear Mapa </button>
                    </a>
                    <script>
                        $(document).ready(function(){
                            $(".btn-align").on("click", function(e){
                                e.preventDefault();
                                location.href = "{{route('map.align', $map->id)}}";
                            })
                        });
                    </script>
                </form>
           </div>
        </div>    
    </div>
@endsection

@section('footer')
    footer
@endsection