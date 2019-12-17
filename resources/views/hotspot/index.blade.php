@extends('layouts/master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se crean modifican los mapas
@endsection

@section('content')

<div id="table">
	<table style="width:60%">
		<tr>
			<th>Id</th>
			<th>Título</th>
			<th>Descripción</th>
			<th>Punto X</th>
			<th>Punto Y</th>
		</tr>
		@foreach ($hotspotList as $hotspot)
			<tr>
				<td>
					<span>{{$hotspot->id}}</span>
				</td>
				<td>
					<span>{{$hotspot->title}}</span>
				</td>
				<td>
					<span>{{$hotspot->description}}</span>
				</td>
				<td>
					<span>{{$hotspot->point_x}}</span>
				</td>
				<td>
					<span>{{$hotspot->point_y}}</span>
				</td>
				<td>
					<small>  
						<form style="display:contents" action = "{{route('hotspot.destroy', $hotspot->id)}}" method="POST">
							@csrf
							@method("DELETE")
								<button title="Delete" class="red" type="submit">Eliminar</button>
						</form>
						<form style="display:contents" action = "{{route('hotspot.edit', $hotspot->id)}}" method="GET">
							@csrf
							<button title="Edit" class="green" type="submit">Editar</button>
						</form>
					</small>
				</td>
			</tr>
		@endforeach
	</table>
</div>
@endsection