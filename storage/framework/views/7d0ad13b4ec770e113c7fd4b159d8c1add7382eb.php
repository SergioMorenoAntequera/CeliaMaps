<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $__env->yieldContent('title'); ?></title>

        <!-- General CDNs -->
        <link rel="icon" type="image/png" href="<?php echo e(url('/img/icons/icon.png')); ?>" sizes="64x64">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo e(url('/css/Backend.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('/css/BootstrapOverride.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('/css/streets.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('/css/Hotspots.css')); ?>">
        <!--  <link href="https://fonts.googleapis.com/css?family=Dancing+Script:500&display=swap" rel="stylesheet">   -->
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"> </script>
        <!-- Views CDNs -->
        <?php echo $__env->yieldContent('cdn'); ?>
    </head>

    <body class="bg-dark">
        <!-- Header -->
        <!-- Plantilla de la pagina principal -->
        <div class="container-fluid">
            <div style="height: 100%" class="row">
                
                <div id="leftNavBar">
                    <ul id=lateralMenu class="list-unstyled">
                        
                        <div class="lateralMenuElement mb-4">
                            <a class="lateralMenuLink" href="<?php echo e(route('map.map')); ?>">
                            <li id="celiaMapsIcon" class="lateralMenuImg my-3">
                                <img src="<?php echo e(url('img/icons/icon.png')); ?>" alt="CeliaMaps" class="img-fluid">
                            </li>
                            </a>
                        </div>

                        
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="<?php echo e(route('map.index')); ?>">
                            <li class="lateralMenuImg">
                                <img src="<?php echo e(url('img/icons/tlMenuMapWhite.png')); ?>" alt="CeliaMaps" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Mapas </b>
                                <div class="line"></div>
                                <a href="<?php echo e(route('map.index')); ?>"><li>Indice</li></a>
                                <a href="<?php echo e(route('map.create')); ?>"><li>Insertar</li></a>
                                
                            </div>
                        </div>

                        
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="<?php echo e(route('street.index')); ?>">
                            <li class="lateralMenuImg">
                                <img src="<?php echo e(url('img/icons/tlMenuStreetWhite.png')); ?>" alt="CeliaMaps" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Calles </b>
                                <div class="line"></div>
                                <a href="<?php echo e(route('street.index')); ?>"><li>Índice</li></a>
                                <a href="<?php echo e(route('street.admin')); ?>"><li>Administrar</li></a>
                                
                            </div>
                        </div>

                        
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="<?php echo e(route('hotspot.index')); ?>">
                            <li class="lateralMenuImg">
                                <img src="<?php echo e(url('img/icons/tlMenuTokenWhite.png')); ?>" alt="CeliaMaps" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Puntos de interés </b>
                                <div class="line"></div>
                                <a href="<?php echo e(route('hotspot.index')); ?>"><li>Índice</li></a>
                                <a href="<?php echo e(route('hotspot.create')); ?>"><li>Administrar</li></a>
                                <a href="<?php echo e(route('hotspot.gallery')); ?>"><li>Galeria de Imagenes</li></a>
                                
                            </div>
                        </div>

                        
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="<?php echo e(route('user.index')); ?>">
                            <li class="lateralMenuImg">
                                <img src="<?php echo e(url('img/icons/userWhite.png')); ?>" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Users </b>
                                <div class="line"></div>
                                <?php if(auth()->guard()->check()): ?>
                                     <!-- INCLUYO AQUÍ LA RUTA DEL LOGOUT DE LARAVEL PARA QUE NO PASE POR LA PÁGINA OFICIAL,
                                    SINO QUE VAYA DIRECTAMENTE A LA PÁGINA PRINCIPAL -->
                                    <a href=""
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><li>Logout</li></a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                                <?php else: ?>
                                    
                                <?php endif; ?>
                                <a href="<?php echo e(route('user.index')); ?>"><li>Indice</li></a>
                                <a href="<?php echo e(route('user.create')); ?>"><li>Insertar</li></a>
                            </div>
                        </div>

                        
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="<?php echo e(route('backup.index')); ?>">
                            <li class="lateralMenuImg">
                                <img src="<?php echo e(url('img/icons/database.svg')); ?>" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Backup </b>
                                <div class="line"></div>
                                <a href="<?php echo e(route('backup.index')); ?>"><li>Índice</li></a>
                                
                            </div>
                        </div>

                        
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" href="<?php echo e(route('search.index')); ?>">
                            <li class="lateralMenuImg">
                                <img src="<?php echo e(url('img/icons/report.svg')); ?>" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Informes </b>
                                <div class="line"></div>
                                <a href="<?php echo e(route('search.index')); ?>"><li>Generar informe</li></a>
                            </div>
                        </div>

                        
                        <div class="lateralMenuElement">
                            <a class="lateralMenuLink" selector="settings" href="<?php echo e(route('setting.index')); ?>">
                            <li class="lateralMenuImg">
                                <img src="<?php echo e(url('img/icons/settings.svg')); ?>" alt="CeliaMaps" class="img-fluid">
                            </li>
                            </a>
                            <div class="lateralExpandMenu">
                                <b> Ajustes </b>
                                <div class="line"></div>
                                <a href="<?php echo e(route('setting.mainView')); ?>"><li> Vista principal </li></a>
                                <a href="<?php echo e(route('marker.admin')); ?>"><li>Marcadores</li></a>
                            </div>
                        </div>
                    </ul>
                    <script>
                        $(document).ready(function(){
                            var element;
                            if(window.location.href.includes("/map")){
                                element = $(".lateralMenuLink[href|='<?php echo e(route('map.index')); ?>']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/street")){
                                element = $(".lateralMenuLink[href|='<?php echo e(route('street.index')); ?>']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/hotspot")){
                                element = $(".lateralMenuLink[href|='<?php echo e(route('hotspot.index')); ?>']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/user")){
                                element = $(".lateralMenuLink[href|='<?php echo e(route('user.index')); ?>']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/login")){
                                element = $(".lateralMenuLink[href|='<?php echo e(route('user.index')); ?>']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/backup")){
                                element = $(".lateralMenuLink[href|='<?php echo e(route('backup.index')); ?>']").parents(".lateralMenuElement");
                            } else if(window.location.href.includes("/search")){
                                element = $(".lateralMenuLink[href|='<?php echo e(route('search.index')); ?>']").parents(".lateralMenuElement");
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

                    
                    <div id="notocar" style="position: absolute; bottom: 10%" class="lateralMenuImg">
                        <img src="<?php echo e(url('img/icons/rip.svg')); ?>" class="img-fluid">
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
                    <a href="<?php echo e(route('home')); ?>">
                        <div style="position: absolute; bottom: 0px" class="lateralMenuImg">
                            <img src="<?php echo e(url('img/icons/turnOff.svg')); ?>" class="img-fluid">
                        </div>
                    </a>

                </div>

                
                <div id="rightContent">
                    <?php echo $__env->yieldContent('content'); ?>
                    <!-- Footer -->
                    <footer>
                        
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
    <?php echo $__env->yieldContent('scripts'); ?>

</html>
<?php /**PATH /app/resources/views/layouts/master.blade.php ENDPATH**/ ?>