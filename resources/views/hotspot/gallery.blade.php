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
        <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search">
    </div>

    {{-- IMAGES --}}
    
    <div style="display: flex; flex-wrap: wrap;">
        @foreach ($images as $image)    
            <a class="col-md-4" name="{{$image->id}}" style="margin: 15px 0; padding: 0 15px; flex: 0 0 33.333333%; max-width: 455px; position: relative; overflow: hidden; height: 325px" href="#" data-toggle="light-box" data-gallery="gallery">
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

    {{-- ADD IMAGES BUTTON --}}
    
    <a href="{{route('hotspot.gallery')}}">
        <div id="addButton">
            <img class="center" src="{{url("img/icons/plus.svg")}}">
        </div>
    </a>

@endsection

@section('scripts')
    <script>
        $(".col-md-4").on("click", function(event) {
            event.preventDefault();
            $('#ekkoLightbox-893').modal('show');

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
            

            let host = "{{url('')}}";
            $("#previewImage").attr("src", host+"/img/hotspots/"+image.file_name);


        });

        $("#anterior").on("click", function(e){
            console.log("ok");
            console.log(image.position);
        });
    </script>
    
@endsection