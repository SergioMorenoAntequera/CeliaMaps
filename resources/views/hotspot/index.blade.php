@extends('layouts/master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se crean modifican los mapas
@endsection

@section('content')

	<div class="container text-center">
		<a href="{{route('hotspot.create')}}">
			<button>
				Crear nuevo
			</button>
		</a>

		<div class="row allElements justify-content-center">
			@foreach ($hotspotList as $hotspot)
				<div class="oneElement col-8">
					<div class="textElement bg-primary">
						<p><b class="text-white">{{$hotspot->id}} <a href="{{route("hotspot.show", $hotspot->id)}}"> {{$hotspot->title}} </a></b></p>
						<p><b class="text-white">Point X: {{$hotspot->point_x}}   Point Y: {{$hotspot->point_y}}</b></p>
						<p><b class="text-white">{{$hotspot->map_id}}</b></p>
					
						<!-- Boton para modificar -->
                        <a href="{{route('hotspot.edit', $hotspot->id)}}"> 
                            <button class="cornerUpdateButton bg-secondary">
                                <img src="{{url("img/icons/editWhite.png")}}" alt=""> 
                            </button>
                        </a>
                    
                        <!-- Boton para borrar -->
                        <form method="POST" action="{{route('hotspot.destroy', $hotspot->id)}}">
                            @csrf
                            @method("DELETE")

                            <button class="cornerDeleteButton bg-secondary" type="submit" value="Eliminar">
                                <img src="{{url("img/icons/deleteWhite.png")}}" alt="">    
                            </button>
                        </form>
					</div>
				</div>
				
			@endforeach
		</div>
	</div>

@endsection