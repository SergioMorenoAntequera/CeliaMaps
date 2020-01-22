<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Celia Maps</title>

    <!-- LEAFLET -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
    <script src="{{url('/js/leaflet-providers.js')}}"></script> 
    <!-- BOOTSTRAP 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    -->
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- PERSONAL CSS -->
    <link rel="stylesheet" href="{{url('/css/Frontend.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    <div id="mapid"></div>

    <div id="mapsMenu">
        <div id="mapsTrans">
            <h1> <b>Mapas:</b></h1>
            @foreach ($maps as $map)
                <div id="mapTrans{{$map->id}}" class="mapTrans">
                    <!-- The eye and thr title -->
                    <div class="contEye">
                        <i class="eye fa fa-eye fa-2x"></i><h2 class="title">{{$map->title}}</h2>
                    </div>
                    <!-- The slider and the -->
                    <div class="contSlider">
                        <input type="range" min="0" max="100" value="50" class="slider" id="transparency{{$map->id}}">
                        <span class="opacity">50</span>
                    </div>
                </div>
            @endforeach
            <div>
                <button> Mostrar todos </button>
                <button> Quitar todos</button>
            </div>  
        </div>
        
        <br>
        <div id="mapsShow">
            <i class="fa fa-chevron-up"></i>
        </div>
    </div>


    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script>
    var map = L.map('mapid', {
        minZoom: 10,
        maxZoom: 20
    });

    map.setView([36.844092, -2.457840], 14);
    
    
    // Pagina donde están los proveedores de mapas:
    // http://leaflet-extras.github.io/leaflet-providers/preview/index.html
    var Stamen_Toner = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner/{z}/{x}/{y}{r}.{ext}', {
        attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        subdomains: 'abcd',
        minZoom: 0,
        maxZoom: 20,
        ext: 'png'
    });
    var Stamen_TonerLite = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-lite/{z}/{x}/{y}{r}.{ext}', {
        attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        subdomains: 'abcd',
        minZoom: 0,
        maxZoom: 20,
        ext: 'png'
    });
    
    Stamen_TonerLite.addTo(map);



    $(document).ready(function(){
        $('#mapsMenu').slideToggle(300);
        
        //Eye to enable disable tranparencies
        $('.contEye').click(function(){
            swapShowMenu($(this));
        });

        //Slider and how it affects the maps
        $('.slider').change(function(){
            $(this).parent().find(".opacity").text($(this).val());        
        });

        $('#mapsShow').click(function(){

            var icono = $(this).find('i');

            if(icono.hasClass('fa-chevron-up')){
                $(this).siblings().slideUp(300);
                icono.removeClass('fa-chevron-up');
                icono.addClass('fa-chevron-down');
            } else {
                $(this).siblings().slideDown(300);
                icono.removeClass('fa-chevron-down');
                icono.addClass('fa-chevron-up');
            }
            
        });

        //////////////////////////////////////////////////////////////////////////////////////////
        // AUXILIAR METHODS //////////////////////////////////////////////////////////////////////

        // SWAP BETWEEN EYES MODES //////////////////////////////////////////////////////////////
        function swapShowMenu(eyeContainer){

            var eye = jQuery(eyeContainer.find(".eye"));

            if(eye.hasClass("fa-eye")){
                enable(eyeContainer, eye);
            } else {
                disable(eyeContainer, eye);
            }
        }

        // ENABLE  //////////////////////////////////////////////////////////////////////////////
        function enable(eyeContainer, eye){
            eye.removeClass("fa-eye");
            eye.parent().animate({
                opacity: 0.50,
            }, 100);
            eye.addClass("fa-eye-slash");
            eyeContainer.find("input").attr("disabled", true);
            eyeContainer.siblings('.contSlider').slideUp(200, function(){
                eyeContainer.siblings().find('.opacity').text(0);
            });
        }

        // DISABLE /////////////////////////////////////////////////////////////////////////////
        function disable(eyeContainer, eye){
            eye.removeClass("fa-eye-slash");
            var valueOpacity = eyeContainer.siblings().find('.slider').val();
            eyeContainer.siblings().find('.opacity').text(valueOpacity);
            eyeContainer.animate({ 
                opacity: 1,
            }, 100);
            eye.addClass("fa-eye");
            eyeContainer.find(".opacity").attr("disabled", false);
            eyeContainer.siblings('.contSlider').slideDown(200);
        }
    });

    </script>

</body>
</html>