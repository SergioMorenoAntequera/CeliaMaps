@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
    (En teoría)Aquí se enseñan todos los mapas
    
@endsection

@section('content')
    
    <!-- One div to get all the maps -->
    <div class="container text-center">
        <p>Estaría bien poner aqui una serie de opciones por las cuales se pueda filtrar el mapa que sale</p>
        <a href="{{route('map.create')}}"> 
            <button> 
                Crear nuevo 
            </button>
        </a>

        <!-- Todos los elementos de la página -->
        <div id="allElements" class="justify-content-center mt-3">

            @foreach ($maps as $map)
                <!-- Cada uno de los elementos de la página -->
                <div id="oneElement{{$map->level}}" class="row mb-4 justify-content-center">
                    <!-- Columna con el numero y las flechas -->
                    <div class="col-1 bg-warning justify-content-center">
                        <a  class="bUp"><button id="bUp{{$map->level}}">Up</button></a>
                        <br>
                        <span id="level{{$map->level}}">{{$map->level}}</span>
                        <br>
                        <a class="bDown"><button id="bDown{{$map->level}}">Down</button></a>
                    </div>

                    <!-- Columna con el numero y las flechas -->
                    <div class="col-10 px-3 py-1 ml-4 text-left bg-danger">
                        <!-- Titulo -->
                        <p><b class="text-white text-6">{{$map->title}}</b></p>
                        <!-- Foto/miniatura -->
                        <a style="float: left" href="{{route("map.show", $map->id)}}">
                            <img class="mr-4 ml-5" style="width: 100px" src="{{url("img/miniatures/$map->miniature")}}" alt="Miniatura">
                        </a>
                        <!-- Algunos detalles -->
                        <p>{{$map->city}} - {{$map->date}}</p>
                        <p> {{$map->description}}</p>
                        <div style="clear: both"></div>

                        <!-- Boton para modificar -->
                        <a href="{{route('map.edit', $map->id)}}"> 
                            <button class="cornerUpdateButton bg-secondary">
                                <img src="{{url("img/icons/editWhite.png")}}" alt=""> 
                            </button>
                        </a>
                        
                        <!-- Boton para borrar -->
                        <!-- action="{{route('map.destroy', $map->id)}}" -->
                        <form method="POST" action="{{route('map.destroy', $map->id)}}">
                            @csrf
                            @method("DELETE")

                            <button data-toggle="modal" data-target=".ModalCenter{{$map->id}}" class="cornerDeleteButton bg-secondary" type="submit" value="Eliminar">
                                <img src="{{url("img/icons/deleteWhite.png")}}" alt="">    
                            </button>
                        </form>
                        
                        <!-- Modal para borrar -->
                        <div class="modal fade text-dark ModalCenter{{$map->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">¿En serio?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <p>¿Seguro que quieres borrar el mapa {{$map->title}}?</p>
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-danger deleteConfirm" data-dismiss="modal">
                                            Eliminar
                                            <span class="d-none">{{$map->level}}</span> 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- FINAL modal para borrar -->
                    </div><!-- FINAL columna con info del mapa -->
                </div> <!-- FINAL .oneElement -->
            @endforeach
        </div> <!-- FINAL .allEments -->

        
    </div>
@endsection

@section('footer')

    <div>
        footer
    </div>

@endsection

@section('scripts')
    <!------------------------------------ FUNCTIONS WITH AJAX ---------------------------------->
    <!--------------------------------- DELETE, MOVE UP AND DOWN -------------------------------->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script>
        $(document).ready(function(){
            // DELETE CON AJAX ///////////////////////////////////////////////////////////////////////
            $('.cornerDeleteButton').click(function(e){
                e.preventDefault();
            });
            $('.deleteConfirm').click(function(){
                //We delete using ajax
                //var auxLevel = jQuery(this).children();
                
                var mapParent = jQuery(this).parent().parent().parent().parent().parent().parent();
                var maps = mapParent.parent();
                var level = jQuery(jQuery(mapParent.children()[0]).children()[2]);

                console.log(mapParent);
                $.ajax({
                    method: "DELETE",
                    url: "{{route('map.destroy', "+level.text()+")}}",
                    data: {
                        "level": level.text(),
                        "_token": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function(data){
                        //Lo que tenemos que hacer desaparecer
                        mapParent.slideUp(400, function(){
                            mapParent.remove();
                            var index = 1;
                            for(var i = 1; i <= jQuery($('#allElements').children()).length + 1; i++){
                                if(i == level.text()){
                                    continue;
                                }

                                console.log(index);
                                console.log($('#level'+i));
                                $('#level'+i).text(index);
                                $('#level'+i).attr('id', 'level'+index);
                                $('#oneElement'+i).attr('id', 'oneElement'+index++);
                            }
                        });
                    }
                });
            });
            

            // MOVE UP ///////////////////////////////////////////////////////////////////////
            $('.bUp').click(function(){
                var parent = $(this).parent().parent().parent();
                var mapSelected = $(this).parent().parent();
                var level = jQuery(mapSelected.children()[0]);
                level = jQuery(level.children()[2]);
                var button = jQuery(jQuery(jQuery(mapSelected.children()[0]).children()[0]).children()[0]);

                if(level.text() == 1){
                    alert("No puedes subir el primer mapa");
                    return;
                }
                
                button.prop('disabled', true);
                $.ajax({
                    method: "GET",
                    url: "{{route('map.up')}}",
                    data: {level: level.text()},
                    success: function(data){

                        //Here we update the position of the divs
                        //Here we have to update the numbers in the divs
                        for (var i = 0; i < parent.children().length; i++) {
                            //We get the id of all the elements
                            var mapOther = jQuery(parent.children().get(i-1));
                            var levelOther = jQuery(mapOther.children()[0]);
                            levelOther = jQuery(levelOther.children()[2]);
                            //var levelOther = parseInt(mapOther.attr('id').replace("mapLevel", ""));
                            //console.log(idElement);

                            if(levelOther.text() == level.text() - 1){
                                mapOther.fadeOut(300);
                                mapSelected.fadeOut(300, function(){
                                    level.text(parseInt(level.text()) - 1);
                                    levelOther.text(parseInt(levelOther.text()) + 1);
                                    
                                    level.attr('id', "level"+level.text());
                                    levelOther.attr('id', "level"+levelOther.text());
                                    mapSelected.attr('id', "oneElement"+level.text());
                                    mapOther.attr('id', "oneElement"+levelOther.text());

                                    mapSelected.after(mapOther);
                                    mapOther.fadeIn(300);
                                    mapSelected.fadeIn(300);
                                    button.prop('disabled', false);
                                });

                                return;
                            }
                        }                        
                    }
                });
            });

            // MOVE DOWN   ///////////////////////////////////////////////////////////////////////
            $('.bDown').click(function(){
                var parent = $(this).parent().parent().parent();
                var mapSelected = $(this).parent().parent();
                var level = jQuery(mapSelected.children()[0]);
                level = jQuery(level.children()[2]);
                //Uncool but fast version
                var button = jQuery(jQuery(level.siblings()[3]).children()[0]);
                //Cool but slow version
                //var button = $('.bDown'+level.text());
                button.prop('disabled', true);

                $.ajax({
                    method: "GET",
                    url: "{{route('map.down')}}",
                    data: {level: level.text()},
                    success: function(data){

                        //Here we update the position of the divs
                        //Here we have to update the numbers in the divs
                        for (var i = 0; i < parent.children().length; i++) {
                            //We get the id of all the elements
                            

                            var mapOther = jQuery(parent.children().get(i+1));
                            var levelOther = jQuery(mapOther.children()[0]);
                            levelOther = jQuery(levelOther.children()[2]);
                            
                            if(parseInt(levelOther.text()) == parseInt(level.text()) + 1){
                                mapOther.fadeOut(300);
                                mapSelected.fadeOut(300, function(){
                                    mapSelected.before(mapOther);
                                    
                                    level.text(parseInt(level.text()) + 1);
                                    levelOther.text(parseInt(levelOther.text()) - 1);
                                    button.prop('disabled', false);

                                    level.attr('id', "level"+level.text());
                                    levelOther.attr('id', "level"+levelOther.text());
                                    mapSelected.attr('id', "oneElement"+level.text());
                                    mapOther.attr('id', "oneElement"+levelOther.text());

                                    mapOther.fadeIn(300);
                                    mapSelected.fadeIn(300);
                                });
                                return;
                            }
                        }                        
                    }
                });
            });

        });
    </script>
@endsection