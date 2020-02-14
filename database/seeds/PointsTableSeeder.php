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
            'lat' => 36.854415703972165,
            'lng' => -2.4474240161989163,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('points')->insert([    
            //La id no se pone porque se autoincrementa sola
            'lat' => 36.8382030317319,
            'lng' => -2.4797878905928017,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('points')->insert([    
            //La id no se pone porque se autoincrementa sola
            'lat' => 36.82146698198432,
            'lng' => -2.4393812851598966,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('points')->insert([    
            //La id no se pone porque se autoincrementa sola
            'lat' => 36.83115852885874,
            'lng' => -2.438952340303922,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
