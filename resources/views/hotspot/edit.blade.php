@extends('layouts.master')

@section('title', 'Celia Maps')

@section('content')
    <div class="container text-center">
        <div class="wholePanel">
            <div class="leftPanel">
                <div class="mt-3 content justify-content-center align-items-center">
                    Modificando hotspot
                    <br>
                    <p class="mb-3" style="margin-bottom: 0px;  font-size: 50px">{{$hotspot->title}}</p>
                    @if ($hotspot->images[0] != "")
                        <img class="mb-4" src="{{url('img/hotspots/'.$hotspot->images[0]->file_name.'')}}" alt="Miniatura">  
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
               <form method="POST" action="{{route('hotspot.update', $hotspot->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    
                    <div class="form-group">
                        <label>Título <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{$hotspot->title}}">
                    </div>
                    <div class="form-group">
                        <label>Descripcion <span class="text-danger">*</span></label>
                        <textarea class="form-control" style="height: 110px">{{$hotspot->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Imagen del hotspot <span class="text-danger">*</span></label>
                        <input id="uploadImage" type="file" accept=".png, .jpeg, .jpg" value="{{$hotspot->images[0]->file_name}}" class="form-control clearInput" name="image" placeholder="Archivo del mapa">
                    </div>

                    <button type="submit" class="mt-3 btn btn-success"> Confirmar Cambios </button>
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