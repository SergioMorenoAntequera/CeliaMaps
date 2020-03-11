@extends('layouts/master')

@section('header')
@endsection 

@section('content')
<div class="container">
    <div class="row mt-5">


        {{-- GENERAR COPIA  --}}
        <div class=" col-12 offset-md-1 col-md-5">
            <div id="createCopy" class="backupBox p-5" data-toggle="modal" data-target="#saveModal">
                <h1 class="mb-4">
                    <b> GUARDAR </b>   
                </h1>
                <img src="{{url('img/icons/save.svg')}}">
            </div>
        </div>
        <div class="offset-0 offset-md-0"></div>
        <!-- Modal create -->
        <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> Guardar copia de seguridad </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <p>
                        Si continuas se creará una copia de seguridad de la base de datos en el estado actual,
                        sobreescribiendo a las versiones anteriores, <b>¿Quieres continuar?</b>
                    </p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"> Cancelar </button>
                <button id="confirmCreate" type="button" class="btn btn-success" data-dismiss="modal">Crear copia</button>
                </div>
            </div>
            </div>
        </div>

        {{-- ------------------------------------------------------------------------------------------------ --}}
        {{-- RESTAURAR COPIA --}}
        <div class="col-12 col-md-5">
            <div id="restoreCopy" class="backupBox p-5" data-toggle="modal" data-target="#restoreModal">
                <h1 class="mb-4">
                    <b> RESTAURAR </b>   
                </h1>
                <img src="{{url('img/icons/database.svg')}}">
            </div>
        </div>
        <!-- Modal restaurar -->
        <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> Restaurar copia de seguridad </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <p>
                        Si continuas los datos de la aplicación se sobreescribirán con los datos 
                        que se hayan guardado más recientemente. <b>¿Quieres continuar?</b>
                    </p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"> Cancelar </button>
                <button id="confirmRestore" type="button" class="btn btn-success" data-dismiss="modal">Restaurar copia</button>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
    <script>
        var urlCreate = "{{route('backup.create')}}";
        var urlRestore = "{{route('backup.restore')}}";
    </script>
    <script src="{{url('js/backupFunctions.js')}}"></script>
@endsection

@section('footer')
@endsection