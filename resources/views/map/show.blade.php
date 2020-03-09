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

                {{-- Un more info donde se muestra la informacióon adicional --}}
                <div class="showMore noselect">
                    <p><i class="fa fa-caret-right"></i> Información adicional </p>
                </div>
                <div class="more" style="display: none">
                    <p class="title"> Descipción</p>
                    <p>{{$map->description}}</p>

                    <p class="title"> Ciudad</p>
                    <p>{{$map->city}}</p>

                    <p class="title"> Nivel de la capa </p>
                    <p>{{$map->level}}</p>
                </div>

                {{-- Un more info donde se muestran las calles de los mapas --}}
                <div class="showMore noselect mt-4">
                    <p><i class="fa fa-caret-right"></i> Calles asociadas </p>
                </div>
                <div class="more" style="display: none">
                    @php $i = 1 @endphp
                    
                    @if (sizeof($map->streets) > 0)
                        <b>Calles: </b> <br>
                        @foreach ($map->streets as $street)
                            <p class="streetInMap">
                                {{$street->type->name}} {{$street->name}}
                            </p>
                        @endforeach
                    @else
                        <p class="text-danger"> Este mapa no tienen ninguna calle </p> <br>
                        <a href="{{route('map.edit', $map->id)}}"> Añadir calles </a>
                    @endif
                        
                    <div style="clear:both;"></div>
                </div>

                {{-- Boton para modificar --}}
                <a href="{{route('map.edit', $map->id)}}">
                    <button class=" mt-3 btn btn-warning text-white">
                        Modificar
                    </button>
                </a>
                <!-- FIN Boton para modificar -->

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
            </div>
        </div>    
    </div>

@endsection

@section('footer')
    footer
@endsection