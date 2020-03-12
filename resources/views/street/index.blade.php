@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    <!--  Head html  -->
@endsection


@section('content')
    
    <div class="container text-center mt-2">
        <div class="wholePanel" style="min-height: 570px">
            <div id="mapsList" class="leftPanel" style="min-height: 570px">
                <div class="content" style="font-size: 18px; font-weight: normal">
                    <p style="font-size: 30px"><b> Listado de Mapas </b></p>
                    <p class="mapToInherit selected"> Todos </p>
                    @foreach ($maps as $map)
                        <p class="mapToInherit"> {{$map->title}} </p>
                    @endforeach
                    </div>
            </div>
            <div class="rightPanel">
                <p><b> Calles del mapa </b></p> 
                <div id="streetsList">
                    @foreach ($streets as $street)
                        <p>{{$street->type->name}} {{$street->name}}</p>
                    @endforeach
                </div>
            </div>
            <style>
                .selected{color: white;}
                .mapToInherit:hover{color: white; font-weight: bold;} 
            </style>
            <script>
                $(".mapToInherit").on("click", function(){
                    $("#mapsList .selected").removeClass("selected");
                    $(this).addClass("selected");
                    $("#inherateInput").val($(this).text().trim());
    
                    console.log();
                    var url = window.location.href.replace("street", "map/streets");
                    console.log(url);
                    // Petición ajax para recuperar las calles de los mapas
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
    

    <!-- One div to get all the maps -->
    {{-- <div class="container text-center">
        <div class="row text-center my-5">
            <div class="col-12">
                <button class="btn btn-primary" >Todas</button>
                @foreach ($maps as $map)
                    <button class="btn btn-primary">{{$map->title}}</button>
                @endforeach
            </div>
        </div>
        
        <a href="{{route('street.create')}}"> 
            <button>Nueva</button> 
        </a>

        <!-- La fila para agrupar todas las columnas -->
        <div class="row allElements justify-content-center">
            <!-- Por cada mapa guardado en la base de datos -->
            @foreach ($streets as $street)
                <div class="oneElement col-8">
                    <div class="textElement bg-primary">
                        <!-- Name -->
                        <a class="text-white" href="{{route("street.show", $street->id)}}">{{$street->type->type}} {{$street->name}}</a>
                        <!-- Maps -->
                        @foreach ($street->maps as $map)
                            <br>
                            <a class="text-white" href="{{route("map.show", $map->id)}}">{{$map->title}} ({{$map->city}} - {{$map->date}})</a>
                        @endforeach
                        <!-- Modify button -->
                        <a href="{{route('street.edit', $street->id)}}"> 
                            <button class="cornerUpdateButton bg-secondary">
                                <img src="{{url("img/icons/editWhite.png")}}" alt=""> 
                            </button>
                        </a>
                        <!-- Remove button -->
                        <form method="POST" action="{{route('street.destroy', $street->id)}}">
                            @csrf
                            @method("DELETE")
                            <button class="cornerDeleteButton bg-secondary" type="submit" value="Eliminar">
                                <img src="{{url("img/icons/deleteWhite.png")}}" alt="">    
                            </button>
                        </form>
                    </div>
                </div> <!-- FINAL .oneElement -->
            @endforeach
        </div> <!-- FINAL .allEments -->
    </div> --}}

@endsection

@section('footer')

    <div>
        <!--  Footer html  -->
    </div>

@endsection
