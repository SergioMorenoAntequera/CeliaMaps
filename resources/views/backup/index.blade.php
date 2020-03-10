@extends('layouts/master')

@section('header')
@endsection 

@section('content')
<div class="container">
    <div class="row">
        <div class=" col-12 col-md-5">
            <div id="createCopy" class="backupBox">
                <img src="{{url('img/icons/database.svg')}}">
            </div>
        </div>
        <div class="offset-1 offset-md-1"></div>
        <div class="col-12 col-md-5">
            <div id="restoreCopy" class="backupBox">
                asd 
             </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection

{{-- <form action= "{{route('backup.create')}}" method= "GET">
                @csrf
                @method("GET|HEAD")
                <input type="submit" value="backup database">
            </form>
        
            <form action= "{{route('backup.restore')}}" method= "GET">
                @csrf
                @method("GET|HEAD")
                <input type="submit" value="restore database">
            </form> --}}