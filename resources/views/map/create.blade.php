@extends('layouts.master')

@section('title', 'Celia Maps')

@section('cdn')
@endsection

@section('content')
    <div class="container text-center">
        
        <div class="wholePanel">
            <div class="leftPanel">
                <div class="content justify-content-center align-items-center">
                   Introducción de mapa
                   <br>
                   <img src="{{url('img/icons/tlMenuMapWhite.png')}}" alt="CeliaMaps" class="img-fluid"> 
                </div>
            </div>    
           <div class="rightPanel">
                <form method="POST" class="text-left" action="{{route('map.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Título <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Almería XXI">
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" class="form-control" name="description" placeholder="Mapa de Almería en el 2020">
                    </div>
                    <div class="form-group">
                        <label>Ciudad <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="city" placeholder="Almería, Aguadulce...">
                    </div>
                    <div class="form-group">
                        <label>Fecha <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="date" placeholder="2020">
                    </div>
                    <div class="form-group">
                        <label>Imagen del mapa <span class="text-danger">*</span></label>
                        <input id="uploadImage" type="file" class="form-control" name="image" placeholder="Archivo del mapa">
                    </div>
                    <div class="form-group">
                        <label>Miniatura</label>
                        <input type="file" class="form-control" name="miniature" placeholder="Miniatura del mapa">
                    </div>
                    <button type="submit" class="btn btn-primary"> Continuar </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    footer
@endsection