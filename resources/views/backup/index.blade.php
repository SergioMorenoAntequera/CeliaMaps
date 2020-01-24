@extends('layouts/master')


@section('header')
@endsection 

@section('content')
<div class="row">

    <form action= "{{route('backup.create')}}" method= "GET">
        @csrf
        @method("GET|HEAD")
        <input type="submit" value="backup database">
    </form>

    <form action= "{{route('backup.restore')}}" method= "GET">
        @csrf
        @method("GET|HEAD")
        <input type="submit" value="restore database">
    </form>
</div>
@endsection

@section('footer')
@endsection