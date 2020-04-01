@extends('layouts/master')

@section('title', 'Celia Maps')

@section('content')	

    {{-- SEARCH BAR --}}
    
    <div class="input-group md-form form-sm form-1 pl-0" style="margin: 15px; width: auto;">
        <div class="input-group-prepend">
            <span class="input-group-text purple lighten-3" id="basic-text1">
                <img class="imgSearch" src="{{url('img/icons/lupa-blanca.png')}}">
            </span>
        </div>
        <input id="searchBar" class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search">
    </div>

    {{-- IMAGES --}}
    
    <div id="allElements" style="display: flex; flex-wrap: wrap;">
        @foreach ($images as $image)
            <a class="element col-md-4" name="{{$image->id}}" style="margin: 15px 0; padding: 0 15px; flex: 0 0 33.333333%; max-width: 455px; position: relative; overflow: hidden; height: 325px" href="#" data-toggle="light-box" data-gallery="gallery">
                <img class="rounded" style="height: 100%" src="{{url('img/hotspots/', $image->file_name)}}"> <br>
            </a>
        @endforeach
    </div>

    {{-- MODAL CARROUSEL --}}
    
    <div id="ekkoLightbox-893" class="ekko-lightbox modal fade text-dark" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="flex: 1 1 1px; max-width: 70%;">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="ekko-lightbox-container" style="height: 720px;">
                        <div class="ekko-lightbox-item fade"></div>
                        <div class="ekko-lightbox-item fade in show text-center">
                            <img id="previewImage" class="img-fluid center-block" src="" style="height: 100%; display: inline-block;" alt="Imagen Hotspot">
                        </div>
                        <div class="ekko-lightbox-nav-overlay">
                            <a id="anterior" href="#">
                                <span>❮</span>
                            </a>
                            <a id="siguiente" href="#">
                                <span>❯</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Boton para Borrar  -->
                <form method="POST" action="{{route('hotspot.deleteAjax', $image->id)}}">
                    @csrf
                    @method("DELETE")

                    <div data-toggle="modal" data-target="#ModalCenter{{$image->id}}" class="deleteCornerButton cornerButton">
                        <img class="center" src="{{url("img/icons/delete.svg")}}" alt=""> 
                    </div>
                </form>
                <div id="ModalCenter{{$image->id}}" class="modal fade text-dark" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">¿En serio?</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <p>¿Seguro que quieres borrar el hotspot {{$image->title}}?</p>
                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                <button iddb="{{$image->id}}" type="button" class="btn btn-danger deleteConfirm" data-dismiss="modal">
                                    Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FINAL modal para borrar -->

                <!-- Boton para modificar -->
                <a href="{{route('hotspot.edit', $image->id)}}">
                    <div class="cornerButton" style="right: 50px">
                        <img class="center" src="{{url("img/icons/edit.svg")}}" alt=""> 
                    </div>
                </a>

            </div>
        </div>
    </div>

    {{-- NEW IMAGE --}}

    <div id="modalImage" class="modal fade text-dark" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="flex: 1 1 1px; max-width: 70%;">
            <div class="modal-content">
                <form id="modal-form" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method">
                    <div class="modal-header border-bottom-0">
                        <h5 id="modal-title" class="modal-title text-primary"></h5>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <!-- Imagen title -->
                    <div class="modal-body">
                        <div class="form-group">
                            <b> <label> Titulo de la imagen </label> <span class="text-danger">*</span> </b>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <!-- Imagen description -->
                        <div class="form-group">
                            <b> <label> Descripcion de la imagen </label> <span class="text-danger">*</span> </b>
                            <input type="text" class="form-control" name="description" required>
                        </div>
                        <!-- Array images -->
                        <div class="form-group" id="imagesUpload">
                            <b> <label> Imagen </label> <span class="text-danger">*</span> </b><br>
                            <input type="file" name="image" class="fileToUpload" required>
                        </div>
                        <!-- Hotspots -->
                        <div class="form-group mb-0">
                            <b> <label> Hotspot al que asociar la imagen </label> <span class="text-danger">*</span> </b>
                            @foreach ($hotspots as $hotspot)
                                <p>
                                    @isset($hotspot)
                                        <input id="radiobutton_hotspot{{$hotspot->id}}" class="radio-text" type="radio" name="hotspot_id" value="{{$hotspot->id}}">
                                        <span class="text-dark radio-text">{{$hotspot->title}}</span>
                                    @endisset
                                </p>
                            @endforeach
                        </div>
                        <!-- Maps -->
                        <div class="form-group mb-0">
                            <b> <label> Mapa que la contienen </label> <span class="text-danger">*</span> </b>
                            @foreach ($maps as $map)
                                <p>
                                    @isset($map)
                                        <input id="radiobutton_map{{$map->id}}" class="radio-text" type="radio" name="map_id" value="{{$map->id}}">
                                        <span class="text-dark radiobutton-text">{{$map->title}} ({{$map->city}} - {{$map->date}})</span>
                                    @endisset
                                </p>
                            @endforeach
                        </div>
                        <!-- Hidden -->
                        <div class="form-group images-fields" id="filePathUpdate">
                            <input type="hidden" name="filePath" value="/img/hotspots/" disabled>
                        </div>
                        <div>
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn-remove" value="" type="button" class="btn btn-danger">Eliminar</button>
                        <button id="btn-submit" type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <a href="#" id="addImage">
        <div id="addButton">
            <img class="center" src="{{url("img/icons/plus.svg")}}">
        </div>
    </a>

@endsection

@section('scripts')
    <script>
        $(function(){
            @isset($images)
                // Images php array conversion to js
                let images = @json($images);
                console.log(images);
            @endisset
            
            $(".col-md-4").on("click", function(e){
                let image;
                for (let i = 0; i < images.length; i++) {
                    if(images[i].id == this.name){
                        image = images[i];
                        image.position = i;       
                    }
                }

                event.preventDefault();
                $('#ekkoLightbox-893').modal('show');
            
                let host = "{{url('')}}";
                $("#previewImage").attr("src", host+"/img/hotspots/"+image.file_name);
            
                $("#anterior").on("click", function(e){
                    console.log("ok");
                    console.log(image.position);
                });
            });

                // Upload a new image
            $("#addImage").on("click", function(){
                // Create form attrubutes
                $("#modal-form").attr("action", "{{route('hotspot.store')}}");
                $("input[name='_method']").val("POST");
                // Clear fields
                $("input[name='title']").val("");
                $("input[name='description']").val("");
                $("input[name='image']").val("");
                $("input[name='hotspot_id']").val("");
                // Modal display
                $("#modal-title").text("Nueva imagen");
                $("#btn-remove").prop("disabled", true);
                $("#btn-remove").css("display", "none");
                $('#modalImage').modal('show');
            });

            
        });
    </script>
    
    {{-- CODIGO BARRA DE BUSQUEDA CON AJAX    --}}
    <script>
        $(document).ready(function(){
            // Cogemos la ruta por si me lo levo a un archivo externo 
            var searchAjax = "{{route('hotspot.search')}}"
            
            $("#searchBar").keyup(function(){
                text = $(this).val();
                
                $.ajax({
                    url: searchAjax,
                    data: {"text":text},
                    success: function(data){
                        var imgsFound = data.imagesFound;

                        var list = $("#allElements");
                        list.children().each(function(e){
                            var imgID = $(this).attr("name");
                            var found = false;
                            
                            imgsFound.forEach( imgFound => {
                                if(imgFound.id == imgID){
                                    found = true;
                                    return;
                                }
                            });

                            if(found)
                                $(this).show();
                            else
                                $(this).hide();
                        });
                    },
                });
            });
        });
    </script>

@endsection