<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class StreetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('streets')->insert([
            'type'=> 'avenida',
            'name'=> 'mar, del',
           
        ]);
        DB::table('streets')->insert([
            'type'=> 'calle',
            'name'=> 'celia viñas',
           
        ]);
        DB::table('streets')->insert([
            'type'=> 'paseo',
            'name'=> 'almeria, de',
           
        ]);
    }
}
