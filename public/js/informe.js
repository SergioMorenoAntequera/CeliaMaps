
$(document).ready(function() {

     // AL CARGAR LA PÁGINA COMPROBAMOS SI EXISTEN LAS COOKIES DE LA AYUDA O SU VALOR

     control = Cookies.get('contextHelp');
     console.log(control);
     if(control != "false" || control == null){
        $('#cPopUp').css('display','inline-block');
     }
     control1 = Cookies.get('contextHelp1');
     console.log(control1);
     if(control1 != "false" || control1 == null){
        $('#cPopUp1').css('display','inline-block');
     }

     // PARA QUE LA AYUDA SE OCULTE CON EL BOTÓN "X"
     var cpuX = $("#cPopUp .cornerButton");
     cpuX.click(function(e){
        $('#cPopUp').hide();
    });
    var cpuX = $("#cPopUp1 .cornerButton");
     cpuX.click(function(e){
        $('#cPopUp1').hide();
    });

    // AL HACER CLICK EN "NO VOLVER A MOSTRAR" CREAMOS LA COOKIE CON VALOR FALSE
    // Y ESCONDEMOS LA AYUDA
    $('#noVolverAMostrar').on("click", function(){
        Cookies.set('contextHelp', 'false');
        $('#cPopUp').hide();
    });
    $('#noVolverAMostrar1').on("click", function(){
        Cookies.set('contextHelp1', 'false');
        $('#cPopUp1').hide();
    });

    // CALCULAR LA FECHA ACTUAL
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

  // ELIMINA LINEA DE AYUDA TEXTO SUPERIOR
    $('#textoMapas').on("click", function(){
        $('.intro1').remove();
    });

    //ELIMINA LINEA DE AYUDA E INCLUYE FECHA ACTUAL EN TEXTO INFERIOR
    $('#textoInforme').on("click", function(){
        $('.intro2').remove();
        document.getElementById('fechaInforme').innerHTML = ' ' + fechactual;
    });

    // ENLACES DE LA AYUDA CONTEXTUAL
    $('#enlace1').on('click', function(){
        $('#textoMapas').focus();
        $('.intro1').remove();
    });
    $('#enlace2').on('click', function(){
        $('#textoInforme').focus();
        $('.intro2').remove();
    });

    // BOTÓN IMPRIMIR
    $("#btn-pdf").on("click", function(){
        $("#btn-pdf").hide();
        $('.intro1').hide();
        $('.intro2').hide();
        window.print();
        $("#btn-pdf").show();
        $('.intro1').show();
        $('.intro2').show();
    });
});



