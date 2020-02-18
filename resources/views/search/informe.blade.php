@extends('layouts.master')

@section('title', 'Celia Maps')
<title> Celia Maps</title>

@section('header')
@endsection

@section('content')

<div id="container">
    <div>
        <a href="{{action('SearchController@download')}}">
            <button type="button" class="btn btn-primary">pdf</button>
        </a>
    </div>

@endsection

