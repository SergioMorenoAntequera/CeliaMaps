@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se enseña un mapa en particular
@endsection

@section('content')
<div class="container w-50 text-center text-dark">
    <div class="card">
        <div class="card-header">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{$street->type->type}} {{$street->name}}</h5>
                </div>
                <h6>Mapas</h6>
                <ul class="list-group list-group-flush">
                    @if (!is_null($street->maps()))
                        @foreach ($street->maps as $map)
                            <li class="list-group-item">{{$map->title}} - {{$map->date}}</li>
                        @endforeach
                    @endif
                </ul>
              </div>
        </div>
@endsection

@section('footer')
    footer
@endsection