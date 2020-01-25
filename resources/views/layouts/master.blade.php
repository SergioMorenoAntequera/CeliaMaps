<html>
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
                <img id="menuImg" src="{{url('img/icons/menuArrow.png')}}">
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
                    <div class="col-4">
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
                        </div>
                    </div>
                </div> 
            </div>
        </header>

        <!-- Content -->
        <div class="container-fluid">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer>
            @yield('footer')
        </footer>

    </body>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
    
    <!-- Optional views scripts -->
    @yield('scripts')

</html>
