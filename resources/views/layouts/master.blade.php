<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title')</title>
        
        <!--CDN-->
        <link rel="icon" type="image/png" href="{{url('/img/icons/icon.png')}}" sizes="64x64">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('/css/Backend.css')}}">
        <link rel="stylesheet" href="{{url('/css/BootstrapOverride.css')}}">
        <link rel="stylesheet" href="{{url('/css/Global.css')}}">
        <link rel="stylesheet" href="{{url('/css/Hotspots.css')}}">
    </head>
    
    <body class="bg-dark text-white">
        
        <!-- Header -->
        <header>
            @yield('header')
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
