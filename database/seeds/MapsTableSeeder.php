<?php

use Illuminate\Database\Seeder;

class MapsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maps')->truncate();
        DB::table('maps')->insert([    
            //La id no se pone porque se autoincrementa sola
            'title' => 'Almería XXI',
            'description' => 'Mapa de la ciudad de Almeria en el siglo XXI',
            'city' => 'Almería',
            'date' => '2012',
            'image' => 'Almeria2012.png',
            'level' => '1',
            'width' => '900',
            'height' => '400',
            'deviation_x' => '40',
            'deviation_y' => '40',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('maps')->insert([    
            //La id no se pone porque se autoincrementa sola
            'title' => 'Huercal XXI',
            'description' => 'Mapa de la ciudad de Huercal en el siglo XXI',
            'city' => 'Huercal',
            'date' => '2019',
            'image' => 'Huercal2019.png',
            'level' => '1',
            'width' => '1080',
            'height' => '720',
            'deviation_x' => '90',
            'deviation_y' => '110',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('maps')->insert([    
            //La id no se pone porque se autoincrementa sola
            'title' => 'Almería XX',
            'description' => 'Mapa de la ciudad de Almeria en el siglo XX',
            'city' => 'Almería',
            'date' => '1990',
            'image' => 'Almeria1990.png',
            'level' => '2',
            'width' => '400',
            'height' => '200',
            'deviation_x' => '56',
            'deviation_y' => '100',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('maps')->insert([    
            //La id no se pone porque se autoincrementa sola
            'title' => 'Aguadulce XXI',
            'description' => 'Mapa de la ciudad de Aguadulce en el siglo XXI',
            'city' => 'Aguadulce',
            'date' => '2000',
            'image' => 'Aguadulce2000.png',
            'level' => '2',
            'width' => '1080',
            'height' => '720',
            'deviation_x' => '90',
            'deviation_y' => '10',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}