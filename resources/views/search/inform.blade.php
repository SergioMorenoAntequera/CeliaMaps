<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <div class="container w-50 text-center text-dark">
        <div class="card">
            <div class="card-header">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">{{$street->type->name}} {{$street->name}}</h5>
                    </div>
                    <h6>Mapas</h6>
                    <ul class="list-group list-group-flush">
                        @if (!is_null($street->maps()))
                            @foreach ($street->maps as $map)
                                <li class="list-group-item">{{$map->title}} - {{$map->date}}</li>
                            @endforeach
                        @endif
                    </ul>
                  </div>
            </div>
        </div>
    </div>
    
            <!-- AQUÍ PONGO EL BOTÓN DE PDF -->
            <a href="{{route('pdf.download')}}">
                <button type="button" class="btn btn-primary">pdf</button>
                </a>
    
</body>
</html>
