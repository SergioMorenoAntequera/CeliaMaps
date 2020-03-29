@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    <!--  Head html  -->
@endsection


@section('content')
    
    <div class="container text-center mt-2">
        <div class="wholePanel" style="min-height: 570px">
            <div class="leftPanel" id="mapsList"  style="min-height: 570px">
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
                <div id="streetsList" style="max-height: 470px">
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
@endsection

@section('footer')

    <div>
        <!--  Footer html  -->
    </div>

@endsection
