@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
@endsection

@section('content')

<div class="container text-center">
    <div id="allelements">       
        @foreach ($userList as $user)
            <div class="wholePanel" style="height:13%">
                <div class="leftPanel" style="width:10%; position: relative"> 
                    <img src="{{url('/img/icons/userWhite.png')}}" width="45%" alt="" class="img-fluid pt-1">
                    <p><strong><span class="userId text-4 pb-2">{{$user->id}}</span></strong></p>
                </div>
                <div class="rightPanel" style="width:90%; position: relative;">
                    <!-- nombre usuario -->
                    <div id="datos" style="pt-2">
                        <strong>{{$user->name}}</strong>
                        <br>
                        {{$user->email}}
                    </div>
                    <!-- botones -->

                      <!-- Boton para Borrar con modal incluida -->
                      <form method="POST" action="{{route('user.destroy',$user->id)}}">
                        @csrf
                        @method("DELETE")

                        <div data-toggle="modal" data-target="#ModalCenter{{$user->id}}" class="deleteCornerButton cornerButton">
                            <img class="center" src="{{url("img/icons/delete.svg")}}" alt=""> 
                        </div>
                    </form>
                    <div id="ModalCenter{{$user->id}}" class="modal fade text-dark" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">¿Está seguro?</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <p>Va a borrar el usuario {{$user->name}}?</p>
                                    <div class="col">
                                    <button type="button" class="col btn btn-info" data-dismiss="modal">Cancelar</button>
                                </div>
                                    <div class="col">
                                    <form method="POST" action="{{route('user.destroy',$user->id)}}">
                                        @csrf
                                        @method("DELETE")  
                                        
                                        <input type="submit"  class="col btn btn-danger" name="borrar" value="Eliminar">  
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FINAL modal para borrar -->
                     <!-- modificar -->
                        <a href="{{route('user.edit', ["user"=>$user->id])}}">
                            <div class="cornerButton" style="right:50px">
                                <img class="center" src="{{url("img/icons/edit.svg")}}" alt="">
                            </div>
                        </a>
                   
                </div>
            </div>
        @endforeach
    </div>    
</div>
<a href="{{route('user.create')}}">
    <div id="addButton">
        <img class="center" src="{{url("img/icons/plus.svg")}}">
    </div>
    </a>

@endsection

@section('scripts')

    <!------------------------------------ FUNCTIONS WITH AJAX ---------------------------------->
    <!--------------------------------- DELETE, MOVE UP AND DOWN -------------------------------->
    <!--
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script> var token = '{{csrf_token()}}'</script>
    <script type="text/javascript" src="{{url('/js/deleteAjax.js')}}">
    </script>
-->
<script  type="text/javascript"> 

      

$('document').ready(function(){
   
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".deleteConfirm").on("click", function(){

    var ruta = "{{route('user.destroy', ["user"=>$user->id])}}";
    $.ajax({
        type:"delete",
        url: ruta,
        data: {id:$(this).attr("iddb")},
        success: function(e){
            if(e['status']){
                $(".wholePanel" + e['id']).remove();
                alert("Usuario borrado con éxito");
            }else{
                alert("El borrado no funciona");
            }
           
        }
        

        });
    });

});

</script>
@endsection
