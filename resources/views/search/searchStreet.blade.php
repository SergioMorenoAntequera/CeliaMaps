@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
   
@endsection

@section('content')

<div class="row float-right">
<div id="buscadorVia" class="container">
  <form class="form-inline float-right">
      <input type="text" id="cajaTexto" class="form-control" placeholder="Nombre Vía">
      <!--  <button class="btn btn-outline-success" id="botonBuscador" type="submit">Búsqueda</button> -->
    </form>
  </div>
</div> 

      <div id="contenedor" class="container">     
       
            <div id="resultado" class="row bg-primary">
              @foreach ($streets as $street)              
                  <div class=" col-8">
                      <div id="resultadoVia" class="text-white">                        
                          <a href="{{route("search.report", $street->id)}}">{{$street->type->name}} {{$street->street_name}}</a>                       
                      </div>
                  </div>               
              @endforeach
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
    
      console.log(elNombreDelaCalle)
      
      $.ajax({
        url: "{{route('search.search')}}",
        type: 'post',
        dataType: 'json',      
        data: {text:elNombreDelaCalle},
        
        success: function(response){ 
          $("#resultado").html(""); 
          for(var i = 0; i< response.length; i++){
            
            //cuando haga el enlace hay qu incluir el a href en el append, igual que he metido el br
            $("#resultado").append('<a class="text-white" href="{{route("search.report",' + response[i].id')}}">' + response[i].name + ' ' + response[i].street_name + '</a></br>'); 
                                                     
           
            //$("#resultado").append(response[i].name+"</br>"); 
          } 
        },
        error:function(){
          alert("no funciona");
        }
        
      });
    });
});
</script>
    
@endsection
@section('scripts')

    <!-- ESTE ES MI CÓDIGO AJAX PARA BUSCAR

<script type="text/javascript">

    $(document).ready(function(){

      var ruta = '{{route("search.report", $street->id, $street->type->id)}}';
      var tipo = '{{$street->type->name}}';
    
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
      $('#cajaTexto').keyup(function(){
    
        var elNombreDelaCalle = $(this).val();
        
        $.ajax({
          url: "{{route('search.search')}}",
          type: 'post',
          dataType: 'json',      
          data: {text:elNombreDelaCalle},      
          
          success: function(response){ 
            $("#resultadoVia").html(""); 
            for(var i = 0; i < response.length; i++){
              //cuando haga el enlace hay qu incluir el a href en el append, igual que he metido el br
              $("#resultadoVia").append('<a class="text-white" href="' + ruta + '">' + tipo + response[i].name + '</a></br>'); 
              //<a class="text-white" href="{{route("street.show", $street->id)}}">{{$street->type->type}} {{$street->name}}</a>
              
        console.log(ruta)
              //este es el código original de la vista searchStreet que va dentro del append:  response[i].name+"</br>"  response[i].type_id 
            } 
          },
          error:function(){
            alert("no funciona");
          }
          
        });
      });
    });
  });
});
</script>



/*

    $(document).ready(function(){

      var ruta = '{{route("street.show", $street->id )}}';
      var tipo = '{{$street->type->name}}';
    
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
      $('#cajaTexto').keyup(function(){
    
        var elNombreDelaCalle = $(this).val();
        
        $.ajax({
          url: "{{route('search.search')}}",
          type: 'get',
          dataType: 'json',      
          data: {text:elNombreDelaCalle},      
          
          success: function(response){ 
            $("#resultado").html(""); 
            for(var i = 0; i < response.length; i++){
              //cuando haga el enlace hay qu incluir el a href en el append, igual que he metido el br
              $("#resultado").append('<a class="text-white" href="' + ruta + '">' + tipo + response[i].name + '</a></br>'); 
              //<a class="text-white" href="{{route("street.show", $street->id)}}">{{$street->type->type}} {{$street->name}}</a>
              
        console.log(ruta)
              //este es el código original de la vista searchStreet que va dentro del append:  response[i].name+"</br>"  response[i].type_id 
            }   
            
             
          },
          error:function(){
            alert("no funciona");
          }
          
        });
      });
    });
    */
    -->