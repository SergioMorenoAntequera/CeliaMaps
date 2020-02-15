@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se crean modifican los mapas
@endsection

@section('content')
    <div class="container text-center">
        <div class="wholePanel">
            <div class="leftPanel">
                <div class="content justify-content-center align-items-center">
                   Modificando mapa
                   <br>
                   <p style="margin-bottom: 0px;  font-size: 50px">{{$map->title}}</p>
                   <img src="{{url('img/maps/$map->miniature')}}" alt="Sin Miniatura" class="img-fluid"> 
                   
                </div>
            </div>    
           <div class="rightPanel">
               <form method="POST" action="{{route('map.update', $map->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    
                    <div class="form-group">
                        <label>Título *</label>
                        <input type="text" class="form-control" name="title" value="{{$map->title}}" placeholder="Título del mapa">
                    </div>
                    <div class="form-group">
                        <label>Descripción *</label>
                        <input type="text" class="form-control" name="description" value="{{$map->description}}" placeholder="Pequeña descripción del mapa">
                    </div>
                    <div class="form-group">
                        <label>Ciudad *</label>
                        <input type="text" class="form-control" name="city" value="{{$map->city}}" placeholder="Ciudad/es del mapa">
                    </div>
                    <div class="form-group">
                        <label>Fecha *</label>
                        <input type="number" class="form-control" name="date" value="{{$map->date}}" placeholder="Año del mapa">
                    </div>
                    <div class="form-group">
                        <label>Imagen *</label>
                        <input type="file" class="form-control" name="image" placeholder="Archivo del mapa">
                    </div>
                    <div class="form-group">
                        <label>Miniatura</label>
                        <input type="file" class="form-control" name="miniature" placeholder="Miniature ile of the map">
                    </div>
                    <button type="submit" class="btn btn-primary">Modificar</button>
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