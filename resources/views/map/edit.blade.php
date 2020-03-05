@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se crean modifican los mapas
@endsection

@section('content')
    <div class="container text-center">
        <div class="wholePanel">
            <div class="leftPanel">
                <div class="mt-3 content ">
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
                    <button type="submit" class="mt-3 btn btn-success"> Confirmar Cambios </button>
                    <a href="{{route('map.align', $map->id)}}"> <button class="btn-align mt-3 btn btn-warning"> Alinear Mapa </button></a>
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

    <div class="container w-50 text-center">
        <div class="card">
            <div class="card-header">
                Modificar mapa
            </div>

            <div class="card-body text-secondary">
                
            </div>
        </div>
    </div>
@endsection

@section('footer')
    footer
@endsection