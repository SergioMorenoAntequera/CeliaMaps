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
                        <textarea class="form-control" style="height: 110px" name="description">{{$hotspot->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="lat" value="{{$hotspot->lat}}">
                        <input type="hidden" class="form-control" name="lng" value="{{$hotspot->lng}}">
                    </div>

                    <button type="submit" class="mt-3 btn btn-success"> Confirmar Cambios </button>
                </form>
                <a href="{{route('hotspot.index')}}">
                    <div class="cornerButton">
                        <img class="center" src="{{url("img/icons/close.svg")}}" alt=""> 
                    </div>
                </a>
           </div>
        </div>    
    </div>
@endsection