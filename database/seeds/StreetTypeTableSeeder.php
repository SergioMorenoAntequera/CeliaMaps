<?php

use Illuminate\Database\Seeder;

class StreetTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('street_types')->insert([
            'type'=> 'Avenida',
            'abbreviation'=> 'AVD. ',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('street_types')->insert([
            'type'=> 'Calle',
            'abbreviation'=> 'C/',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('street_types')->insert([
            'type'=> 'Plaza',
            'abbreviation'=> 'PZ. ',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('street_types')->insert([
            'type'=> 'Arboleda',
            'abbreviation'=> 'ARB. ',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('street_types')->insert([
            'type'=> 'Finca',
            'abbreviation'=> 'FN. ',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('street_types')->insert([
            'type'=> 'Conjunto monumental',
            'abbreviation'=> 'CM. ',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('street_types')->insert([
            'type'=> 'Paseo',
            'abbreviation'=> 'P. ',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        
    }
}
