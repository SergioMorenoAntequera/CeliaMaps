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
            'type_id'=> 1,
            'name'=> 'García Lorca',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('streets')->insert([
            'type_id'=> 1,
            'name'=> 'del Mediterráneo',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('streets')->insert([
            'type_id'=> 3,
            'name'=> 'Cabo de Gata',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('streets')->insert([
            'type_id'=> 2,
            'name'=> 'Carrera del Perú',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
