@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se crean todos los mapas
@endsection

@section('content')
    <br>
    <div class="container w-50 text-center">
        <div class="card">
            <div class="card-header">
                Registar mapa
            </div>

            <div class="card-body">
                <form method="POST" action="{{route('map.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" name="title" placeholder="Title of the map">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" placeholder="Description of the map">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" name="city" placeholder="City of the map">
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="number" class="form-control" name="date" placeholder="Year of the map">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" placeholder="File of the map">
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <input type="int" class="form-control" name="level" placeholder="Level of the map">
                    </div>
                    <div class="form-group">
                        <label>Width</label>
                        <input type="text"  class="form-control" name="width" placeholder="Width of the map">
                    </div>
                    <div class="form-group">
                        <label>Height</label>
                        <input type="text" class="form-control" name="height" placeholder="Height of the map">
                    </div>
                    <div class="form-group">
                        <label>Deviation_x</label>
                        <input type="text" class="form-control" name="deviation_x" placeholder="Deviation_x of the map">
                    </div>
                    <div class="form-group">
                        <label>Deviation_y</label>
                        <input type="text" class="form-control" name="deviation_y" placeholder="Deviation_y of the map">
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