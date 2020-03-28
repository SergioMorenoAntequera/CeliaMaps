$(document).ready(function(){

    function mostrarCreando(){
        $('#loaderCreando').removeClass("collapse");
    };
    function ocultarCreando(){
        $('#loaderCreando').removeClass("collapse.show");
        $('#loaderCreando').addClass("collapse");
    };
    function mostrarRestaurando(){
        $('#loaderRestaurando').removeClass("collapse");
    };
    function ocultarRestaurando(){
        $('#loaderRestaurando').removeClass("collapse.show");
        $('#loaderRestaurando').addClass("collapse");
    };

    function mostrarModalCreada(){
        $('#mensajeGenerarModal').show();
    }
    function mostrarModalRestaurada(){
        $('#mensajeRestaurarModal').show();

    }


    // Evento Guardar
    $("#confirmCreate").click(function(e) {

        $.ajax({
            url: urlCreate,
            beforeSend: function(){
                mostrarCreando();
            },
            success: function(){
                ocultarCreando();
            },
            complete: function(){
                mostrarModalCreada();
                $('#cerrarCrear').on('click', function(){
                    $('#mensajeGenerarModal').hide();
                });
            }
        });
    });

    // Evento restaurar
    $("#confirmRestore").click(function(e) {

        $.ajax({
            url: urlRestore,
            beforeSend: function(){
                mostrarRestaurando();
            },
            success: function(){
                ocultarRestaurando();
            },
            complete: function(){
                mostrarModalRestaurada();
                $('#cerrarRestaurar').on('click', function(){
                    $('#mensajeRestaurarModal').hide();
                });
            }
        });
    });
});
