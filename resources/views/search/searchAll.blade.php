@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')

@endsection

@section('content')


<div id="contenedor" class="container">
    <div id="titulo" class="mt-3">
        <h2  class="text-center text-success display-3">Generar informe</h2>
    </div>
    <div class="wholePanel" style="min-height: 570px">
        <!-- PANEL IZQUIERDO -->
        <div class="leftPanel" style=" width: 50%; padding: 30px;">
            <div class="contenido d-flex flex-column mt-3">
                <!-- BUSCADOR Y BOTÓN LIMPIAR PANEL IZQIERDO -->
                <div id="buscadorhotspot" class="container align-center"  width="25%">
                    <form class="form-inline float-left">
                        <input type="text" id="cajaTextoHotspot" class="form-control" placeholder="Punto de interés" onfocus="this.placeholder=''" onblur="this.placeholder='Punto de interés'">
                    </form>
                    <img  id="lupaBlanca" src="{{url('/img/icons/lupablanca.png')}}" width="8%" alt="" class="img-fluid pt-1 ml-2">

                    <div id="limpiarHotspots" class="row float-right pl-4">
                        <a href="{{route('search.index')}}">
                            <button id="limpiandoHotspot" type="button" class="btn text-success btn-sm mr-5" style="background-color: white;">Limpiar búsqueda</button>
                        </a>
                    </div>

                </div>
                <!-- Inicio listado puntos de interés -->
                <div id="containerHotspot">
                    <div id="resultadoHotspot">
                        @foreach ($hotspots as $hotspot)
                            <div class="row">
                                <div class=" col-8">
                                    <div class="text-white">
                                        <b><a class="text-white" href="{{route("search.hotspot", $hotspot->id)}}">{{$hotspot->title}}</a></b>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <!-- PANEL DERECHO -->
        <div class="rightPanel" style=" width: 50%;">
            <div class="contenido d-flex flex-column mt-3">
                 <!-- BUSCADOR Y BOTÓN LIMPIAR PANEL DERECHO -->
                <div id="buscadorVia" class="container align-center"  width="25%">
                    <form class="form-inline float-left">
                        <input type="text" id="cajaTexto" class="form-control border-success" placeholder="Vía" onfocus="this.placeholder=''" onblur="this.placeholder='Vía'">
                    </form>
                    <img  id="lupaVerde" src="{{url('/img/icons/lupaverde.png')}}" width="8%" alt="" class="img-fluid pt-1 ml-2">
                    <div id="limpiarCalles" class="row float-right pl-4">
                        <a href="{{route('search.index')}}">
                            <button id="limpiandoCalles" type="button" class="btn btn-success btn-sm mr-5">Limpiar búsqueda</button>
                        </a>
                    </div>
                </div>
                <!-- Inicio listado calles -->
                <div id="container">
                    <div id="resultado">
                        @foreach ($streets as $street)
                            <div class="row">
                                <div class=" col-8">
                                    <div class="text-white">
                                        <b><a class="text-success" href="{{route("search.inform", $street->id)}}">{{$street->type->name}} {{$street->name}}</a></b>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div id="resultadoAlternativo" class="text-success"></div>
                </div>
                <!-- final listado calles -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        ////////////// BUSCADOR DE CALLES /////////////////////////////////////////////////////////////////////
      $('#cajaTexto').keyup(function(){
        var elNombreDelaCalle = $(this).val(); // esta variable contiene lo que se va escribiendo en #cajaTexto
        var id;
        console.log(elNombreDelaCalle)
        // Capturamos en la variable la ruta generada por blade
        let url = "{{url("search/inform")}}";
        console.log(url);
          if(($('#cajaTexto').val().length)>=3){ // ajax empezará a funcionar cuando se hayan introducido tres caracteres
            $.ajax({
              url: "{{route('search.search')}}",
              type: 'post',
              dataType: 'json',
              data: {text:elNombreDelaCalle}, // con text: recuperamos el texto contenido en la variable elNombreDelaCalle
                success: function(response){
                  $("#resultado").html("");
                  $("#resultado").append('<a class="font-weight-bold text-success" href='+url+"/"+response[0].id+'>' + response[0].name + ' ' + response[0].street_name + '</a></br>');
                  $("#resultadoAlternativo").html("");
                    if(response[0].alternative_name != null){
                        $('#resultadoAlternativo').append('<a class="text-success" href='+url+"/"+response[0].id+'>Se corresponde con' + response[i].alternative_name + '</a></br>');
                    }
                    for(var i = 1; i < response.length; i++){
                            id = response[i].id;
                            // damos a la variable name el valor del nombre de la calle
                            let name = response[i].name;
                            // damos a la variable el nombre alternativo al nombre de la calle
                            let alternativo = response [i].alternative_name;
                            /*si el nombre contenido en la variable es diferente al nombre de esa misma variable
                            name en la vuelta anterior, entonces ese nombre de calle aparece en la vista, si el nombre anterior
                            se repite, entonces no aparece en la vista por segunda vez.
                            */
                                if(name != response[i-1].name){
                                    //cuando haga el enlace hay qu incluir el a href en el append, igual que he metido el br
                                    // Usamos la variable url generada al cargar la página para crear la dirección del enlace
                                    $("#resultado").append('<a class="font-weight-bold text-success" href=' + url + "/" + response[i].id + '>' + response[i].name + ' ' + response[i].street_name + '</a></br>');
                                }
                                // se aplica lo mismo que el if anterior, no se incluye en él porque alternative_name puede dar más de una respuesta
                                if( alternativo != null && alternativo != response[i-1].alternative_name){
                                    $('#resultadoAlternativo').append('<a class="text-success" href='+url+"/"+response[0].id+'>Se corresponde con' + response[i].alternative_name + '</a></br>');
                                }
                        }
                },
                error:function(){
                  //alert("no funciona");
                }
            });
          }
      });
      ////////////// FIN DE BUSCADOR DE CALLES /////////////////////////////////////////////////////////////////////


      ////////////// BUSCADOR DE PUNTOS DE INTERÉS /////////////////////////////////////////////////////////////////////
      $('#cajaTextoHotspot').keyup(function(){
        var hotspotName = $(this).val(); // esta variable contiene lo que se va escribiendo en #cajaTexto
        var id;
        // Capturamos en la variable la ruta generada por blade
        let url = "{{url("search/hotspot")}}";
        console.log(url);
          if(($('#cajaTextoHotspot').val().length)>=3){ // ajax empezará a funcionar cuando se hayan introducido tres caracteres
            $.ajax({
              url: "{{route('search.searchHotspot')}}",
              type: 'post',
              dataType: 'json',
              data: {text:hotspotName}, // con text: recuperamos el texto contenido en la variable elNombreDelaCalle
                success: function(response){
                  $("#resultadoHotspot").html("");
                  $("#resultadoHotspot").append('<a class="font-weight-bold text-white" href='+url+"/"+response[0].id+'>' + response[0].title +  '</a></br>');

                    for(var i = 1; i < response.length; i++){
                        id = response[i].id;
                        // damos a la variable name el valor del nombre del punto de interés
                        let title = response[i].title;
                        /*si el nombre contenido en la variable es diferente al nombre de esa misma variable
                        title en la vuelta anterior, entonces ese nombre del punto de interés aparece en la vista, si el nombre anterior
                        se repite, entonces no aparece en la vista por segunda vez.
                        */
                            if(title != response[i-1].title){
                            //cuando haga el enlace hay que incluir el a href en el append, igual que he metido el br
                            // Usamos la variable url generada al cargar la página para crear la dirección del enlace
                                $("#resultadoHotspot").append('<a class="font-weight-bold text-success" href=' + url + "/" + response[i].id + '>' + response[i].title + '</a></br>');
                            }
                    }
                },
                error:function(){
                  //alert("no funciona");
                }
            });
          }
      });
      ////////////// FIN DE BUSCADOR DE PUNTOS DE INTERÉS /////////////////////////////////////////////////////////////////////
      /*
      $('#limpiandoCalles').on("click", function(){
        let contenido = $('#resultado').val();
        let url = "{{url("search/hotspot")}}";
        $.ajax({

        });

      });
      */
  });
</script>

@endsection
