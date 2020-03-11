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
            'description' => 'La Catedral-Fortaleza de la Encarnación es la sede episcopal de la diócesis de Almería. El edificio, con estructura de fortaleza, presenta una arquitectura de transición entre el Gótico tardío y el Renacimiento, así como rasgos posteriores barrocos y neoclásicos. Constituye una de las manifestaciones artísticas de carácter arquitectónico y cultural más importantes y valiosas de Andalucía y, por ende, de España, al ser la única Catedral con naturaleza de fortaleza erigida en el siglo XVI. ',
            'lat' => 36.838036051870695,
            'lng' => -2.467441694045514,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'title' => 'Alcazaba',
            'description' => 'La Alcazaba, Castillo y Murallas del Cerro de San Cristóbal de la ciudad española de Almería es uno de los conjuntos monumentales y arqueológicos andalusíes más importantes de la península ibérica.',
            'lat' => 36.841045612512296,
            'lng' => -2.4715883687671685,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'title' => 'Mercado Central',
            'description' => 'El Mercado Central de Almería fue el primer mercado de abastos, y el mayor durante mucho tiempo de la ciudad de Almería, España. Se sitúa cerca de la Puerta de Purchena, considerada popularmente como centro geográfico de la ciudad; concretamente en la Rambla Obispo Orberá.',
            'lat' => 36.84035226488956,
            'lng' => -2.4626323944043054,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('hotspots')->insert([    
            
            'title' => 'Refugios de la Guerra Civil',
            'description' => 'Sistema subterráneo de refugios antiaéreos de hormigón usado en la Guerra Civil española con visitas guiadas.',
            'lat' => 36.841629479318954,
            'lng' => -2.4646334325020063,
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
            'lat' => 36.841592987774135,
            'lng' => -2.463978894418473,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        
        DB::table('hotspots')->insert([    
            
            'title' => 'Estadio de los Juegos Mediterraneos',
            'description' => 'El Estadio de los Juegos Mediterráneos​ es un estadio de fútbol de la ciudad de Almería, España, sede de los partidos de la U.D. Almería. Fue el estadio olímpico de los XV Juegos Mediterráneos del año 2005 celebrados en Almería entre el 24 de junio y el 3 de julio de 2005. ',
            'lat' => 36.839995928990916,
            'lng' => -2.4353805833544566,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        
    }
}
