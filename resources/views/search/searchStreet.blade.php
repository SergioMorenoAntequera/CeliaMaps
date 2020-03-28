@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')

@endsection

@section('content')


<div id="contenedor" class="container">
  <div class="wholePanel">

    <div class="container text-center mt-5">
      <div class="wholePanel" style="min-height: 570px">
          <div class="leftPanel" style="min-height: 570px">
              <div class="content" style="font-size: 18px; font-weight: normal">
                  <p style="font-size: 30px"><b> Búsqueda de Calles </b></p>
                  </div>


                    <div id="buscadorVia" class="container align-center"  width="25%">
                      <form class="form-inline float-right">
                        <input type="text" id="cajaTexto" class="form-control" placeholder="Nombre Vía">
                        <img  id="lupa" src="{{url('/img/icons/lupa-blanca.png')}}" width="15%" alt="" class="img-fluid pt-1">
                      </form>
                      <!--
                      <div id="limpiar" class="row float-left pl-4">
                        <button id="limpiando" type="button" class="btn btn-success btn-sm">Limpiar búsqueda</button>
                    </div>
                    -->
                    </div>


          </div>


    <div class="rightPanel" >
      <!-- style="width:100%;" -->

      <!-- inicio cuadro de búsqueda -->

      <br>
      <br>
      <br>
      <!-- final cuadro de búsqueda
       <h4>Panel de búsqueda de calles</h4>
      -->


      <div id="container">
      <!-- Inicio listado calles -->
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

@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

      $('#cajaTexto').keyup(function(){

        var elNombreDelaCalle = $(this).val();
        var id;

        console.log(elNombreDelaCalle)
        // Capturamos en la variable la ruta generada por blade
        let url = "{{url("search/inform")}}";
        console.log(url);
          if(($('#cajaTexto').val().length)>=3){

            $.ajax({
              url: "{{route('search.search')}}",
              type: 'post',
              dataType: 'json',
              data: {text:elNombreDelaCalle},
                success: function(response){

                  $("#resultado").html("");
                  $("#resultado").append('<a class="font-weight-bold text-success" href='+url+"/"+response[0].id+'>' + response[0].name + ' ' + response[0].street_name + '</a></br>');
                  $("#resultadoAlternativo").html("");
                  if(response[0].alternative_name != null){
                  $('#resultadoAlternativo').append('Se corresponde con ' + response[0].alternative_name + '</p></br>');
                  }
                    let posicion = response.length;
                    console.log('esta es la posicion');
                    console.log(posicion);

                  for(var i = 1; i < response.length; i++){
                    id = response[i].id;
                    // damos a la variable name el valor del nombre de la calle
                    let name = response[i].name;
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
                    if(response != response[i].alternative_name){
                      $('#resultadoAlternativo').append('Se corresponde con ' + response[i].alternative_name + '</br>');
                    }

                    }
                },
                error:function(){
                  //alert("no funciona");
                }
            });
          }
      });
      $('#limpiando').on("click", function(){
        $("#cajaTexto").val('');
      });


  });
</script>

@endsection
