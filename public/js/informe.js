
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
        $("#botonArrastre").hide();
        $('#informeObservacionesDraggable').removeClass("border border-success rounded");
        window.print();
        $(this).parent().show();
        $("#botonObservaciones").show();
        $("#botonArrastre").show();
        $('#informeObservacionesDraggable').addClass("border border-success rounded");
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

});



