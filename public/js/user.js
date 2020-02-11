

  
    
  $(document).ready(function(){
  
      function campoVacio(){
          $("#name").val('');
          $("#email").val('');
          $("#password").val('');
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
      
  
          var nombre = $("input[name = name]").val();
          var email = $("input[name = email]").val();
          var pass = $("input[name = password]").val();
          var level = $("input[name = level]").val();
          
          
          //var route =  "{{route('user.store')}}";
  
          $.ajax({
              type:'POST',
              dataType: 'json',
              url:  "{{route('user.store')}}",
              // al pasar los datos del nuevo usuario se hace por par nombre del campo en la base
              // de datos : nombre de la variable que hemos declarado con el campo.
              // y se pasan en el mismo orden en el que están en la base de datos
              data: {name:nombre, email:email, password:pass, level:level},
              success: function(data){
                  //mostrarMensaje(data.mensaje);
                  //alert("no se por donde voy");
                  campoVacio();
              }
              
          });
  
      });
      /*
  
      // MODIFICAR USUARIOS CON AJAX
      $("#modificarUsuario").click(function(e){
          e.preventDefault(); 
      
  
          var nombre = $("input[name = name]").val();
          var email = $("input[name = email]").val();
          var pass = $("input[name = password]").val();
          var level = $("input[name = level]").val();
  
          $.ajax({
              type:'PUT',
              dataType: 'json',
              url:  "{{route('user.update', $id->id)}}",
              // al pasar los datos del nuevo usuario se hace por par nombre del campo en la base
              // de datos : nombre de la variable que hemos declarado con el campo.
              // y se pasan en el mismo orden en el que están en la base de datos
              data: {name:nombre, email:email, password:pass, level:level},
              success: function(data){
                  //mostrarMensaje(data.mensaje);
                  //alert("no se por donde voy");
                  campoVacio();
              }
              
          });
  
      });
      */
  });
  
  
  
  
 