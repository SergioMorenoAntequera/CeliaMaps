<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->truncate();
        DB::table('images')->insert([    
            
            'title' => 'Catedral de Almeria',
            'description' => '',
            'file_name' => 'catedral-almeria-img-01.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 1,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Catedral de Almeria',
            'description' => '',
            'file_name' => 'catedral-almeria-img-02.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 1,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Catedral de Almeria',
            'description' => '',
            'file_name' => 'catedral-almeria-img-03.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 1,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Plaza Vieja',
            'description' => '',
            'file_name' => 'plaza-vieja-img-01.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 5,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Plaza Vieja',
            'description' => '',
            'file_name' => 'plaza-vieja-img-02.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 5,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Plaza Vieja',
            'description' => '',
            'file_name' => 'plaza-vieja-img-03.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 5,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Puerta Purchena',
            'description' => '',
            'file_name' => 'puerta-purchena-img-04-en-la-actualidad.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 5,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Puerta Purchena',
            'description' => '',
            'file_name' => 'puerta-purchena-img-02.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 6,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Puerta Purchena',
            'description' => '',
            'file_name' => 'puerta-purchena-img-03.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 6,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Puerta Purchena',
            'description' => '',
            'file_name' => 'puerta-purchena-img-03.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 6,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Estadio de los juegos Mediterraneos',
            'description' => '',
            'file_name' => 'estadio-juegos-mediterraneos-img-01.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 7,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Alcazaba',
            'description' => '',
            'file_name' => 'alcazaba-almeria-img-01.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 2,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Mercado Central',
            'description' => '',
            'file_name' => 'mercado-central-img-01.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 3,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Refugios de la Guerra Civil',
            'description' => '',
            'file_name' => 'refugios-guerra-civil-img-01.jpg',
            'file_path' => 'img/hotspots',
            'hotspot_id' => 4,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
