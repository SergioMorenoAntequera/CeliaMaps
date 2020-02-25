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
            'file_name' => 'catedral-almeria-img-01',
            'file_path' => 'img/hotspots',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Catedral de Almeria',
            'description' => '',
            'file_name' => 'catedral-almeria-img-02',
            'file_path' => 'img/hotspots',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Catedral de Almeria',
            'description' => '',
            'file_name' => 'catedral-almeria-img-03',
            'file_path' => 'img/hotspots',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Plaza Vieja',
            'description' => '',
            'file_name' => 'plaza-vieja-img-01',
            'file_path' => 'img/hotspots',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Plaza Vieja',
            'description' => '',
            'file_name' => 'plaza-vieja-img-02',
            'file_path' => 'img/hotspots',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Plaza Vieja',
            'description' => '',
            'file_name' => 'plaza-vieja-img-03',
            'file_path' => 'img/hotspots',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Puerta Purchena',
            'description' => '',
            'file_name' => 'puerta-purchena-img-01',
            'file_path' => 'img/hotspots',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Puerta Purchena',
            'description' => '',
            'file_name' => 'puerta-purchena-img-02',
            'file_path' => 'img/hotspots',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Puerta Purchena',
            'description' => '',
            'file_name' => 'puerta-purchena-img-03',
            'file_path' => 'img/hotspots',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('images')->insert([    
            
            'title' => 'Puerta Purchena',
            'description' => '',
            'file_name' => 'puerta-purchena-img-04',
            'file_path' => 'img/hotspots',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
