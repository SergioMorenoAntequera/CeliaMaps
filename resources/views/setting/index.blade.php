@extends('layouts.master')

@section('title', 'Celia Maps')

@section('cdn')
@endsection

@section('content')
    <div class="container mt-5">
        <div class="wholePanel">
            <div class="leftPanel">
                <div class="content">
                    <h1> Menú de Ajustes </h1>
                </div>
            </div>
            <div class="rightPanel">
                <div class="row text-center text-white">
                    {{-- Vista principal  --}}
                    <div class="col-6 p-1">
                        <a href="{{route('setting.home')}}" class="text-decoration-none">
                        <div class="backupBox p-1 h-100">
                            <h1> General </h1>
                            <ul class="list-unstyled mx-2">
                                <li>Datos pantalla home</li>
                                <li>Titulo, descripción y keywords</li>
                            </ul>
                        </div>
                        </a>
                    </div>
                    {{-- Vista principal  --}}
                    <div class="col-6 p-1">
                        <a href="{{route('setting.mainView')}}" class="text-decoration-none">
                        <div class="backupBox p-1 h-100">
                            <h1> Vista principal </h1>
                            <p> Establece la vista del mapa que se verá como fondo durante toda la aplicación.  </p>
                        </div>
                        </a>
                    </div>
                    {{-- Marcadores --}}
                    <div class="col-6 p-1">
                        <a href="{{route('marker.admin')}}" class="text-decoration-none">
                        <div class="backupBox p-1 h-100">
                            <h1> Marcadores </h1>
                            <p> Serie de formas geométicas que se aplican sobre el mapa reprensentando partes reales del mismo para facilitar el proceso de alineamiento </p>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')


@endsection