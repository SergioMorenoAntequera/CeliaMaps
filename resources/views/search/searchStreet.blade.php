@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')

@endsection

@section('content')


<div id="contenedor" class="container">
  <div class="wholePanel">

    <div class="rightPanel" style="width:100%;">

      <!-- inicio cuadro de búsqueda -->
      <div class="row float-right">
        <div id="buscadorVia" class="container">
          <form class="form-inline float-right">
            <input type="text" id="cajaTexto" class="form-control" placeholder="Nombre Vía">
          </form>
        </div>
      </div>
      <br>
      <!-- final cuadro de búsqueda -->

      <h4>Panel de búsqueda de calles</h4>

      <!-- Inicio listado calles -->
      <div id="resultado">
        @foreach ($streets as $street)
        <div class="row">
          <div class=" col-8">
            <div class="text-white">
              <a href="{{route("search.inform", $street->id)}}">{{$street->type->name}} {{$street->name}}</a>
            </div>
          </div>
        </div>
        @endforeach
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
                  $("#resultado").append('<a href='+url+"/"+response[0].id+'>' + response[0].name + ' ' + response[0].street_name + '</a></br>');
                  for(var i = 1; i< response.length; i++){
                    id = response[i].id;
                    console.log(response[i]);
                    // damos a la variable name el valor del nombre de la calle
                    let name = response[i].name;
                    /*si el nombre contenido en la variable es diferente al nombre de esa misma variable
                    name en la vuelta anterior, entonces ese nombre de calle aparece en la vista, si el nombre anterior
                    se repite, entonces no aparece en la vista por segunda vez.
                    */
                    if(name != response[i-1].name){
                      //cuando haga el enlace hay qu incluir el a href en el append, igual que he metido el br 
                      // Usamos la variable url generada al cargar la página para crear la dirección del enlace
                      $("#resultado").append('<a href='+url+"/"+response[i].id+'>' + response[i].name + ' ' + response[i].street_name + '</a></br>');
                    }                    
                    } 
                },
                error:function(){
                  //alert("no funciona");
                }              
            });
          } 
      });
  });
</script>

@endsection