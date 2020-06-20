
$(document).ready(function() {

     // AL CARGAR LA PÁGINA COMPROBAMOS SI EXISTE LA COOKIE DE LA AYUDA O SU VALOR

     control = Cookies.get('contextHelp');
     console.log(control);
     if(control != "false" || control == null){
        $('#cPopUp').css('display','inline-block');
     }

     // PARA QUE LA AYUDA SE OCULTE CON EL BOTÓN "X"
     var cpuX = $("#cPopUp .cornerButton");
     cpuX.click(function(e){
        $('#cPopUp').hide();
    });

    // AL HACER CLICK EN "NO VOLVER A MOSTRAR" CREAMOS LA COOKIE CON VALOR FALSE
    // Y ESCONDEMOS LA AYUDA
    $('#noVolverAMostrar').on("click", function(){
        Cookies.set('contextHelp', 'false');
        $('#cPopUp').hide();
    });


    hoy = new Date();
    dia = hoy.getDate();
    mes = '';
    switch (hoy.getMonth()) {
        case 0:
          mes = "Enero";
          break;
        case 1:
          mes = "Febrero";
          break;
        case 2:
           mes = "Marzo";
          break;
        case 3:
          mes = "Abril";
          break;
        case 4:
          mes = "Mayo";
          break;
        case 5:
          mes = "Junio";
          break;
        case 6:
          mes = "Julio";
          break;
        case 7:
          mes = "Agosto";
          break;
        case 8:
          mes = "Septiembre";
          break;
        case 9:
          mes = "Octubre";
          break;
        case 10:
          mes = "Noviembre";
          break;
        case 11:
          mes = "Diciembre";
          break;
      }

    anio = hoy.getFullYear();


    fechactual = ("Almería, " + dia + " de " + mes + " de " + anio);
    firma = "Fdo.: ";
    console.log('pero esto funciona o no??');
    console.log(fechactual);


/*
      $('#probando').on('click', function(){
        var cook = getCookie("cookie1Probando");
        if (cook != "") {
          alert("Welcome again " + cook);
        } else {
           cook = prompt("Please enter your name:","");
           if (cook != "" && cook != null) {
             setCookie("cookie1Probando", cook, 30);
           }
        }
      });
*/




    $('#aplicar').on("click", function (){

        $('#encabezadoDraggable').css("display", "");
        //$('#mostrarocultar').css("display", "");
        $('#mostrarocultar').show();
        $('#volveramostrar').show();
        $('#ocultarmapa').show();
        $('#mostrarmapa').show();



        al_idrisi = document.getElementById('funcionarioa').value;
        document.getElementById('fechaInforme').innerHTML = ' ' + fechactual;
        //document.getElementById('contenido').innerHTML = ' ' + parrafo;
        document.getElementById('firmado').innerHTML = ' ' + firma +  al_idrisi;


    });

    $('#textoMapas').on("click", function(){
        $('.intro1').remove();
    });
    $('#textoInforme').on("click", function(){
        $('.intro2').remove();
        document.getElementById('fechaInforme').innerHTML = ' ' + fechactual;
    });

    $('#enlace1').on('click', function(){
        $('#textoMapas').focus();
        $('.intro1').remove();
    });
    $('#enlace2').on('click', function(){
        $('#textoInforme').focus();
        $('.intro2').remove();
    });

/*
        if (control == true) {
        $("#instructions").fadeOut();
        } else if (control == undefined) {
        Cookies.set('viewed', true);
        }
*/
    /*
    $("#descartar").on("click", function(){
        $('#encabezado').empty();
        $('#contenido').empty();
        $('#fechaInforme').empty();
        $('#nombreFuncionarioa').empty();
     });

     $('#aplicarCabecera').on("click", function (){
        linea1 = document.getElementById('linea1').value;
        linea2 = document.getElementById('linea1').value;
        linea3 = document.getElementById('linea1').value;
        linea4 = document.getElementById('linea1').value;
        image = document.getElementById('imagencabecera').value;
        document.getElementById('linea1').innerHTML = linea1;
        document.getElementById('linea2').innerHTML = linea2;
        document.getElementById('linea3').innerHTML = linea3;
        document.getElementById('linea4').innerHTML = linea4;
        document.getElementById('imagencabecera').innerHTML = linea4;
    });

    $("#descartarCabecera").on("click", function(){
        $('#linea1').empty();
        $('#linea2').empty();
        $('#linea3').empty();
        $('#linea4').empty();
        $('#imagencabecera').empty();
     });

*/
    $("#btn-pdf").on("click", function(){

        $("#btn-pdf").hide();
        $('.intro1').hide();
        $('.intro2').hide();

        $("#botonObservaciones").hide();
        $("#botonCabecera").hide();
        $("#mostrarocultar").hide();
        $('#volveramostrar').hide();
        $('#ocultarmapa').hide();
        $('#mostrarmapa').hide();
        //$(this).parent().hide();
        //$("#botonArrastre").hide();
        //$('#grupoBotones').hide();
        $('#informeObservacionesDraggable').removeClass("border border-success rounded");
        window.print();
        $("#btn-pdf").show();
        $('.intro1').show();
        $('.intro2').show();

        $("#botonObservaciones").show();
        $("#botonCabecera").show();
        $("#mostrarocultar").show();
        $('#volveramostrar').show();
        $('#ocultarmapa').show();
        $('#mostrarmapa').show();

        //$("#grupoBotones").show();
        //$(this).parent().show();
        //$("#botonArrastre").show();
        //$('#informeObservacionesDraggable').addClass("border border-success rounded");
    });

    $("#botonArrastre").draggable({
        cursor: 'move',
        //containment: "#informeObservacionesDraggable", scroll: false
      });

    $("#encabezadoDraggable").draggable({
        cursor: 'move',
        //containment:  "#informeObservacionesDraggable", scroll: false
      });
      $("#contenidoDraggable").draggable({
        cursor: 'move',
        containment: "#informeObservacionesDraggable", scroll: false
      });
      $("#fechaInformeDraggable").draggable({
        cursor: 'move',
        //containment:  "#informeObservacionesDraggable", scroll: false
      });

      $("#nombreFuncionarioaDraggable").draggable({
        cursor: 'move',
        //containment: "#informeObservacionesDraggable", scroll: false
      });

       $("#informeObservacionesDraggable").draggable({
        cursor: 'move',
        containment: "#ordenado", scroll: false
      });

      $("#textoDesplazable").draggable({
        cursor: 'move',
        //containment: "#contenidoDragable", scroll: false
      });

      $("#map").draggable({
        //disabled: true
        cursor: 'move',
        //containment: "#contenidoDragable", scroll: false
      });


      $(function() {
        $( "#contenidoSortable" ).sortable();
        $( "#contenidoSortable" ).disableSelection();
      } );


      // para la galeria de los puntos de interés

      $(function(){
          $('#textoInforme').draggable({
              handle: "#textoDragable"
          });


      });


});



