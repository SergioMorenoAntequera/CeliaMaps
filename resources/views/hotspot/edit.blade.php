@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se crean modifican los mapas
@endsection

@section('content')
    <br>
    <div class="container w-50 text-center">
        <div class="card">
            <div class="card-header">
                Modificar Hotspot
            </div>

            <div class="card-body">
                <form method="POST" action="{{route('hotspot.update', $hotspot->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" name="title" value="{{$hotspot->title}}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="{{$hotspot->description}}">
                    </div>
                    <div class="form-group">
                        <label>Punto X</label>
                        <input type="text" class="form-control" name="point_x" value="{{$hotspot->point_x}}">
                    </div>
                    <div class="form-group">
                        <label>Punto Y</label>
                        <input type="text" class="form-control" name="point_y" value="{{$hotspot->point_y}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Modificar</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    footer
@endsection