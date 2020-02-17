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
            'image' => 'mapa1Modificado2.png',
            'miniature' => 'MiniatureAlmeria2012.png',
            'level' => '1',
            'tlCornerLatitude' => '36.8509943512347000',
            'tlCornerLongitude' => '-2.4849700927734380',
            'trCornerLatitude' => '36.8509943512347000',
            'trCornerLongitude' => '-2.4457776546478276',
            'blCornerLatitude' => '36.8282316190681300',
            'blCornerLongitude' => '-2.4849700927734380',
            'brCornerLatitude' => '36.8282316190681300',
            'brCornerLongitude' => '-2.4457776546478276',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('maps')->insert([    
            //La id no se pone porque se autoincrementa sola
            'title' => 'Huercal XXI',
            'description' => 'Mapa de la ciudad de Huercal en el siglo XXI',
            'city' => 'Huercal',
            'date' => '2019',
            'image' => 'NoMap.png',
            'miniature' => 'MiniatureHuercal2019.png',
            'level' => '2',
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
            'title' => 'Almería XX',
            'description' => 'Mapa de la ciudad de Almeria en el siglo XX',
            'city' => 'Almería',
            'date' => '1990',
            'image' => 'KindOfMap3.png',
            'miniature' => 'MiniatureAlmeria1990.png',
            'level' => '3',
            'tlCornerLatitude' => null,
            'tlCornerLongitude' => null,
            'trCornerLatitude' => null,
            'trCornerLongitude' => null,
            'blCornerLatitude' => null,
            'blCornerLongitude' => null,
            'brCornerLatitude' => null,
            'brCornerLongitude' => null,
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
            'tlCornerLatitude' => null,
            'tlCornerLongitude' => null,
            'trCornerLatitude' => null,
            'trCornerLongitude' => null,
            'blCornerLatitude' => null,
            'blCornerLongitude' => null,
            'brCornerLatitude' => null,
            'brCornerLongitude' => null,
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
            'tlCornerLatitude' => null,
            'tlCornerLongitude' => null,
            'trCornerLatitude' => null,
            'trCornerLongitude' => null,
            'blCornerLatitude' => null,
            'blCornerLongitude' => null,
            'brCornerLatitude' => null,
            'brCornerLongitude' => null,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
