
@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
   
@endsection

@section('content')

<div class="row float-right">
<div id="buscadorVia" class="container">
  
 
  <form class="form-inline float-right">   
      <input type="text" id="cajaTexto" class="form-control" placeholder="Nombre Vía">      
    </form>
   
  </div>
</div> 

      <div id="contenedor" class="container">     
        @foreach ($streets as $street)        
            <div id="resultado" class="row bg-primary">                           
                  <div class=" col-8">
                      <div id="resultadoVia" class="text-white">                                         
                          <a href="{{route("search.inform", $street->id)}}">{{$street->type->name}} {{$street->name}}</a>                       
                      </div>
                  </div>                   
            </div>          
          @endforeach
           
    
    </div>


@endsection
@section('scripts')

<script type="text/javascript">

  $(document).ready(function(){

    //var ruta = '{{route("search.inform", $street->id )}}';
    //var tipo = '{{$street->type->name}}';

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

      $('#cajaTexto').keyup(function(){

        var elNombreDelaCalle = $(this).val();      
        console.log(elNombreDelaCalle)

          if(($('#cajaTexto').val().length)>=3){

            $.ajax({
              url: "{{route('search.search')}}",
              type: 'post',
              dataType: 'json',      
              data: {text:elNombreDelaCalle},              
                success: function(response){ 
                  $("#resultado").html(""); 
                  for(var i = 0; i< response.length; i++){
                    var id = response[i].id;
                    //cuando haga el enlace hay qu incluir el a href en el append, igual que he metido el br
                    //$("#resultado").append(response[i].id + ' ' + response[i].name + ' ' + response[i].street_name + '</br>'); 
                    $("#resultado").append('<a class="text-white" href="{{route("search.inform",$street->id)}}">' + response[i].name + ' ' + response[i].street_name + '</a></br>');
                    //$("#resultado").append('<a class="text-white" href="{{route("search.inform",' + response[i].id +')}}">' + response[i].name + ' ' + response[i].street_name + '</a></br>'); 
                    } 
                },
                error:function(){
                  alert("no funciona");
                }              
            });
          } 
      });
  });
</script>
    
@endsection
