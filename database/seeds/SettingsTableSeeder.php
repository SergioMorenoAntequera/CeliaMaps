<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();
        //Punto de ejemplo
        DB::table('settings')->insert([    
            //La id no se pone porque se autoincrementa sola
            'name' => "mainPointLat",
            'value' => "36.854415703972165",
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('settings')->insert([    
            //La id no se pone porque se autoincrementa sola
            'name' => "mainPointLng",
            'value' => "-2.4474240161989163",
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('settings')->insert([    
            //La id no se pone porque se autoincrementa sola
            'name' => "mainPointZoom",
            'value' => "12",
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
