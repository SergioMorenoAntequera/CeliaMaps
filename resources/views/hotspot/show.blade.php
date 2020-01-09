@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se enseña un mapa en particular
@endsection

@section('content')
    <div class="container text-center">
        <p>Id: {{$hotspot->id}}</p>
        <p>Title: {{$hotspot->title}}</p>
        <p>Description: {{$hotspot->description}}</p>
        <p>point_x: {{$hotspot->point_x}}</p>
        <p>point_y: {{$hotspot->point_y}}</p>
    </div>
@endsection

@section('footer')
    footer
@endsection