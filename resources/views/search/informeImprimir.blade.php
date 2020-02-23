     
     <!DOCTYPE html>
     <html lang="en">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

         <title>Document</title>
     </head>
     <body>
         <div class="container" >
            
            <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Impresión de Informes</h4>
                    <div>
                        {{$street->type->name }} {{$street->name}}
                    </div>
                   
                    <div>
                        @foreach($street->maps as $map)
                        <div>
                            <h5>Se encuentra en el mapa:</h5>
                        </div> 
                        <div>
                            {{$map->title}}
                        </div> 
                        <div>
                            <h5>Descripción del mapa</h5>
                        </div> 
                        <div>
                            {{$map->description}}
                        </div> 
                          <img src="/img/maps/{{$map->image}}" alt="...">
                        @endforeach
                    </div>

                </div>                
              </div>
                 

         </div>
     </body>
     </html>
       

    