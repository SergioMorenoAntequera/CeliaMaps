<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{--
	<title>{{ $metaData->pageTitle }}</title>
        <meta name="description" content=" {{ $metaData->description }} ">
        <meta name="keywords" content=" {{ $metaData->keywords }} ">
	--}}
	<title>@yield('title')</title>
        <!-- General CDNs -->
        <link rel="icon" type="image/png" href="{{url('/img/icons/icon.png')}}" sizes="64x64">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('/css/Backend.css')}}">
        <link rel="stylesheet" href="{{url('/css/BootstrapOverride.css')}}">
        <link rel="stylesheet" href="{{url('/css/streets.css')}}">
        <link rel="stylesheet" href="{{url('/css/Hotspots.css')}}">
        <!--  <link href="https://fonts.googleapis.com/css?family=Dancing+Script:500&display=swap" rel="stylesheet">   -->
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"> </script>
        <!-- Views CDNs -->
        @yield('cdn')
    </head>

    <body class="bg-dark">
        <!-- Header -->
        <!-- Plantilla de la pagina principal -->
        <div class="container-fluid">
            <div style="height: 100%" class="row">
                {{-- Columna de la izquierda --}}
                <div id="leftNavBar">
                    <ul id=lateralMenu class="list-unstyled">
                        {{-- Icono Celia  --}}
                        <div class="lateralMenuElement mb-4">
                            <a class="lateralMenuLink" href="{{route('map.map')}}">
                            <li id="celiaMapsIcon" class="lateralMenuImg my-3">
                                <img src="{{url('img/icons/icon.png')}}" alt="CeliaMaps" class="img-fluid">
                            </li>
                            </a>
                        </div>

                        {{-- Maps --}}
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
                                {{-- <a href="{{route('marker.admin')}}"><li>Marcadores</li></a> --}}
                            </div>
                        </div>

                        {{-- Streets --}}
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="{{route('street.index')}}">
                            <li class="lateralMenuImg">
                                <img src="{{url('img/icons/tlMenuStreetWhite.png')}}" alt="CeliaMaps" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Calles </b>
                                <div class="line"></div>
                                <a href="{{route('street.index')}}"><li>Índice</li></a>
                                <a href="{{route('street.admin')}}"><li>Administrar</li></a>
                                {{-- <a href="{{route('street.index')}}"><li>Modificar</li></a>
                                <a href="{{route('street.index')}}"><li>Elminar</li></a> --}}
                            </div>
                        </div>

                        {{-- Hotspots --}}
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="{{route('hotspot.index')}}">
                            <li class="lateralMenuImg">
                                <img src="{{url('img/icons/tlMenuTokenWhite.png')}}" alt="CeliaMaps" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Puntos de interés </b>
                                <div class="line"></div>
                                <a href="{{route('hotspot.index')}}"><li>Índice</li></a>
                                <a href="{{route('hotspot.create')}}"><li>Administrar</li></a>
                                <a href="{{route('hotspot.gallery')}}"><li>Galeria de Imagenes</li></a>
                                {{-- <a href="{{route('hotspot.index')}}"><li>Modificar</li></a>
                                <a href="{{route('hotspot.index')}}"><li>Elminar</li></a> --}}
                            </div>
                        </div>

                        {{-- Users --}}
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="{{route('user.index')}}">
                            <li class="lateralMenuImg">
                                <img src="{{url('img/icons/userWhite.png')}}" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Users </b>
                                <div class="line"></div>
                                @auth
                                     <!-- INCLUYO AQUÍ LA RUTA DEL LOGOUT DE LARAVEL PARA QUE NO PASE POR LA PÁGINA OFICIAL,
                                    SINO QUE VAYA DIRECTAMENTE A LA PÁGINA PRINCIPAL -->
                                    <a href=""
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><li>Logout</li></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                @else
                                    {{-- <a href="{{route('login')}}"><li>Login</li></a>                                 --}}
                                @endauth
                                <a href="{{route('user.index')}}"><li>Indice</li></a>
                                <a href="{{route('user.create')}}"><li>Insertar</li></a>
                            </div>
                        </div>

                        {{-- Database --}}
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="{{route('backup.index')}}">
                            <li class="lateralMenuImg">
                                <img src="{{url('img/icons/database.svg')}}" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Backup </b>
                                <div class="line"></div>
                                <a href="{{route('backup.index')}}"><li>Guardar/Restaurar</li></a>
                                {{--<a href="{{route('backup.restoreDir')}}"><li>imagen</li></a>
                                 <a href="{{route('backup.index')}}"><li>Guardar</li></a>
                                <a href="{{route('backup.index')}}"><li>Restaurar</li></a> --}}
                            </div>
                        </div>

                        {{-- PDF --}}
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="{{route('search.index')}}">
                            <li class="lateralMenuImg">
                                <img src="{{url('img/icons/report.svg')}}" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Informes </b>
                                <div class="line"></div>
                                <a href="{{route('search.index')}}"><li>Generar informe</li></a>
                                <a href="{{route('organization.index')}}"><li>Administrar cabeceras</li></a>
                            </div>
                        </div>

                        {{-- Settings --}}
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" selector="settings" href="{{route('setting.index')}}">
                            <li class="lateralMenuImg">
                                <img src="{{url('img/icons/settings.svg')}}" alt="CeliaMaps" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Ajustes </b>
                                <div class="line"></div>
                                <a href="{{route('setting.home')}}"><li> General </li></a>
                                <a href="{{route('setting.mainView')}}"><li> Vista principal </li></a>
                                <a href="{{route('marker.admin')}}"><li>Marcadores</li></a>
                            </div>
                        </div>
                    </ul>
                    <script>
                        $(document).ready(function(){
                            var element;
                            if(window.location.href.includes("/map")){
                                element = $(".lateralMenuLink[href|='{{route('map.index')}}']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/street")){
                                element = $(".lateralMenuLink[href|='{{route('street.index')}}']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/hotspot")){
                                element = $(".lateralMenuLink[href|='{{route('hotspot.index')}}']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/user")){
                                element = $(".lateralMenuLink[href|='{{route('user.index')}}']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/login")){
                                element = $(".lateralMenuLink[href|='{{route('user.index')}}']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/backup")){
                                element = $(".lateralMenuLink[href|='{{route('backup.index')}}']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/search")){
                                element = $(".lateralMenuLink[href|='{{route('search.index')}}']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/organization")){
                                element = $(".lateralMenuLink[href|='{{route('organization.index')}}']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/setting") || window.location.href.includes("/marker")){
                                element = $(".lateralMenuLink[selector|=settings]").parents(".lateralMenuElement");
                            }
                            element.css("background-color", "#6f7e96")

                            $(".lateralMenuElement").hover(function(e){
                                var top = $(this).position().top;
                                var expandMenu = $(this).children(".lateralExpandMenu");

                                //La parida esta es para que salga centrada
                                expandMenu.css("top", top - expandMenu.height()/2 + $(this).height()/2);
                                expandMenu.show();
                                //Animaction
                                // expandMenu.animate({"left": "100%"}, 150);

                            }, function(e){
                                var expandMenu = $(this).children(".lateralExpandMenu");
                                // expandMenu.animate({"left": "-200px"}, 150);
                                expandMenu.hide();
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
                    <a href="{{route('home')}}">
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
                        {{-- <div class="container-fluid bg-danger">
                            @yield('footer')
                        </div> --}}
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

    <!-- Check authentication -->

    @isset($guest)
        @if($guest)
            <script>
                $("#leftNavBar").hide();
                $("#rightContent").css("margin-left","0");
                $("#rightContent").css("width","100%");
            </script>
        @endif
    @endisset


</html>
