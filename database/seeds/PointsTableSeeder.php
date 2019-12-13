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
            'point_x' => 40,
            'point_y' => 100,
            'street_id' => 1,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
