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
            'image' => 'mapa1.jpg',
            'miniature' => 'MiniatureAlmeria2012.png',
            'level' => '1',
            'width' => '900',
            'height' => '400',
            'tlCornerLatitude' => '36.85510654769295',
            'tlCornerLongitude' => '-2.471580505371094',
            'trCornerLatitude' => '36.85297750491024',
            'trCornerLongitude' => '-2.423171997070313',
            'blCornerLatitude' => '36.83559955190906',
            'blCornerLongitude' => '-2.4795627593994145',
            'brCornerLatitude' => '36.82460750365017',
            'brCornerLongitude' => '-2.4444580078125004',
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
            'miniature' => 'MiniatureHuercal2019.png',
            'level' => '2',
            'width' => '1080',
            'height' => '720',
            'tlCornerLatitude' => '36.8963707853478',
            'tlCornerLongitude' => '-2.4884033203125004',
            'trCornerLatitude' => '36.8963707853478',
            'trCornerLongitude' => '-2.4884033203125004',
            'blCornerLatitude' => '36.8963707853478',
            'blCornerLongitude' => '-2.4884033203125004',
            'brCornerLatitude' => '36.8963707853478',
            'brCornerLongitude' => '-2.4884033203125004',
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
            'miniature' => 'MiniatureAlmeria1990.png',
            'level' => '3',
            'width' => '400',
            'height' => '200',
            'tlCornerLatitude' => '36.8963707853478',
            'tlCornerLongitude' => '-2.4884033203125004',
            'trCornerLatitude' => '36.8963707853478',
            'trCornerLongitude' => '-2.4884033203125004',
            'blCornerLatitude' => '36.8963707853478',
            'blCornerLongitude' => '-2.4884033203125004',
            'brCornerLatitude' => '36.8963707853478',
            'brCornerLongitude' => '-2.4884033203125004',
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
            'miniature' => 'MiniatureAguadulce2000.png',
            'level' => '4',
            'width' => '1080',
            'height' => '720',
            'tlCornerLatitude' => '36.8963707853478',
            'tlCornerLongitude' => '-2.4884033203125004',
            'trCornerLatitude' => '36.8963707853478',
            'trCornerLongitude' => '-2.4884033203125004',
            'blCornerLatitude' => '36.8963707853478',
            'blCornerLongitude' => '-2.4884033203125004',
            'brCornerLatitude' => '36.8963707853478',
            'brCornerLongitude' => '-2.4884033203125004',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('maps')->insert([    
            //La id no se pone porque se autoincrementa sola
            'title' => 'Tabernas XXI',
            'description' => 'Mapa de la ciudad de Tabernas en el siglo XXI',
            'city' => 'Tabernas',
            'date' => '2001',
            'image' => 'Tabernas2001.png',
            'miniature' => 'MiniatureTabernas2001.png',
            'level' => '5',
            'width' => '1080',
            'height' => '720',
            'tlCornerLatitude' => '36.8963707853478',
            'tlCornerLongitude' => '-2.4884033203125004',
            'trCornerLatitude' => '36.8963707853478',
            'trCornerLongitude' => '-2.4884033203125004',
            'blCornerLatitude' => '36.8963707853478',
            'blCornerLongitude' => '-2.4884033203125004',
            'brCornerLatitude' => '36.8963707853478',
            'brCornerLongitude' => '-2.4884033203125004',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
