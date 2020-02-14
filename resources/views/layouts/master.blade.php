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
        {{-- <header>
            <div id="navBar" class="container">
                <div id="fallingMenu" style="background-image: url({{url('img/resources/FallingMenuBackground.png')}})">
                    <div id="fallingMenuContent">
                        <a class="text-reset text-decoration-none" href="{{route('map.map')}}">FRONTEND</a>
                        <br>
                        <a class="text-reset text-decoration-none" href="{{route('hotspot.index')}}">HOTSPOTS</a>
                        <a class="text-reset text-decoration-none" >IMÁGENES</a>
                        <a class="text-reset text-decoration-none" href="{{route('map.index')}}">MAPAS</a>
                        <a class="text-reset text-decoration-none" >PUNTOS</a>
                        <a class="text-reset text-decoration-none" href="{{route('user.index')}}">USUARIOS</a>
                        <a class="text-reset text-decoration-none" href="{{route('street.index')}}">CALLES</a>
                    </div>
                </div>
                <!-- La imagen que está en el centro -->
                <a>
                <img id="menuImg" src="{{url('img/icons/menuArrow.png')}}">
                </a>
                <script>
                    $(document).ready(function(){
                        $("#menuImg").on("click", function(e){
                            e.preventDefault();
                            console.log($("#fallingMenu"));

                            if(parseInt($("#fallingMenu").css("top").replace("px")) < 0) {
                                $("#fallingMenu").animate({
                                    top: 20
                                }, 200, function() {
                                    $("#fallingMenu").animate({
                                        top: 0,
                                    }, 75);
                                });
                            } else {
                                $("#fallingMenu").animate({
                                    top: -$(window).height(),
                                }, 200);
                            }
                        });
                    });
                    
                </script>

                <!-- Fila que tiene el resto del menú -->
                <div class="row align-items-start text-center font-weight-bold">
                    <!-- Parte de la izquierda -->
                    <div class="offset-1 col-4">
                        <div class="row mt-4">                           
                            <div class="col headerLink">                                
                                <a class="text-reset text-decoration-none" href="{{route('hotspot.index')}}">HOTSPOTS</a>
                            </div>                            
                            <div class="col headerLink">
                                <a class="text-reset text-decoration-none" href="">IMÁGENES</a>
                            </div>
                            <div class="col headerLink">
                                <a class="text-reset text-decoration-none" href="{{route('map.index')}}">MAPAS</a> 
                            </div>
                        </div>
                    </div>
                    <div class="offset-2"></div>
                    <!-- Parte de la derecha --> 
                    <div class="col-5">   <!-- HE CAMBIADO EL NÚMERO DE COLUMNAS DE 4 A 5 PARA METER TEMPORALMENTE EL LOGIN -->
                        <div class="row mt-4">
                            <div class="col headerLink">
                                <a class="text-reset text-decoration-none">PUNTOS</a>
                            </div>
                            <div class="col headerLink">
                                <a class="text-reset text-decoration-none" href="{{route('street.index')}}">CALLES</a>
                            </div>
                            <div class="col headerLink">
                                <a class="text-reset text-decoration-none" href="{{route('user.index')}}">USUARIOS</a>
                            </div>                           
                            @auth
                            <div class="col headerLink">
                                 <!-- INCLUYO AQUÍ LA RUTA DEL LOGOUT DE LARAVEL PARA QUE NO PASE POR LA PÁGINA OFICIAL,
                                SINO QUE VAYA DIRECTAMENTE A LA PÁGINA PRINCIPAL --> 
                                <a class="text-reset text-decoration-none" href=""
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">LOGOUT</a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @else 
                            <div class="col headerLink">
                                <a class="text-reset text-decoration-none" href="{{route('login')}}">LOGIN</a>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div> 
            </div>
        </header> --}}
        <!-- Plantilla de la pagina principal -->
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
                                <a href="{{route('backup.create')}}"><li>Insertar</li></a>
                                <a href="{{route('backup.index')}}"><li>Modificar</li></a>
                                <a href="{{route('backup.index')}}"><li>Elminar</li></a>
                            </div>
                        </div>
                    </ul>
                    <script>
                        $(document).ready(function(){
                            $(".lateralMenuElement").hover(function(e){
                                var top = $(this).position().top;
                                var expandMenu = $(this).children(".lateralExpandMenu");
                                //La parida esta es para que salga centrada
                                expandMenu.css("top", top + $(this).height()/2 - expandMenu.height()/2);
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
                        @yield('footer')
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
