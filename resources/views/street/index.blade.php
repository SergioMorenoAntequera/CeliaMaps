@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    <!--  Head html  -->
@endsection


@section('content')
    
    <div class="container text-center mt-2">
        <div class="wholePanel mb-1" style="min-height: 570px">
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
                        <p>{{$street->type->name}} {{$street->name}}
                            @foreach ($street->maps as $map)
                                <span class="float-right mx-1"> {{$map->title}} </span>
                            @endforeach
                        </p>
                    @endforeach
                </div>
                <a class="linkToEditMap" href="">
                <div class="editStreetsInMap cornerButton"> 
                    <p class="center">
                        Modificar calles de este mapa
                    </p> 
                </div>
                </a>
            </div>
            
            <style>
                .selected{color: white;}
                .mapToInherit:hover{color: white; font-weight: bold;} 
            </style>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(".mapToInherit").on("click", function(){
        $("#mapsList .selected").removeClass("selected");
        $(this).addClass("selected");
        $("#inherateInput").val($(this).text().trim());
        
        if($(this).text().trim() != "Todos"){
            $(".editStreetsInMap").fadeIn(200);
        } else {
            $(".editStreetsInMap").fadeOut(200);
        }
        
        if($(this).text().trim() == "Todos"){
            $("#streetsList").empty();
            @foreach ($streets as $street)
                $("#streetsList").append("<p>{{$street->type->name}} {{$street->name}}" +
                    @foreach ($street->maps as $map)
                        "<span class='float-right mx-1'>{{$map->title}}</span>" +
                    @endforeach
                "</p>");
            @endforeach
        }else{
            var url = window.location.href.replace("street", "map/streets");
            // Petición ajax para recuperar las calles de los mapas
            $.ajax({
                type: 'GET',
                url: url,
                data: {title : $(this).text()},
    
                success: function(data) {
                    
                    // Change edit map button
                    let editMapUrl = window.location.href.replace("street", "map/"+ data.id +"/edit");
                    $(".linkToEditMap").attr("href", editMapUrl);
    
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
        }

    });
</script>
@endsection
