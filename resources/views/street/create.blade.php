@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    <!--  Header html  -->
@endsection

@section('content')
    <br>
    <div class="container w-50 text-center">
        <div class="card">
            <div class="card-header">
                Añadir calle
            </div>

            <div class="card-body">
                <form method="POST" action="{{route('street.store')}}" enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                    <div class="form-group">
                        <label>Tipo de vía</label>
                        <select name="type_id" class="form-control">
                            @foreach ($streetsTypes as $streetType)
                                <option value="{{$streetType->id}}">({{$streetType->abbreviation}}) {{$streetType->type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nombre de la vía</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Añadir</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <!--  Footer html  -->
@endsection