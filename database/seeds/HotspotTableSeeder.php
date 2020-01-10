<?php

use Illuminate\Database\Seeder;

class HotspotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotspots')->truncate();
        DB::table('hotspots')->insert([    
            //La id no se pone porque se autoincrementa sola
            'image' => 'catedralAlmeria.png',
            'title' => 'Catedral',
            'description' => 'CAtedral de la ciudad de Almeria',
            'point_x' => 100,
            'point_y' => 150,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            //La id no se pone porque se autoincrementa sola
            'image' => 'Alcazaba.png',
            'title' => 'Alcazaba',
            'description' => 'Alcazaba de la ciudad de Almeria',
            'point_x' => 50,
            'point_y' => 190,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            //La id no se pone porque se autoincrementa sola
            'image' => 'mercadoCentral.png',
            'title' => 'Mercado Central',
            'description' => 'Mercado del paseo',
            'point_x' => 500,
            'point_y' => 63,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            //La id no se pone porque se autoincrementa sola
            'image' => 'REfugios.png',
            'title' => 'Refugios WW2',
            'description' => 'Refugios de la segunda guerra mundial',
            'point_x' => 100,
            'point_y' => 150,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            //La id no se pone porque se autoincrementa sola
            'image' => 'minihollywood.png',
            'title' => 'Minihollywood',
            'description' => 'Atracción del oeste y zoo para toda la familia',
            'point_x' => 10,
            'point_y' => 500,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
