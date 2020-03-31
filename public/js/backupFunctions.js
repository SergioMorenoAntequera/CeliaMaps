$(document).ready(function(){

    function mostrarLoaderCreando(){
        $('#loaderCreando').show();
    };
    function ocultarLoaderCreando(){
        $('#loaderCreando').hide();
    };
    function mostrarLoaderRestaurando(){
        $('#loaderRestaurando').show();
    };
    function ocultarLoaderRestaurando(){
        $('#loaderRestaurando').hide();
    };

    function mostrarModalCreada(){
        $('#mensajeGenerarModal').show();
    }
    function mostrarModalRestaurada(){
        $('#mensajeRestaurarModal').show();
    }
    function cerrarModalCreada(){
        $('#cerrarCrear').on('click', function(){
            $('#mensajeGenerarModal').hide();
        });
    }
    function cerrarModalRestaurada(){
        $('#cerrarRestaurar').on('click', function(){
            $('#mensajeRestaurarModal').hide();
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
