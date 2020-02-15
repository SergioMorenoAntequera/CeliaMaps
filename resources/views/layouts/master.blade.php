<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title')</title>
        
        <!-- General CDNs -->
        <link rel="icon" type="image/png" href="{{url('/img/icons/icon.png')}}" sizes="64x64">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('/css/Backend.css')}}">
        <link rel="stylesheet" href="{{url('/css/BootstrapOverride.css')}}">
        <link rel="stylesheet" href="{{url('/css/Global.css')}}">
        <link rel="stylesheet" href="{{url('/css/streets.css')}}">
        <link rel="stylesheet" href="{{url('/css/Hotspots.css')}}">
        {{-- <link rel="stylesheet" href="{{url('/css/NavBar.css')}}"> --}}
        <!--  <link href="https://fonts.googleapis.com/css?family=Dancing+Script:500&display=swap" rel="stylesheet">   -->
        <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous">
        </script>
        <!-- Views CDNs -->
        @yield('cdn')
    </head>
    
    <body class="bg-dark">
        <!-- Header -->
        <!-- Plantilla de la pagina principal -->
        <div style="background-image: url({{url("img/resources/FallingMenuBackground.png")}})" id="flotingMenu"> 
            <span>Me llamaban feo, <br> ahora no pueden dejar de mirarme</span>
        </div>
        <div class="container-fluid">
            <div style="height: 100%" class="row">
                {{-- Columna de la izquierda --}}
                <div id="leftNavBar">
                    <ul id=lateralMenu class="list-unstyled">
                        <div class="lateralMenuElement mb-4">
                            <a class="lateralMenuLink" href="{{route('map.map')}}">
                            <li id="celiaMapsIcon" class="lateralMenuImg my-3">
                                <img src="{{url('img/icons/icon.png')}}" alt="CeliaMaps" class="img-fluid">
                            </li>
                            </a>
                        </div>
                        
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="{{route('map.index')}}">
                            <li class="lateralMenuImg">
                                <img src="{{url('img/icons/tlMenuMapWhite.png')}}" alt="CeliaMaps" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Mapas </b>
                                <div class="line"></div>
                                <a href="{{route('map.index')}}"><li>Indice</li></a>
                                <a href="{{route('map.create')}}"><li>Insertar</li></a>
                                <a href="{{route('map.index')}}"><li>Modificar</li></a>
                                <a href="{{route('map.index')}}"><li>Elminar</li></a>
                                <a href="{{route('map.index')}}"><li>Ordenar</li></a>
                                <a href="{{route('map.index')}}"><li>Alinear</li></a>
                            </div>
                        </div>
                        
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="{{route('street.index')}}">
                            <li class="lateralMenuImg">
                                <img src="{{url('img/icons/tlMenuStreetWhite.png')}}" alt="CeliaMaps" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Calles </b>
                                <div class="line"></div>
                                <a href="{{route('street.index')}}"><li>Indice</li></a>
                                <a href="{{route('street.create')}}"><li>Insertar</li></a>
                                <a href="{{route('street.index')}}"><li>Modificar</li></a>
                                <a href="{{route('street.index')}}"><li>Elminar</li></a>
                            </div>
                        </div>

                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="{{route('hotspot.index')}}">
                            <li class="lateralMenuImg">
                                <img src="{{url('img/icons/tlMenuTokenWhite.png')}}" alt="CeliaMaps" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Puntos de interés </b>
                                <div class="line"></div>
                                <a href="{{route('hotspot.index')}}"><li>Indice</li></a>
                                <a href="{{route('hotspot.create')}}"><li>Insertar</li></a>
                                <a href="{{route('hotspot.index')}}"><li>Modificar</li></a>
                                <a href="{{route('hotspot.index')}}"><li>Elminar</li></a>
                            </div>
                        </div>

                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="{{route('user.index')}}">
                            <li class="lateralMenuImg">
                                <img src="{{url('img/icons/userWhite.png')}}" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Users </b>
                                <div class="line"></div>
                                <a href="{{route('user.index')}}"><li>Indice</li></a>
                                <a href="{{route('user.create')}}"><li>Insertar</li></a>
                                <a href="{{route('user.index')}}"><li>Modificar</li></a>
                                <a href="{{route('user.index')}}"><li>Elminar</li></a>
                            </div>
                        </div>

                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="{{route('backup.index')}}">
                            <li class="lateralMenuImg">
                                <img src="{{url('img/icons/database.svg')}}" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Backup </b>
                                <div class="line"></div>
                                <a href="{{route('backup.index')}}"><li>Indice</li></a>
                                <a href="{{route('backup.index')}}"><li>Insertar</li></a>
                                <a href="{{route('backup.index')}}"><li>Modificar</li></a>
                                <a href="{{route('backup.index')}}"><li>Elminar</li></a>
                            </div>
                        </div>

                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="">
                            <li class="lateralMenuImg">
                                <img src="{{url('img/icons/report.svg')}}" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Reporte </b>
                                <div class="line"></div>
                                <a href=""><li>No sé</li></a>
                                <a href=""><li>Que Poner</li></a>
                                <a href=""><li>Aquí</li></a>
                                <a href=""><li>jeje</li></a>
                            </div>
                        </div>
                    </ul>
                    <script>
                        $(document).ready(function(){
                            $(".lateralMenuElement").hover(function(e){
                                var top = $(this).position().top;
                                var expandMenu = $(this).children(".lateralExpandMenu");
                                //La parida esta es para que salga centrada
                                expandMenu.css("top", top - expandMenu.height()/2 + $(this).height()/2);
                                expandMenu.show();
                            }, function(e){
                                $(this).children(".lateralExpandMenu").hide();
                            });
                            $(".lateralExpandMenu").hover(function(e){
                                console.log("PRA");
                                $(this).parents(".lateralMenuElement").css("background-color", "#6f7e96");
                            }, function(e) {
                                $(this).parents(".lateralMenuElement").css("background-color", "#283e65");
                            });
                        });
                    </script>

                    {{-- div ausiliar para que todo sea responsivo --}}
                    <div id="notocar" style="position: absolute; bottom: 10%" class="lateralMenuImg">
                        <img src="{{url('img/icons/rip.svg')}}" class="img-fluid">
                    </div>
                    <script>
                        $(document).ready(function(){
                            $("#flotingMenu").css("top", -$("#flotingMenu").height());
                            $("#notocar").on("click", function(){
                                $("#flotingMenu").show()
                                $("#flotingMenu").animate({
                                    top: "20px",
                                }, 200, function(e){
                                    $("#flotingMenu").animate({
                                        top: "0px",
                                    }, 200);
                                });
                            });
                        });
                    </script>
                    <a href="{{route('map.map')}}">
                        <div style="position: absolute; bottom: 0px" class="lateralMenuImg">
                            <img src="{{url('img/icons/turnOff.svg')}}" class="img-fluid">
                        </div>
                    </a>

                </div>

                {{-- Columna de la derecha con el contenido --}}
                <div id="rightContent">
                    @yield('content')
                    <!-- Footer -->
                    <footer>
                        <div class="container-fluid">
                            @yield('footer')    
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </body>

    <!-- Scripts -->
   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Optional views scripts -->
    @yield('scripts')
   
</html>
