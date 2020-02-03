<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title')</title>
        
        <!--CDN-->

        <link rel="icon" type="image/png" href="{{url('/img/icons/icon.png')}}" sizes="64x64">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('/css/Backend.css')}}">
        <link rel="stylesheet" href="{{url('/css/BootstrapOverride.css')}}">
        <link rel="stylesheet" href="{{url('/css/Global.css')}}">
        <link rel="stylesheet" href="{{url('/css/streets.css')}}">
        <link rel="stylesheet" href="{{url('/css/Hotspots.css')}}">
        <link rel="stylesheet" href="{{url('/css/NavBar.css')}}">
        <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous">
        </script>
    </head>
    
    <body class="bg-dark text-white">
        
        <!-- Header -->
        <header>
            <div id="navBar" class="container">
                <!-- La imagen que está en el centro -->
                <a href="{{route('map.map')}}">
                <img id="menuImg" src="{{url('img/icons/menuArrow.png')}}">
                </a>
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
                                <a class="text-reset text-decoration-none" href="{{route('point.index')}}">PUNTOS</a>
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
        </header>
<body>
    
    <div id="app">
        

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
