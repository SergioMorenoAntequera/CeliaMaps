@extends('layouts/master')

@section('title', 'Celia Maps')

@section('content')	
    <a href="https://www.github.com/luisdavidfer"></a>
    <div style="display: flex; flex-wrap: wrap;">
        @foreach ($images as $image)    
            <a class="col-md-4" name="{{$image->id}}" style="margin: 15px 0; padding: 0 15px; flex: 0 0 33.333333%; max-width: 450px; position: relative; overflow: hidden; height: 325px" href="#" data-toggle="light-box" data-gallery="gallery">
                <img class="rounded" style="height: 100%" src="{{url('img/hotspots/', $image->file_name)}}">
            </a>
        @endforeach
    </div>

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

            let imageId = this.name;

            $("#anterior").on("click", function(e){
                console.log("ok");
                console.log(image.position);
                // SOCORRO ÁLFRED
            });

        });
    </script>
    
@endsection