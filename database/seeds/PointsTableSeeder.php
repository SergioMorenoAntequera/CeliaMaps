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
            'point_x' => 100,
            'point_y' => 100,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('points')->insert([    
            //La id no se pone porque se autoincrementa sola
            'point_x' => 200,
            'point_y' => 200,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('points')->insert([    
            //La id no se pone porque se autoincrementa sola
            'point_x' => 300,
            'point_y' => 300,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
