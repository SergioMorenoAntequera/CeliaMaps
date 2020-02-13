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
            
            'image' => 'catedralAlmeria.png',
            'title' => 'Catedral de Almeria',
            'description' => 'La Catedral-Fortaleza de la Encarnación es la sede episcopal 
            de la diócesis de Almería. El edificio, con estructura de fortaleza, presenta una 
            arquitectura de transición entre el Gótico tardío y el Renacimiento, así como rasgos 
            posteriores barrocos y neoclásicos. Constituye una de las manifestaciones artísticas de carácter 
            arquitectónico y cultural más importantes y valiosas de Andalucía y, por ende, de España, al ser 
            la única Catedral con naturaleza de fortaleza erigida en el siglo XVI. ',
            'point_x' => 100,
            'point_y' => 150,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'image' => 'Alcazaba.png',
            'title' => 'Alcazaba',
            'description' => 'Alcazaba de la ciudad de Almeria',
            'point_x' => 50,
            'point_y' => 190,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'image' => 'mercadoCentral.png',
            'title' => 'Mercado Central',
            'description' => 'Mercado del paseo',
            'point_x' => 500,
            'point_y' => 63,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'image' => 'REfugios.png',
            'title' => 'Refugios WW2',
            'description' => 'Refugios de la segunda guerra mundial',
            'point_x' => 100,
            'point_y' => 150,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'image' => 'minihollywood.png',
            'title' => 'Minihollywood',
            'description' => 'Atracción del oeste y zoo para toda la familia',
            'point_x' => 10,
            'point_y' => 500,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'image' => 'plazaVieja.png',
            'title' => 'Plaza Vieja',
            'description' => 'La Plaza de la Constitución, popularmente conocida como Plaza Vieja, es una plaza situada en el centro histórico de la ciudad española de Almería. Durante la época musulmana se encontraba en este lugar el zoco, consolidándose su carácter de plaza en el siglo XIX. Alberga la sede del Ayuntamiento de la ciudad, construido a finales de dicho siglo, proyecto del arquitecto almeriense Trinidad Cuartara.',
            'point_x' => 60,
            'point_y' => 530,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'image' => 'puertaPurchena.png',
            'title' => 'Puerta Purchena',
            'description' => 'La Puerta de Purchena es una plaza situada en el centro de la ciudad de Almería. En ella se ubicó la antigua puerta de Pechina, aunque su nombre se vio alterado tras la conquista cristiana por un error de transcripción de los Reyes Católicos, quienes confundieron el nombre de los pueblos de Pechina (la antigua Bayyana) y Purchena, ambos almerienses. 
            La puerta homónima desapareció tras el derribo de la muralla en 1855, creándose por entonces la actual plaza. El urbanismo que la caracteriza es propio de la arquitectura burguesa del siglo XIX, representada en edificaciones como la Casa de las Mariposas. ',
            'point_x' => 870,
            'point_y' => 550,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
