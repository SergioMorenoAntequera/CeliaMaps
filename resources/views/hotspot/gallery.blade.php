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
                <img class="rounded" style="height: 100%" src="{{url('img/hotspots/', $image->file_name)}}">  
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

            </div>
        </div>
    </div>

    {{-- NEW IMAGE --}}

    <div id="modalDropzone" class="modal fade text-dark" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="flex: 1 1 1px; max-width: 70%;">
            <div class="modal-content">

                <div class="modal-body">
                    
                    {{-- Dropzone --}}
                    <div class="dropzoneContainer col100" id="dzone">
                        <form action="{{ url('') }}" method="post" enctype="multipart/form-data" class='dropzone' style="margin-bottom: 0px" >
                            
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- EDIT AN IMAGE --}}
    
    

    {{-- ADD IMAGES BUTTON --}}
    
    <a href="#" id="newImage">
        <div id="addButton">
            <img class="center" src="{{url("img/icons/plus.svg")}}">
        </div>
    </a>

@endsection

@section('scripts')
    <script>

        $(".col-md-4").on("click", function(event) {
            @isset($images)
                // Images php array conversion to js
                let images = @json($images);
                console.log(images);
            @endisset

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


        $("#newImage").on("click", function(e){
            $('#modalDropzone').modal('show');
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