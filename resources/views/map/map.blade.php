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
    <!-- PERSONAL CSS -->
    <link rel="stylesheet" href="{{url('/css/Frontend.css')}}">
</head>
<body>
    <div id="mapid"></div>

    <div id="mapsMenu">
        @foreach ($maps as $map)
            <div id="mapTrans{{$map->id}}" class="mapTrans">
                <h3>{{$map->title}}</h3>
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

    
    </script>

</body>
</html>