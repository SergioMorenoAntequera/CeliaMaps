@extends('layouts/master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se crean modifican los mapas
@endsection

@section('content')	

	<!-- One div to get all the hotspots -->
    <div class="container text-center">
        <!-- Todos los elementos de la página -->
        <div id="allElements">
            @foreach ($hotspots as $hotspot)
                <!-- Cada uno de los elementos de la página -->
                <div class="wholePanel" style="height: 186px;">

                    <!-- Columna con el numero y las flechas -->
                    
					@php
						$images = $hotspot->images()->get();
						$filesnasmes = null;
						for($i = 0; $i < count($images); $i++){
							$filesnasmes[] = $images[$i]->file_name;
						}
					@endphp
					<div class="leftPanel" style="width:25%; position: relative; overflow: hidden">
						<img src="{{url('img/hotspots/', $filesnasmes[0])}}" style="height: 100%">
                    </div>

                    <!-- Columna con la información del hotspot -->
                    <div class="rightPanel" style="width:75%; position: relative;">
                        <!-- Titulo -->
						<p><b class="text-6">{{$hotspot->title}}</b></p>

                        <!-- Algunos detalles -->
                        <p class="descriptionOverflow">{{$hotspot->description}}</p>

                        <!-- Boton para Borrar  -->
                        <form method="POST" action="{{route('hotspot.deleteAjax', $hotspot->id)}}">
                            @csrf
                            @method("DELETE")

                            <div data-toggle="modal" data-target="#ModalCenter{{$hotspot->id}}" class="deleteCornerButton cornerButton">
                                <img class="center" src="{{url("img/icons/delete.svg")}}" alt=""> 
                            </div>
                        </form>
                        <div id="ModalCenter{{$hotspot->id}}" class="modal fade text-dark" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">¿En serio?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <p>¿Seguro que quieres borrar el hotspot {{$hotspot->title}}?</p>
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                        <button iddb="{{$hotspot->id}}" type="button" class="btn btn-danger deleteConfirm" data-dismiss="modal">
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FINAL modal para borrar -->

                        <!-- Boton para modificar -->
                        <a href="{{route('hotspot.edit', $hotspot->id)}}">
                            <div class="cornerButton" style="right: 50px">
                                <img class="center" src="{{url("img/icons/edit.svg")}}" alt=""> 
                            </div>
                        </a>
                    </div>
                </div> 
            @endforeach
        </div> 
    </div>

    <a href="{{route('hotspot.create')}}">
    <div id="addButton">
        <img class="center" src="{{url("img/icons/plus.svg")}}">
    </div>
    </a>
@endsection

@section('scripts')
    <!------------------------------------ FUNCTIONS WITH AJAX ---------------------------------->
    <!--------------------------------- DELETE, MOVE UP AND DOWN -------------------------------->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script> var token = '{{csrf_token()}}'</script>
    <script type="text/javascript" src="{{url('/js/deleteAjax.js')}}">
    </script>
    
@endsection