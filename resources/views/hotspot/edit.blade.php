@extends('layouts.master')

@section('title', 'Celia Maps')

@section('content')

    <div class="container-fluid bg">
        <div class="bg">
            
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Editar Hotspot
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-dark" id="exampleModalLabel">Crear nuevo Hotspot</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body text-dark pb-0">
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
            </div>
        </div>        
    </div>
    
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