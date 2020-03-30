$(document).ready(function(){

    function mostrarLoaderCreando(){
        $('#loaderCreando').show();
    };
    function ocultarLoaderCreando(){
        $('#loaderCreando').hide();
    };
    function mostrarLoaderRestaurando(){
        $('#loaderRestaurando').open();
    };
    function ocultarLoaderRestaurando(){
        $('#loaderRestaurando').close();
    };

    function mostrarModalCreada(){
        $('#mensajeGenerarModal').open();
    }
    function mostrarModalRestaurada(){
        $('#mensajeRestaurarModal').open();
    }
    function cerrarModalCreada(){
        $('#cerrarCrear').on('click', function(){
            $('#mensajeGenerarModal').close();
        });
    }
    function cerrarModalRestaurada(){
        $('#cerrarRestaurar').on('click', function(){
            $('#mensajeRestaurarModal').close();
        });
    }



    // Evento Guardar
    $("#confirmCreate").click(function(e) {

        $.ajax({
            url: urlCreate,
            beforeSend: function(){
                mostrarLoaderCreando();
            },
            success: function(){
                ocultarLoaderCreando();
            },
            complete: function(){
                mostrarModalCreada();
                cerrarModalCreada();
            }
        });
    });

    // Evento restaurar
    $("#confirmRestore").click(function(e) {

        $.ajax({
            url: urlRestore,
            beforeSend: function(){
                mostrarLoaderRestaurando();
            },
            success: function(){
                ocultarLoaderRestaurando();
            },
            complete: function(){
                mostrarModalRestaurada();
                cerrarModalRestaurada();
            }
        });
    });
});
