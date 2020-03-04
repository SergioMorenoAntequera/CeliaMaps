<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Celia Maps</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/css/home.css')}}">
</head>
<body>
    <div class="container-fluid bg-primary text-center">

        <img id="background" src="{{url('img/resources/background.jpeg')}}" alt="">

        <div id="pageCenter">
            <div id="pageContent" class="noselect">
                <div id="logo">
                    <img class="img-fluid" src="{{url('img/icons/icon.png')}}" alt="">
                </div>
                <div id="title" style="opacity: 0">
                    CELIA MAPS
                </div>
                <div id="subTitle" style="opacity: 0">
                    Paseo por Almería a través del tiempo
                </div>
                <button id="startButton" class="fill" style="opacity:0"  onclick="location.href = (location.href.replace('/home', ''))">
                    COMENZAR
                </button>

                {{-- Las tres cosillas esas de ahí abajo --}}
                <div id="bottom">
                    <div id="bottomElements">
                        <a class="text-decoration-none text-reset" href="https://iescelia.org/web/">
                            <div class="element">
                                Centro Celia Viñas
                            </div>
                        </a>
                        |
                        <a class="devLink text-decoration-none text-reset" href="">
                            <div class="element">
                               <b>Desarrolladores</b>
                            </div>
                        </a>
                        |
                        <a class="text-decoration-none text-reset" href="">
                            <div class="element">
                                Políticas de privacidad
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Ventana de los desarrolladores --}}
            <div id="developers" >
                <div class="container-fluid">
                    <div class="row justify-content-center mt-4">
                        <div class="col-2 mx-1">
                            <div class="student">
                                <div class="studentHead">
                                    <img class="user" src="box.png" alt="">
                                </div>
                                
                                <div class="studentBody">
                                    <p class="name">
                                        Sergio Moreno Antequera
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mx-1" style="margin-right: 15% !important">
                            <div class="student">
                                <div class="studentHead">
                                    <img class="user" src="box.png" alt="">
                                </div>
                                
                                <div class="studentBody">
                    
                                    <p class="name">
                                        Sergio Moreno Antequera
                                    </p>
                                    <p class="avaliable">
                                        Disponible
                                    </p>
                                    <div class="courses">
                                        <span class="course"> DAW </span>
                                        <span class="course"> DAM </span>
                                        <span class="course"> ASIR </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mx-1" style="margin-left: 15% !important">
                            <div class="student">
                                <div class="studentHead">
                                    <img class="user" src="box.png" alt="">
                                </div>
                                
                                <div class="studentBody">
                    
                                    <p class="name">
                                        Sergio Moreno Antequera
                                    </p>
                                    <p class="avaliable">
                                        Disponible
                                    </p>
                                    <div class="courses">
                                        <span class="course"> DAW </span>
                                        <span class="course"> DAM </span>
                                        <span class="course"> ASIR </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mx-1">
                            <div class="student">
                                <div class="studentHead">
                                    <img class="user" src="box.png" alt="">
                                </div>
                                
                                <div class="studentBody">
                    
                                    <p class="name">
                                        Sergio Moreno Antequera
                                    </p>
                                    <p class="avaliable">
                                        Disponible
                                    </p>
                                    <div class="courses">
                                        <span class="course"> DAW </span>
                                        <span class="course"> DAM </span>
                                        <span class="course"> ASIR </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Boton para ir al menu de admin --}}
            <div id="admin">
                <img src="{{url('img/icons/admin.png')}}" alt="">
            </div>
        </div>
    </div>

    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function(){
            //Celia maps aparece
            $("#title").animate({
                opacity:1
                }, 600, function(){
                //El subtitulo aparece
                $("#subTitle").css({display:"block"});
                $("#subTitle").animate({
                    top:"0px",
                    opacity:"1",
                }, 500, function(){
                    //El subtitulo rebota
                    $("#subTitle").animate({
                        top:"-3px",
                    }, 200, function(){
                        //El boton aparece
                        $("#startButton").animate({
                            opacity:1,
                        }, function(){
                            //creditos de abajo aparecen
                            $("#bottom").fadeToggle();
                        });
                    });
                });
            });

            $("#admin").click(function(){
                window.location.href = "{{route("map.index")}}";
            });

            $(".devLink").click(function(e){
                e.preventDefault();

            });
        });
    </script>
</body>
</html>