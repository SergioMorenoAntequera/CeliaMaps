$(document).ready(function() {

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

    //console.log($('#encabezadoDraggable').text());
    console.log('pero esto funciona o no??');
    $('#mostrarocultar').hide();
    $('#volveramostrar').hide();
    $('#ocultarmapa').hide();
    $('#mostrarmapa').hide();

    $('#aplicar').on("click", function (){

        $('#encabezadoDraggable').css("display", "");
        //$('#mostrarocultar').css("display", "");
        $('#mostrarocultar').show();
        $('#volveramostrar').show();
        $('#ocultarmapa').show();
        $('#mostrarmapa').show();

        parrafo = document.getElementById('observaciones').value;
        al_idrisi = document.getElementById('funcionarioa').value;
        document.getElementById('fechaInforme').innerHTML = ' ' + fechactual;
        document.getElementById('contenido').innerHTML = ' ' + parrafo;
        document.getElementById('nombreFuncionarioa').innerHTML = ' ' + firma +  al_idrisi;
    });

    $('#mostrarocultar').on("click", function(){
        $('#encabezadoDraggable').hide();
        console.log('ha llegado al click de mostrar ocultar');
    });
    $('#volveramostrar').on("click", function(){
        $('#encabezadoDraggable').show();
        console.log('ha llegado al click de mostrar ocultar');
    });
    $('#ocultarmapa').on("click", function(){
        $('#map').hide();
        console.log('ha llegado al click de mostrar ocultar');
    });
    $('#mostrarmapa').on("click", function(){
        $('#map').show();
        console.log('ha llegado al click de mostrar ocultar');
    });

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


    $("#btn-pdf").on("click", function(){

        $("#btn-pdf").hide();
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
    /*
    $("#informeObservacionesDraggable").draggable({
        cursor: 'move',
        containment: "#ordenado", scroll: false
      });
      */
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
      $("#botonArrastre").draggable({
        cursor: 'move',
        //containment: "#informeObservacionesDraggable", scroll: false
      });
      /*
      $("#map").draggable({
        //disabled: true
        cursor: 'move',
        //containment: "#informeObservacionesDraggable", scroll: false
      });

      */
      $( function() {
        $( "#ordenado" ).sortable();
        $( "#ordenado" ).disableSelection();
      } );

      // para la galeria de los puntos de interés



});



