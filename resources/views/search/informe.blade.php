@extends('layouts.master')

@section('title', 'Celia Maps')
<title> Celia Maps</title>

@section('header')
@endsection

@section('content')

<div id="container">
    <div class="card float-left">
    <div id="informe" class="bg-primary">
        <div id="tituloCalle" class="row">
            calle
        </div>
        <div id="nombreCalle" class="row">

        </div>
        <div id="perteneceAMapas">
            <div id="nombreMapa">

            </div>
           
        </div>

    </div>
</div>
</div>
    <a href="{{action('SearchController@download')}}">
        <button type="button" class="btn btn-primary">pdf</button>
    </a>
    

@endsection

