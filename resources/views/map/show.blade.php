@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se enseña un mapa en particular
@endsection

@section('content')
    <div class="container text-center">
        <h3>Toda la info en plan así a saco</h3>
        <p>Title: {{$map->title}}</p>
        <p>Description: {{$map->description}}</p>
        <p>City: {{$map->city}}</p>
        <p>image: {{$map->image}}</p>
        <p>level: {{$map->level}}</p>
        <p>width: {{$map->width}}</p>
        <p>height: {{$map->height}}</p>
        <p>deviation_x: {{$map->deviation_x}}</p>
        <p>deviation_y: {{$map->deviation_y}}</p>
    </div>
@endsection

@section('footer')
    footer
@endsection