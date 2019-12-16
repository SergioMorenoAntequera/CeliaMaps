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
                Modificar mapa
            </div>

            <div class="card-body">
                <form method="POST" action="{{route('map.update', $map->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" name="title" value="{{$map->title}}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="{{$map->description}}">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" name="city" value="{{$map->city}}">
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="number" class="form-control" name="date" value="{{$map->date}}">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" value="{{$map->image}}">
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <input type="int" class="form-control" name="level" value="{{$map->level}}">
                    </div>
                    <div class="form-group">
                        <label>Width</label>
                        <input type="text"  class="form-control" name="width" value="{{$map->width}}">
                    </div>
                    <div class="form-group">
                        <label>Height</label>
                        <input type="text" class="form-control" name="height" value="{{$map->height}}">
                    </div>
                    <div class="form-group">
                        <label>Deviation_x</label>
                        <input type="text" class="form-control" name="deviation_x" value="{{$map->deviation_x}}">
                    </div>
                    <div class="form-group">
                        <label>Deviation_y</label>
                        <input type="text" class="form-control" name="deviation_y" value="{{$map->deviation_y}}">
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