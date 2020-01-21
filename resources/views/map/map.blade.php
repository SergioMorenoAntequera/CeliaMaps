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
        @foreach ($maps as $map)
            <div id="mapTrans{{$map->id}}" class="mapTrans">
                <!-- The eye and the slider -->
                <i class="eye fa fa-eye fa-2x"></i> <h2>{{$map->title}}</h2>
                <br>
                <!-- same line -->
                <input type="range" min="1" max="100" value="50" class="slider" id="transparency{{$map->id}}">
                <span> 50 </span>
            </div>
        @endforeach
    </div>

    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script>
    var map = L.map('mapid').setView([36.844092, -2.457840], 14);
    
    // Pagina donde están los proveedores de mapas:
    // http://leaflet-extras.github.io/leaflet-providers/preview/index.html
    var CyclOSM = L.tileLayer('https://dev.{s}.tile.openstreetmap.fr/cyclosm/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '<a href="https://github.com/cyclosm/cyclosm-cartocss-style/releases" title="CyclOSM - Open Bicycle render">CyclOSM</a> | Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    CyclOSM.addTo(map);

    $(document).ready(function(){
        $('#mapsMenu').slideToggle(200);
        
        //Eye to enable disable tranparencies
        $('.eye').click(function() {
            if($(this).hasClass("fa-eye")){
                $(this).removeClass("fa-eye");
                $(this).parent().animate({
                    opacity: 0.50,
                }, 100);
                $(this).addClass("fa-eye-slash");
                console.log($(this).parent().find("input").attr("disable", true));
            } else {
                $(this).removeClass("fa-eye-slash");
                $(this).addClass("fa-eye");
                $(this).parent().animate({ 
                    opacity: 1,
                }, 100);
            }
        });

        //Slider and how it affects the maps
        $('.slider').change(function(){
            $(this).parent().find("span").text($(this).val());
        });
    });

    </script>

</body>
</html>