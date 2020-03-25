@extends('layouts/master')

@section('title', 'Celia Maps')

@section('content')	

    <div class="row" style="margin: 15px; display: flex; flex-wrap: wrap;">
        <a class="col-md-4" style="flex: 0 0 33.333333%; max-width: 33.333333%;" href="{{url('img/hotspots/alcazaba-almeria-img-01.jpg')}}" data-toggle="light-box" data-gallery="gallery">
            <img class="img-fluid rounded" src="{{url('img/hotspots/alcazaba-almeria-img-01.jpg')}}">
        </a>
        <a class="col-md-4" style="flex: 0 0 33.333333%; max-width: 33.333333%;" href="{{url('img/hotspots/alcazaba-almeria-img-01.jpg')}}" data-toggle="light-box" data-gallery="gallery">
            <img class="img-fluid rounded" src="{{url('img/hotspots/alcazaba-almeria-img-01.jpg')}}">
        </a>
        <a class="col-md-4" style="flex: 0 0 33.333333%; max-width: 33.333333%;" href="{{url('img/hotspots/alcazaba-almeria-img-01.jpg')}}" data-toggle="light-box" data-gallery="gallery">
            <img class="img-fluid rounded" src="{{url('img/hotspots/alcazaba-almeria-img-01.jpg')}}">
        </a>
    </div>
    <div class="row" style="margin: 15px; display: flex; flex-wrap: wrap;">
        <a class="col-md-4" style="flex: 0 0 33.333333%; max-width: 33.333333%;" href="{{url('img/hotspots/alcazaba-almeria-img-01.jpg')}}" data-toggle="light-box" data-gallery="gallery">
            <img class="img-fluid rounded" src="{{url('img/hotspots/alcazaba-almeria-img-01.jpg')}}">
        </a>
        <a class="col-md-4" style="flex: 0 0 33.333333%; max-width: 33.333333%;" href="{{url('img/hotspots/alcazaba-almeria-img-01.jpg')}}" data-toggle="light-box" data-gallery="gallery">
            <img class="img-fluid rounded" src="{{url('img/hotspots/alcazaba-almeria-img-01.jpg')}}">
        </a>
        <a class="col-md-4" style="flex: 0 0 33.333333%; max-width: 33.333333%;" href="{{url('img/hotspots/alcazaba-almeria-img-01.jpg')}}" data-toggle="light-box" data-gallery="gallery">
            <img class="img-fluid rounded" src="{{url('img/hotspots/alcazaba-almeria-img-01.jpg')}}">
        </a>
    </div>

    <div id="ekkoLightbox-893" class="ekko-lightbox modal fade text-dark" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="confirm-modal-title" class="modal-title">Eliminar hotspot</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar el hotspot?</p>
                    <button id="btn-confirm" type="button" class="btn btn-danger float-right deleteConfirm" data-dismiss="modal">Eliminar</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        $(document).on("click", '[data-toggle="light-box"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
    
@endsectionhref=""