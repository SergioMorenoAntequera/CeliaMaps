@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
@endsection

@section('content')


  
      <form class="form-inline float-right">
        <input type="text" id="cajaTexto" class="form-control" placeholder="Search">
        <button class="btn btn-outline-success" id="botonBuscador" type="submit">Search</button>
      </form>

    </div>
    
    
   
    <div id="resultado">
    @foreach ($streetList as $item)
        {{$item->name}} </br>
     @endforeach
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
        $("#resultado").text(""); 
        for(var i = 0; i< response.length; i++){
          //cuando haga el enlace hay qu incluir el a href en el append, igual que he metido el br
          $("#resultado").append(response[i].name+"</br>"); 
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




