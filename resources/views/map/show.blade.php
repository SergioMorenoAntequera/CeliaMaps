@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se enseña un mapa en particular
@endsection

@section('content')
    
    <div class="container">
        <div class="wholePanel">
            <div class="leftPanel">
                <div class="mt-3 content">
                    Información del mapa {{$map->title}}
                    <br>
                    @if ($map->miniature != "")
                        <img class="mb-4" src="{{url('img/miniatures/'.$map->miniature.'')}}" alt="Miniatura">  
                    @else 
                        <img class="mb-4" src="{{url('img/maps/NoMap.png')}}" alt="Sin Miniatura">  
                    @endif
                </div>
            </div>    
            <div class="rightPanel">
                <p class="title"> Título</p>
                <p>{{$map->title}}</p>

                <p class="title"> Fecha</p>
                <p>{{$map->date}}</p>

                <p class="title"> Descipción</p>
                <p>{{$map->description}}</p>

                <div class="showMore noselect">
                    <p><i class="fa fa-caret-right"></i> Información adicional </p>
                </div>
                <div class="more" style="display: none">
                    <p class="title"> Ciudad</p>
                    <p>{{$map->city}}</p>

                    <p class="title"> Nivel de la capa </p>
                    <p>{{$map->level}}</p>
                </div>
                <a class="btn btn-primary" href="{{route('map.edit', $map->id)}}" role="button">
                    <img class="center img-fluid" src="{{url("img/icons/edit.svg")}}" alt=""> 
                </a>
                

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
                            $(this).siblings(".more").slideToggle(200);
                        });
                    });
                </script>
            </div>
        </div>    
    </div>

@endsection

@section('footer')
    footer
@endsection