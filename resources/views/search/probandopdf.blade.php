@extends('layouts.master')

@section('title', 'Celia Maps')


@section('header')
@endsection

@section('content')

<div>
    <p>
        esto es una prueba de pdf
    </p>
</div>

<a href="{{route('pdf.download')}}">
    <button type="button" class="btn btn-primary">pdf</button>
    </a>
@endsection