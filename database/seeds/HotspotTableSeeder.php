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
    
            'title' => 'Catedral de Almeria',
            'description' => 'La Catedral-Fortaleza de la Encarnación es la sede episcopal 
            de la diócesis de Almería. El edificio, con estructura de fortaleza, presenta una 
            arquitectura de transición entre el Gótico tardío y el Renacimiento, así como rasgos 
            posteriores barrocos y neoclásicos. Constituye una de las manifestaciones artísticas de carácter 
            arquitectónico y cultural más importantes y valiosas de Andalucía y, por ende, de España, al ser 
            la única Catedral con naturaleza de fortaleza erigida en el siglo XVI. ',
            'lat' => 36.854415703972165,
            'lng' => -2.4474240161989163,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'title' => 'Alcazaba',
            'description' => 'Alcazaba de la ciudad de Almeria',
            'lat' => 36.8382030317319,
            'lng' => -2.4797878905928017,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'title' => 'Mercado Central',
            'description' => 'Mercado del paseo',
            'lat' => 36.82146698198432,
            'lng' => -2.4393812851598966,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'title' => 'Refugios WW2',
            'description' => 'Refugios de la segunda guerra mundial',
            'lat' => 36.83115852885874,
            'lng' => -2.438952340303922,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'title' => 'Minihollywood',
            'description' => 'Atracción del oeste y zoo para toda la familia',
            'lat' => 36.98115852885874,
            'lng' => -5.438952340303922,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'title' => 'Plaza Vieja',
            'description' => 'La Plaza de la Constitución, popularmente conocida como Plaza Vieja, es una plaza situada en el centro histórico de la ciudad española de Almería. Durante la época musulmana se encontraba en este lugar el zoco, consolidándose su carácter de plaza en el siglo XIX. Alberga la sede del Ayuntamiento de la ciudad, construido a finales de dicho siglo, proyecto del arquitecto almeriense Trinidad Cuartara.',
            'lat' => 34.83115852885874,
            'lng' => -1.908952340303922,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'title' => 'Puerta Purchena',
            'description' => 'La Puerta de Purchena es una plaza situada en el centro de la ciudad de Almería. En ella se ubicó la antigua puerta de Pechina, aunque su nombre se vio alterado tras la conquista cristiana por un error de transcripción de los Reyes Católicos, quienes confundieron el nombre de los pueblos de Pechina (la antigua Bayyana) y Purchena, ambos almerienses. 
            La puerta homónima desapareció tras el derribo de la muralla en 1855, creándose por entonces la actual plaza. El urbanismo que la caracteriza es propio de la arquitectura burguesa del siglo XIX, representada en edificaciones como la Casa de las Mariposas. ',
            'lat' => 37.23115852885874,
            'lng' => -2.217852340303922,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        
        DB::table('hotspots')->insert([    
            
            'title' => 'Estadio Municial Juan Rojas',
            'description' => 'El primer estadio que he pillao',
            'lat' => 36.862102782722665,
            'lng' => -2.4453914165496826,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('hotspots')->insert([    
            
            'image' => 'puertaPurchena.png',
            'title' => 'Tíjola',
            'description' => 'Capital de Almería',
            'lat' => 37.346822819116255,
            'lng' => -2.4372549355030064,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
