@extends('layouts.master')

@section('title', 'Celia Maps')

@section('cdn')
<link rel="stylesheet" href="{{url('/css/Forms.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container text-center">
        
        <div class="wholePanel">
            <div class="leftPanel">
                <div class="content justify-content-center align-items-center">
                   Introducción de mapa <br>
                   <img src="{{url('img/icons/tlMenuMapWhite.png')}}" alt="CeliaMaps" class="img-fluid">
                </div>
            </div>    
           <div class="rightPanel">
                <form method="POST" class="text-left" action="{{route('map.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Título *</label>
                        <input type="text" class="form-control" name="title" placeholder="Título del mapa">
                    </div>
                    <div class="form-group">
                        <label>Descripción *</label>
                        <input type="text" class="form-control" name="description" placeholder="Pequeña descripción del mapa">
                    </div>
                    <div class="form-group">
                        <label>Ciudad *</label>
                        <input type="text" class="form-control" name="city" placeholder="Ciudad/es del mapa">
                    </div>
                    <div class="form-group">
                        <label>Fecha *</label>
                        <input type="number" class="form-control" name="date" placeholder="Año del mapa">
                    </div>
                    <div class="form-group">
                        <label>Imagen *</label>
                        <input type="file" class="form-control" name="image" placeholder="Archivo del mapa">
                    </div>
                    <div class="form-group">
                        <label>Miniatura</label>
                        <input type="file" class="form-control" name="miniature" placeholder="Miniature ile of the map">
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    footer
@endsection