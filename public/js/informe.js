
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


    $('#aplicar').on("click", function(){
        parrafo = document.getElementById('observaciones').value;
        al_idrisi = document.getElementById('funcionarioa').value;
        document.getElementById('fechaInforme').innerHTML = ' ' + fechactual;
        document.getElementById('encabezado').innerHTML = 'Observaciones: ';
        document.getElementById('contenido').innerHTML = ' ' + parrafo;
        document.getElementById('nombreFuncionarioa').innerHTML = ' ' + firma +  al_idrisi;

    });

    $("#btn-pdf").on("click", function(){
        $(this).parent().hide();
        $("#botonObservaciones").hide();
        window.print();
        $(this).parent().show();
        $("#botonObservaciones").show();
    });

    $("#descartar").on("click", function(){
        fechactual = "";
        firma = "";
        parrafo = "";
        al_idrisi = "";
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

});




 /*
$(document).ready(function() {
    $(".draggable").draggable({
      cursor: 'move',
    });

    $(".droppable").droppable({
      drop: function(event, ui) {
        var str1 = ui.draggable.text(); //returns draggable value
        $(this).text(str1); //trying to set droppable target with draggable value
        return false
      }

       $( function() {
        $( "#map" ).sortable({
          revert: true
        });
        $( "#informeObservacionesDraggable" ).draggable({
          connectToSortable: "#map",
          helper: "clone",
          revert: "invalid"
        });
        //$( "ul, li" ).disableSelection();
      } );
    });
  });
*/



