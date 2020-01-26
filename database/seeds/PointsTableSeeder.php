<?php

use Illuminate\Database\Seeder;

class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('points')->truncate();
        //Punto de ejemplo
        DB::table('points')->insert([    
            //La id no se pone porque se autoincrementa sola
            'x' => 100,
            'y' => 100,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('points')->insert([    
            //La id no se pone porque se autoincrementa sola
            'x' => 200,
            'y' => 200,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('points')->insert([    
            //La id no se pone porque se autoincrementa sola
            'x' => 300,
            'y' => 300,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
