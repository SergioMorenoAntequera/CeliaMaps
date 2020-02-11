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
            'name'=> 'Avenida',
            'abbreviation'=> 'AVD. ',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('street_types')->insert([
            'name'=> 'Calle',
            'abbreviation'=> 'C/',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('street_types')->insert([
            'name'=> 'Plaza',
            'abbreviation'=> 'PZ. ',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('street_types')->insert([
            'name'=> 'Arboleda',
            'abbreviation'=> 'ARB. ',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('street_types')->insert([
            'name'=> 'Finca',
            'abbreviation'=> 'FN. ',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('street_types')->insert([
            'name'=> 'Conjunto monumental',
            'abbreviation'=> 'CM. ',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('street_types')->insert([
            'name'=> 'Paseo',
            'abbreviation'=> 'P. ',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        
    }
}
