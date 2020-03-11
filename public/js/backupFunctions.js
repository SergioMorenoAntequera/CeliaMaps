$(document).ready(function(){

    // Evento Guardar
    $("#confirmCreate").click(function(e) {
        $.ajax({
            url: urlCreate,
            success: function(){
                alert("Copia de seguridad creada con exito");
            }
        });
    });

    // Evento restaurar 
    $("#confirmRestore").click(function(e) {
        e.preventDefault();
        $.ajax({
            url: urlCreate,
            success: function(){
                alert("Base de datos restaurada con exito");
            }
        });
    });
}); 