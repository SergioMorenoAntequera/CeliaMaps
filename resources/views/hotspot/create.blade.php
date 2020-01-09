@extends('layouts.master')

@section('title', 'Crear Hotspot') 

@section('content')
    <br>
    <div class="container w-50 text-center">
        <div class="card">
            <div class="card-header">
                Registar Hotspot
            </div>

            <div class="card-body">
                <form method="POST" action="{{route('hotspot.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" name="title" placeholder="Title of the hotspot">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" placeholder="Description of the hotspot">
                    </div>
                    <div class="form-group">
                        <label>Punto X</label>
                        <input type="text" class="form-control" name="point_x" placeholder="Point X of the hotspot">
                    </div>
                    <div class="form-group">
                        <label>Punto Y</label>
                        <input type="text" class="form-control" name="point_y" placeholder="Point Y of the hotspot">
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