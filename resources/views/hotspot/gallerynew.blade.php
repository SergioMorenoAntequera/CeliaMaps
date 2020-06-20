@extends('layouts/master')

@section('title', 'Celia Maps')

@section('cdn')
    {{-- <link rel="stylesheet" href="{{url('js/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{url('js/dropzone/basic.min.css')}}"> --}}
@endsection

@section('content')	
    <div class="container text-center mt-2">
        
        {{-- <form action="{{route('gallery.uploadImg')}}"
            class="dropzone"
            id="drop-area">
        </form> --}}
        <div class="wholePanel mb-5" style="">
            
            <div class="leftPanel" id="hpList"  style="">
                <div class="content text-left px-5" style="font-size: 18px; font-weight: normal">
                    <p style="font-size: 30px"><b> Galería de imágenes </b></p>
                    <p class="hotspotInList selected"> Todos </p>
                    <div id="hpList">
                        @foreach ($hotspots as $hp)
                            <p class="hotspotInList"> {{$hp->title}} </p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="rightPanel">
                {{-- SEARCH BAR --}}
                <div id="search-container" class="input-group md-form form-sm form-1 pl-0">
                    <div id="search-img" class="input-group-prepend">
                        <span class="input-group-text purple lighten-3" id="basic-text1">
                            <img class="imgSearch" src="{{url('img/icons/lupa-blanca.png')}}">
                        </span>
                    </div>
                    <input id="searchBar" class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search">
                </div>
                {{-- TEMPLATE --}}
                <div style="display: none" id="grid-element-template" class="grid-element"  data-id="">
                    <img src="" alt="">
                    <div class="overlay">
                        <svg class="img-show"
                             data-toggle="modal" data-target="#showModal" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999;" xml:space="preserve">
                            <g>
                            <g>
                            <path d="M508.745,246.041c-4.574-6.257-113.557-153.206-252.748-153.206S7.818,239.784,3.249,246.035
                            c-4.332,5.936-4.332,13.987,0,19.923c4.569,6.257,113.557,153.206,252.748,153.206s248.174-146.95,252.748-153.201
                            C513.083,260.028,513.083,251.971,508.745,246.041z M255.997,385.406c-102.529,0-191.33-97.533-217.617-129.418
                            c26.253-31.913,114.868-129.395,217.617-129.395c102.524,0,191.319,97.516,217.617,129.418
                            C447.361,287.923,358.746,385.406,255.997,385.406z"/>
                            </g>
                            </g>
                            <g>
                            <g>
                            <path d="M255.997,154.725c-55.842,0-101.275,45.433-101.275,101.275s45.433,101.275,101.275,101.275
                            s101.275-45.433,101.275-101.275S311.839,154.725,255.997,154.725z M255.997,323.516c-37.23,0-67.516-30.287-67.516-67.516
                            s30.287-67.516,67.516-67.516s67.516,30.287,67.516,67.516S293.227,323.516,255.997,323.516z"/>
                            </g>
                            </g>
                        </svg> 
                        <svg class="img-edit" 
                            data-toggle="modal" data-target="#showModal" id="Capa_1" enable-background="new 0 0  512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><path d="m384.721 0-323.626 323.627-61.095 188.373 188.374-61.094 323.626-323.627zm84.853 127.279-42.427 42.427-84.853-84.853 42.426-42.427zm-388.611 232.331 71.427 71.428-32.036 10.39-49.782-49.782zm14.501-27.925 225.617-225.618 31.82 31.82-225.618 225.617zm53.032 53.032 225.618-225.619 31.82 31.82-225.618 225.619zm-88.313 38.965 28.136 28.136-41.642 13.505z"/></g>
                        </svg>
                        <svg class="img-delete"
                            data-toggle="modal" data-target="#deleteModal" viewBox="-47 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m416.875 114.441406-11.304688-33.886718c-4.304687-12.90625-16.339843-21.578126-29.941406-21.578126h-95.011718v-30.933593c0-15.460938-12.570313-28.042969-28.027344-28.042969h-87.007813c-15.453125 0-28.027343 12.582031-28.027343 28.042969v30.933593h-95.007813c-13.605469 0-25.640625 8.671876-29.945313 21.578126l-11.304687 33.886718c-2.574219 7.714844-1.2695312 16.257813 3.484375 22.855469 4.753906 6.597656 12.445312 10.539063 20.578125 10.539063h11.816406l26.007813 321.605468c1.933594 23.863282 22.183594 42.558594 46.109375 42.558594h204.863281c23.921875 0 44.175781-18.695312 46.105469-42.5625l26.007812-321.601562h6.542969c8.132812 0 15.824219-3.941407 20.578125-10.535157 4.753906-6.597656 6.058594-15.144531 3.484375-22.859375zm-249.320312-84.441406h83.0625v28.976562h-83.0625zm162.804687 437.019531c-.679687 8.402344-7.796875 14.980469-16.203125 14.980469h-204.863281c-8.40625 0-15.523438-6.578125-16.203125-14.980469l-25.816406-319.183593h288.898437zm-298.566406-349.183593 9.269531-27.789063c.210938-.640625.808594-1.070313 1.484375-1.070313h333.082031c.675782 0 1.269532.429688 1.484375 1.070313l9.269531 27.789063zm0 0"/><path d="m282.515625 465.957031c.265625.015625.527344.019531.792969.019531 7.925781 0 14.550781-6.210937 14.964844-14.21875l14.085937-270.398437c.429687-8.273437-5.929687-15.332031-14.199219-15.761719-8.292968-.441406-15.328125 5.925782-15.761718 14.199219l-14.082032 270.398437c-.429687 8.273438 5.925782 15.332032 14.199219 15.761719zm0 0"/><path d="m120.566406 451.792969c.4375 7.996093 7.054688 14.183593 14.964844 14.183593.273438 0 .554688-.007812.832031-.023437 8.269531-.449219 14.609375-7.519531 14.160157-15.792969l-14.753907-270.398437c-.449219-8.273438-7.519531-14.613281-15.792969-14.160157-8.269531.449219-14.609374 7.519532-14.160156 15.792969zm0 0"/><path d="m209.253906 465.976562c8.285156 0 15-6.714843 15-15v-270.398437c0-8.285156-6.714844-15-15-15s-15 6.714844-15 15v270.398437c0 8.285157 6.714844 15 15 15zm0 0"/>
                        </svg>
                    </div>
                    <p class="hp-title">  </p>
                </div>
                {{-- Grid de imágenes --}}
                {{-- La id // imagen // titulo --}}
                <div id="images-grid">
                    @foreach ($images as $image)
                        <div class="grid-element" data-id="{{$image->id}}">
                            <img src="{{url($image->file_path."/".$image->file_name)}}" alt="{{$image->title}}">
                            <div class="overlay">
                                <svg class="img-show" data-toggle="modal" data-target="#showModal"  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999;" xml:space="preserve">
                                    <g>
                                    <g>
                                    <path d="M508.745,246.041c-4.574-6.257-113.557-153.206-252.748-153.206S7.818,239.784,3.249,246.035
                                    c-4.332,5.936-4.332,13.987,0,19.923c4.569,6.257,113.557,153.206,252.748,153.206s248.174-146.95,252.748-153.201
                                    C513.083,260.028,513.083,251.971,508.745,246.041z M255.997,385.406c-102.529,0-191.33-97.533-217.617-129.418
                                    c26.253-31.913,114.868-129.395,217.617-129.395c102.524,0,191.319,97.516,217.617,129.418
                                    C447.361,287.923,358.746,385.406,255.997,385.406z"/>
                                    </g>
                                    </g>
                                    <g>
                                    <g>
                                    <path d="M255.997,154.725c-55.842,0-101.275,45.433-101.275,101.275s45.433,101.275,101.275,101.275
                                    s101.275-45.433,101.275-101.275S311.839,154.725,255.997,154.725z M255.997,323.516c-37.23,0-67.516-30.287-67.516-67.516
                                    s30.287-67.516,67.516-67.516s67.516,30.287,67.516,67.516S293.227,323.516,255.997,323.516z"/>
                                    </g>
                                    </g></svg> 
                                <svg class="img-edit" data-toggle="modal" data-target="#showModal" id="Capa_1" 
                                    enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><path d="m384.721 0-323.626 323.627-61.095 188.373 188.374-61.094 323.626-323.627zm84.853 127.279-42.427 42.427-84.853-84.853 42.426-42.427zm-388.611 232.331 71.427 71.428-32.036 10.39-49.782-49.782zm14.501-27.925 225.617-225.618 31.82 31.82-225.618 225.617zm53.032 53.032 225.618-225.619 31.82 31.82-225.618 225.619zm-88.313 38.965 28.136 28.136-41.642 13.505z"/></g></svg>
                                <svg class="img-delete" data-toggle="modal" data-target="#deleteModal" viewBox="-47 0 512 512" 
                                    xmlns="http://www.w3.org/2000/svg"><path d="m416.875 114.441406-11.304688-33.886718c-4.304687-12.90625-16.339843-21.578126-29.941406-21.578126h-95.011718v-30.933593c0-15.460938-12.570313-28.042969-28.027344-28.042969h-87.007813c-15.453125 0-28.027343 12.582031-28.027343 28.042969v30.933593h-95.007813c-13.605469 0-25.640625 8.671876-29.945313 21.578126l-11.304687 33.886718c-2.574219 7.714844-1.2695312 16.257813 3.484375 22.855469 4.753906 6.597656 12.445312 10.539063 20.578125 10.539063h11.816406l26.007813 321.605468c1.933594 23.863282 22.183594 42.558594 46.109375 42.558594h204.863281c23.921875 0 44.175781-18.695312 46.105469-42.5625l26.007812-321.601562h6.542969c8.132812 0 15.824219-3.941407 20.578125-10.535157 4.753906-6.597656 6.058594-15.144531 3.484375-22.859375zm-249.320312-84.441406h83.0625v28.976562h-83.0625zm162.804687 437.019531c-.679687 8.402344-7.796875 14.980469-16.203125 14.980469h-204.863281c-8.40625 0-15.523438-6.578125-16.203125-14.980469l-25.816406-319.183593h288.898437zm-298.566406-349.183593 9.269531-27.789063c.210938-.640625.808594-1.070313 1.484375-1.070313h333.082031c.675782 0 1.269532.429688 1.484375 1.070313l9.269531 27.789063zm0 0"/><path d="m282.515625 465.957031c.265625.015625.527344.019531.792969.019531 7.925781 0 14.550781-6.210937 14.964844-14.21875l14.085937-270.398437c.429687-8.273437-5.929687-15.332031-14.199219-15.761719-8.292968-.441406-15.328125 5.925782-15.761718 14.199219l-14.082032 270.398437c-.429687 8.273438 5.925782 15.332032 14.199219 15.761719zm0 0"/><path d="m120.566406 451.792969c.4375 7.996093 7.054688 14.183593 14.964844 14.183593.273438 0 .554688-.007812.832031-.023437 8.269531-.449219 14.609375-7.519531 14.160157-15.792969l-14.753907-270.398437c-.449219-8.273438-7.519531-14.613281-15.792969-14.160157-8.269531.449219-14.609374 7.519532-14.160156 15.792969zm0 0"/><path d="m209.253906 465.976562c8.285156 0 15-6.714843 15-15v-270.398437c0-8.285156-6.714844-15-15-15s-15 6.714844-15 15v270.398437c0 8.285157 6.714844 15 15 15zm0 0"/></svg>
                            </div>
                            <p class="hp-title"> {{$image->title}} </p>
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>

        {{-- MODALES ************************************************************************ --}}  
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Eliminar Imagen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body text-left">
                    ¿Está seguro de que desea eliminar la imagen  
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-success float-left" data-dismiss="modal"> Cancelar </button>
                <button id="deleteConfirm" type="button" class="btn btn-danger"> Eliminar </button>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-body text-left">
                    <div class="left-img">
                        <img src="" alt="Imagen seleccionada">
                    </div>
                    <div class="right-info">
                        <h2 class="title"> Titulo de la imagen </h2>
                        <div class="title-form form-group d-none">
                            <h3>Título</h3>
                            <input type="text" class="form-control" id="titulo" name="imgTitle" placeholder="">
                        </div>
                        <br>

                        <h3>Descripción</h3>
                        <p class="description"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Id eum, possimus odio aut rerum minus earum fuga nisi, ipsam nemo maxime quam enim velit rem aspernatur eveniet veritatis libero ullam.</p>
                        <div class="description-form form-group d-none">
                            <input type="text" class="form-control" name="imgDescription" placeholder="Introduce una descripción para la imagen">
                        </div>
                        <br>

                        <h3> Hotspot asociado </h3>
                        <p class="hotspot"> Mi casa </p>
                        <div class="hotspots-form form-group d-none">
                            <select class="form-control" name="hotspot">
                                @foreach ($hotspots as $hp)
                                    <option> {{$hp->title}} </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="button" class="submit-edit btn btn-success d-none">
                            Confirmar
                        </button>
                    </div>
                </div>

                <div  class="cornerButton" style="right:-1em" data-dismiss="modal">
                    <i  class="fa fa-times fa-lg" aria-hidden="true"></i>
                </div>
                <div class="cornerButton cornerSwap cornerEdit" style="right:2em">
                    <img src="{{url('img/icons/edit.svg')}}" alt="as">
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-body text-left">

                    <form method="post" action="{{route('gallery.uploadImg')}}" enctype="multipart/form-data" id="addForm">
                        @csrf

                        <h3>Titulo</h3>
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="Titulo de la imagen">
                        </div>
                        <br>

                        <h3>Descipción</h3>
                        <div class="form-group">
                            <input type="text" class="form-control" name="description" placeholder="Descipción">
                        </div>
                        <br>

                        <h3> Hotspot asociado </h3>
                        <div class="hotspots-form form-group">
                            <select class="form-control" name="hotspot_id">
                                @foreach ($hotspots as $hp)
                                    <option value="{{$hp->id}}"> {{$hp->title}} </option>
                                @endforeach
                            </select>
                        </div>

                        <h3> Archivo </h3>
                        <div class="hotspots-form form-group">
                            <input type="file" name="img">
                        </div>

                        <input type="submit" class="submit-add btn btn-success" value="Confirmar">
                        
                    </form>
                </div>

                <div  class="cornerButton" style="right:-1em" data-dismiss="modal">
                    <i  class="fa fa-times fa-lg" aria-hidden="true"></i>
                </div>
            </div>
            </div>
        </div>
    </div>


    {{-- <a href="#" id="addImage"> --}}
    <div id="addButton" data-toggle="modal" data-target="#addModal">
        <img class="center" src="{{url("img/icons/plus.svg")}}">
    </div>
    {{-- </a> --}}
@endsection

@section('scripts')

    {{-- <script src="{{'js/dropzone/dropzone.min.js'}}"></script> --}}
    {{-- <script src="{{'js/dropzone/dropzone-amd-module.min.js'}}"></script> --}}
    {{-- <script>
        $("#drop-area").dropzone({
            url: "/profile/update-photo",
            addRemoveLinks : true,
            maxFilesize: 5,
            dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
            dictResponseError: 'Error uploading file!',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            }
        });
    </script> --}}

    <script>
        $(function(){
            @isset($images)
                // Images php array conversion to js
                var images = @json($images);
            @endisset
            @isset($hotspots)
                // Images php array conversion to js
                let hotspots = @json($hotspots);
            @endisset

            // SEE IMAGE
            $(".img-show").on("click", function(){
                // The modal appear by bootstrap magic, here we only update texts and images
                updateModalInfo($(this).parents(".grid-element").data("id"));
                showInfo();
            });

            // MODIFY IMAGE INFO
            $(".img-edit").on("click", function(){
                // The modal appear by bootstrap magic, here we only update texts and images
                if(!$(this).hasClass("editImage")) 
                    updateModalInfo($(this).parents(".grid-element").data("id"));
                showEdit()
            });

            $(".cornerSwap").on("click", function(){
                if($(this).hasClass("cornerEdit")){
                    $(this).removeClass("cornerEdit").addClass("cornerShow");
                    $(".cornerSwap").removeClass("cornerEdit").addClass("cornerShow");
                    showEdit();

                } else {
                    $(this).removeClass("cornerShow").addClass("cornerEdit");
                    $(".cornerSwap").removeClass("cornerShow").addClass("cornerEdit");
                    showInfo();
                }
            });

            let imgSelectedID
            let imgSelected;

            function updateModalInfo(id) {
                imgSelectedID = id;
                images.forEach(image => {
                    if(image.id == imgSelectedID){
                        imgSelected = image;
                        return false;
                    }
                });

                $("#showModal .right-info .title").text(imgSelected.title);
                $("#showModal .right-info .title-form input").val(imgSelected.title);


                if(imgSelected.description == "" || imgSelected.description == null){
                    $("#showModal .right-info .description").addClass("text-danger").text("Esta imagen no cuenta con una descripción");
                    $("#showModal .right-info .description-form input").val(imgSelected.description);
                    $("#showModal .right-info .description-form input").attr("placeholder", "Introduce una descripción para la imagen");
                } else {
                    $("#showModal .right-info .description").removeClass("text-danger").text(imgSelected.description);
                    $("#showModal .right-info .description-form input").attr("value", imgSelected.description);
                }
                $("#showModal .left-img img").attr("src", "{{url('')}}/" + imgSelected.file_path + "/" + imgSelected.file_name);


                hotspots.forEach(hp => {
                    if(hp.id == imgSelected.hotspot_id){
                        $("#showModal .right-info .hotspot").text(hp.title);
                        $("#showModal .right-info .hotspots-form option").each(function(){
                            if($(this).text().trim() == hp.title) {
                                $(this).attr("selected", true);
                                return false;
                            }
                        });
                        return false;
                    }
                });

                
            }
            function showInfo() {
                $("#showModal .title").removeClass("d-none");
                $("#showModal .description").removeClass("d-none");
                $("#showModal .hotspot").removeClass("d-none");
                $("#showModal .cornerButton img").attr(
                    "src", $("#showModal .cornerButton img").attr("src").replace("eye.svg", "edit.svg"));

                $("#showModal .title-form").addClass("d-none");
                $("#showModal .description-form").addClass("d-none");
                $("#showModal .hotspots-form").addClass("d-none");
                $("#showModal .submit-edit").addClass("d-none");
            }
            function showEdit() {
                $("#showModal .title").addClass("d-none");
                $("#showModal .description").addClass("d-none");
                $("#showModal .hotspot").addClass("d-none");
                $("#showModal .cornerButton img").attr(
                    "src", $("#showModal .cornerButton img").attr("src").replace("edit.svg", "eye.svg"));

                $("#showModal .title-form").removeClass("d-none");
                $("#showModal .description-form").removeClass("d-none");
                $("#showModal .hotspots-form").removeClass("d-none");
                $("#showModal .submit-edit").removeClass("d-none");
            }

            //ADD IMG
            $("#addForm").on("submit", function(e){
                e.preventDefault();

                $.ajax({
                    url: "{{route('gallery.uploadImg')}}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(newImg){
                        // Codigo por ajax pero no tienen los listeners
                        // images.push(newImg);
                        // $("#addModal .cornerButton").click();
                        // let element = $("#grid-element-template").clone();
                        // // La id la imagen y el titulo
                        // element.removeAttr("id");
                        // element.data("id", newImg.id);
                        // element.find("img").attr("src", newImg.file_path + "/" + newImg.file_name);
                        // element.find(".hp-title").text(newImg.title);
                        // element.css("display", "block");
                        // $("#images-grid").append(element);

                        window.location.href = window.location.href;
                    },
                    error: function (request, status, error) {
                        if(request.status != 200){
                            alert("Por favor, introduzca todos los campos");
                        }
                    },
                });
            })

            // EDIT IMG 
            $(".submit-edit").on("click", function(){
                //Prepare data
                let data = {
                    "id": imgSelectedID,
                    "title" : $(".form-control[name=imgTitle]").val().trim(),
                    "description" : $(".form-control[name=imgDescription]").val().trim(),
                    "hpTitle" : $(".form-control[name=hotspot]").val().trim(),
                }
                //Ajax
                $.ajax({
                    url: "{{route('gallery.updateAjax')}}",
                    data: data,
                    success: function(data){
                        alert("Imagen actualizada con exito");
                        for (let i = 0; i < images.length; i++) {
                            if(images[i].id == data.id){
                                images[i] = data;
                                updateModalInfo(images[i].id);
                                break;
                            }
                        }
                        $(".grid-element").each(function(){
                            if($(this).data("id") == data.id){
                                $(this).children(".hp-title").text(data.title);
                            }
                        })
                    }
                })
            })

            let imgIDToDelete;
            // DELETE IMAGE
            $(".img-delete").on("click", function() {
                // The modal appear by bootstrap magic, here we only update the text and the id to delete
                let imgNameToDelete = $(this).parents(".grid-element").children("p").text();
                imgIDToDelete = $(this).parents(".grid-element").data("id");
                $("#deleteModal .modal-content .modal-body").text("¿Está seguro de que desea eliminar la imagen" + imgNameToDelete + "?");
                $("#deleteModal .modal-content .modal-body").data("id", imgIDToDelete);
            });
            $("#deleteConfirm").on("click", function(){
                // Petición Ajax para borrar
                $.ajax({
                    url: "{{route('gallery.destroyAjax')}}",
                    data: {"id":imgIDToDelete}

                }).done(function(e) {
                    // Cerrar Modal
                    $('.close').click();

                    // Remove the image
                    $(".grid-element").each(function(){
                        if($(this).data("id") == imgIDToDelete) {
                            $(this).fadeOut(300, function(){
                                $(this).remove();
                            });
                            
                        }
                    });
                });
                
                

            });


            // LEFT BAR FILTER
            let elementTemplate = $("#grid-element-template").clone(true);
            $(".hotspotInList").on("click", function(){
                $("#hpList .selected").removeClass("selected");
                $(this).addClass("selected");
                // $("#inherateInput").val($(this).text().trim());

                // if($(this).text().trim() != "Todos"){
                //     $(".editStreetsInMap").fadeIn(200);
                // } else {
                //     $(".editStreetsInMap").fadeOut(200);
                // }

                // Petición ajax para recuperar las calles de los mapas
                $.ajax({
                    type: 'GET',
                    url: "{{route('gallery.gioh')}}",
                    data: {hotspot : $(this).text()},

                    success: function(data) {
                        // Change edit map button
                        // let editMapUrl = window.location.href.replace("street", "map/"+ data.id +"/edit");
                        // $(".linkToEditMap").attr("href", editMapUrl);

                        $("#images-grid").empty();
                        if(data.length == 0){
                            $("#images-grid").append("<p class='text-danger'> No se han encontrado imagenes para este hotspot </p>");
                            return;
                        }
                        
                        data.forEach(image => {
                            let newElement = elementTemplate.clone(true);
                            // Quitar ID, quitar display None, poner id, path, file y titulo imagen
                            newElement.removeAttr("id");
                            newElement.css("display", "block");
                            newElement.data("id", image.id);
                            newElement.children("img").attr("src", "{{url('')}}/" + image.file_path + "/" + image.file_name);
                            newElement.children("p").text(" " + image.title);

                            $("#images-grid").append(newElement);
                        });
                    },
                });
            });

            // Edit an image
            $("#editImage").on("click", function(){
                // Edit form attributes
                $("#modal-form").attr("action", "{{route('image.store')}}/"+image.id);
                $("input[name='_method']").val("PUT");
                // Fill inputs fields
                $("input[name='title']").val(image.title);
                $("input[name='description']").val(image.description);
                

                // Fill hidden values
                $(".modal-body #id").val(image.id);
                $("#modal-title").text("Editar hotspot");
                // Show and enable buttons and also fill value with hotspot id
                $("#btn-remove").prop("disabled", false);
                $("#btn-remove").prop("value", image.id);
                $("#btn-remove").css("display", "initial");
                // Modal display
                $('#modalImage').modal('show');

                // Delete image button
                $("#btn-remove").on("click", function(){
                    $("#modal-form").attr("action", "{{route('image.store')}}/"+this.value);
                    $("input[name='_method']").val("DELETE");
                    $('#modal').modal('hide');
                    $('#confirmModal').modal('show');
                    $("#btn-confirm").click(function(){
                        $("#modal-form").submit();
                    });
                    $("#btn-cancel").click(function(){
                        $('#confirmModal').modal('hide');
                    });
                });
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

                        
                        var list = $("#images-grid");
                        list.children().each(function(e){
                            // console.log($(this));
                            var imgID = $(this).data("id");
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