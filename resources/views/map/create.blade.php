@extends('layouts.master')

@section('title', 'Celia Maps')

@section('cdn')
@endsection

@section('content')
    <div class="container text-center">
        
        <div class="wholePanel">
            <div class="leftPanel">
                <div class="content justify-content-center align-items-center">
                   Inserción de mapa
                   <br>
                   <img src="{{url('img/icons/tlMenuMapWhite.png')}}" alt="CeliaMaps" class="img-fluid"> 
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
                <form method="POST" class="text-left" action="{{route('map.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Título <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Almería XXI">
                    </div>
                    <div class="form-group">
                        <label>Fecha <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="date" value="{{old('date')}}" placeholder="2020">
                    </div>
                    <div class="form-group">
                        <label>Imagen del mapa <span class="text-danger">*</span></label>
                        <input id="uploadImage" type="file" accept=".png, .jpeg, .jpg" value="{{old('image')}}" class="form-control clearInput" name="image" placeholder="Archivo del mapa">
                    </div>

                    <div class="showMore noselect">
                        <p><i class="fa fa-caret-right"></i> Información adicional </p>
                    </div>
                    <div class="more" style="display: none">
                        <div class="form-group">
                            <label>Descripción</label>
                            <input type="text" class="form-control" name="description" value="{{old('description')}}" placeholder="Mapa de Almería en el 2020">
                        </div>
                        <div class="form-group">
                            <label>Ciudad</label>
                            <input type="text" class="form-control" name="city" value="{{old('city')}}" placeholder="Almería, Aguadulce...">
                        </div>
                        <div class="form-group">
                            <label>Miniatura</label>
                            <input type="file" class="form-control clearInput" accept=".png, .jpeg, .jpg" name="miniature" value="{{old('miniature')}}" placeholder="Miniatura del mapa">
                        </div>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $(".showMore").on("click", function(){
                                if($(this).find(".fa").hasClass("fa-caret-right")){
                                    $(this).find(".fa").removeClass("fa-caret-right");
                                    $(this).find(".fa").addClass("fa-caret-down");
                                } else {
                                    $(this).find(".fa").removeClass("fa-caret-down");
                                    $(this).find(".fa").addClass("fa-caret-right");
                                }
                                $(this).siblings(".more").slideToggle(200);
                            });
                        });
                    </script>
                    <button type="submit" class="mt-3 btn btn-success"> Continuar al alineamiento </button> 
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    footer
@endsection