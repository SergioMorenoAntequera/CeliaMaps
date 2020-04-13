$(document).ready(function(){

    // FUNCIÓN PARA LIMPIAR LOS CAMPOS DEL FORMULARIO DESPUÉS DE CADA INSERCIÓN //////
    function campoVacio(){
        $("#name").val('');
        $("#email").val('');
        $("#password").val('');
        $("#password_confirmation").val('');
        $("#level").val('');
    }

    //EL TOKEN, QUE NO FUNCIONABA SIN ÉL ////////////
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // AÑADIR USUARIOS CON AJAX ///////////////////////////////////
    $("#enviarUsuario").click(function(e){
        // PARA QUE NO SE RECARGUE LA PÁGINA //////////
        e.preventDefault();
        // SE RECOGEN  LOS VALORES DEL FORMULARIO Y SE GUARDAN EN VARIABLES
        var nombre = $("input[name = name]").val();
        var email = $("input[name = email]").val();
        var pass = $("input[name = password]").val();
        var confPass = $("input[name = password_confirmation]").val();
        var level = $("input[name = level]").val();



        $.ajax({
            type:'POST',
            dataType: 'json',
            url:  "{{route('user.store')}}",
            /*
            al pasar los datos del nuevo usuario se hace por par nombre del campo en la base
            de datos : nombre de la variable que hemos declarado con el campo.
            y se pasan en el mismo orden en el que están en la base de datos
            */

            data: {name:nombre, email:email, password:pass, password_confirmation:confPass, level:level},

            // SI EL MÉTODO FUNCIONA NOS MUESTRA UN ALERT Y SE VACÍAN LOS CAMPOS DEL FORMULALRIO
            success: function(){
                alert("Usuario insertado con éxito");
                campoVacio();
                $('.error')[0].innerHTML = "";
                $('.error')[1].innerHTML = "";
                $('.error')[2].innerHTML = "";
                $('.error')[3].innerHTML = "";
                $('.error')[4].innerHTML = "";

            },
            // SI EL MÉTODO NO FUNCIONA NOS MUESTRA LOS MENSAJES DE ERROR DEBAJO DE CADA CAMPO DEL FORMULARIO
            error: function(e){
                // Número de errores contenidos en la respuesta JSON
                /*
                Utilizamos los if para cada error porque si se deja como está abajo, en el
                campo correcto aparece un mensaje de undefined
                   */
                if (e.responseJSON.errors.name){
                $('.error')[0].innerHTML = e.responseJSON.errors.name;
                }  else{$('.error')[0].innerHTML = "";}
                if (e.responseJSON.errors.email){
                $('.error')[1].innerHTML = e.responseJSON.errors.email;
                }  else{$('.error')[1].innerHTML = "";}
                if (e.responseJSON.errors.password){
                $('.error')[2].innerHTML = e.responseJSON.errors.password;
                }   else{$('.error')[2].innerHTML = "";}
                if (e.responseJSON.errors.level){
                $('.error')[3].innerHTML = e.responseJSON.errors.level;
                }   else{$('.error')[3].innerHTML = "";}
                if (e.responseJSON.errors.level){
                $('.error')[4].innerHTML = e.responseJSON.errors.level;
                }   else{$('.error')[4].innerHTML = "";}

                /*
                $('.error')[0].innerHTML = e.responseJSON.errors.name;
                $('.error')[1].innerHTML = e.responseJSON.errors.email;
                $('.error')[2].innerHTML = e.responseJSON.errors.password;
                $('.error')[3].innerHTML = e.responseJSON.errors.level;
                */
            }

        });

    });

});
