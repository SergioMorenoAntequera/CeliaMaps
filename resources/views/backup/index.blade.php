@extends('layouts/master')

@section('header')
@endsection

@section('content')
<div class="container">

    <!-- LOADERS   -->

    <div id="loaderCreando" class="collapse">
        <div class="d-flex justify-content-center pt-5 ">
            <button id="crear" class="backupBox button btn-lg"  type="button" disabled>
                <span class="spinner-border spinner-border-lg text-white" role="status" aria-hidden="true"></span>
                    Creando copias de seguridad...
            </button>
        </div>
    </div>
    <div id="loaderRestaurando" class="collapse">
        <div class="d-flex justify-content-center pt-5 ">
            <button class="backupBox button btn-lg"  type="button" disabled>
                <span class="spinner-border spinner-border-lg text-white" role="status" aria-hidden="true"></span>
                    Restaurando copias de seguridad...
            </button>
        </div>
    </div>
    <!-- FIN DE LOADERS   -->

    <div class="row mt-5">
        {{-- GENERAR COPIA  --}}
        <div class=" col-12 offset-md-1 col-md-5">
            <div id="createCopy" class="backupBox p-5" data-toggle="modal" data-target="#saveModal">
                <h1 class="mb-4">
                    <b> GENERAR BACKUP </b>
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
                <h5 class="modal-title" id="exampleModalLongTitle"> Generar copias de seguridad </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <p>
                        Si continua, se creará una copia de seguridad de las imágenes contenidas en la
                        aplicación, así como  de la base de datos en el estado actual, sobreescribiendo
                        a las versiones anteriores. <b>¿Quiere continuar?</b><br>
                        Esta operación puede tardar unos minutos.
                    </p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"> Cancelar </button>
                <button id="confirmCreate" type="button"  class="btn btn-success" data-dismiss="modal">Crear copias</button>
                </div>
            </div>
            </div>
        </div>
         <!-- Fin Modal create -->

          <!-- MODAL MENSAJE COPIA GENERADA -->

        <div id="mensajeGenerarModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"> Generar copias de seguridad </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    Las copias de seguridad se han creado correctamente.
                </div>
                <div class="modal-footer">
                    <button id="cerrarCrear" type="button"  class="btn btn-success" data-dismiss="modal">Aceptar</button>
                </div>
              </div>
            </div>
          </div>

          <!-- FIN MODAL MENSAJE COPIA GENERADA -->

        {{-- ------------------------------------------------------------------------------------------------ --}}
        {{-- RESTAURAR COPIA --}}
        <div class="col-12 col-md-5">
            <div id="restoreCopy" class="backupBox p-5" data-toggle="modal" data-target="#restoreModal">
                <h1 class="mb-4">
                    <b> RESTAURAR BACKUP </b>
                </h1>
                <img src="{{url('img/icons/database.svg')}}">
            </div>
        </div>
        <!-- Modal restaurar -->
        <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> Restaurar copias de seguridad </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <p>
                        Si continua, se restaurará una copia de seguridad de las imágenes contenidas en la aplicación,
                        así como  dela base de datos, ambas con la última copia de seguridad guardada,
                        perdiéndose así lo introducido desde entonces hasta ahora.
                        <b>¿Quiere continuar?</b><br>
                        Esta operación puede tardar unos minutos.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"> Cancelar </button>
                    <button id="confirmRestore" type="button" class="btn btn-success" data-dismiss="modal">Restaurar copias</button>
                </div>
            </div>
            </div>
        </div>
        <!-- Fin Modal restaurar -->

          <!-- MODAL MENSAJE COPIA RESTAURADA -->

          <div id="mensajeRestaurarModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"> Restaurar copias de seguridad </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    Las copias de seguridad se han restaurado correctamente.
                </div>
                <div class="modal-footer">
                    <button id="cerrarRestaurar" type="button"  class="btn btn-success" data-dismiss="modal">Aceptar</button>
                </div>
              </div>
            </div>
          </div>

          <!-- FIN MODAL MENSAJE COPIA RESTAURADA -->

    </div>
</div>

@endsection

@section('scripts')
    <script>
        var urlCreate = "{{route('backup.create')}}";
        var urlRestore = "{{route('backup.restore')}}";

    </script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="{{url('js/backupFunctions.js')}}"></script>
@endsection

@section('footer')
@endsection
