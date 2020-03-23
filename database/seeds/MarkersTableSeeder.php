<?php

use Illuminate\Database\Seeder;

class MarkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('markers')->insert([
            'name' => 'Avenida Santa isabel',
            'type' => 'polygon',
            'radius' => null,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('markers')->insert([
            'name' => 'Plaza de toros',
            'type' => 'circle',
            'radius' => 200,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('markers')->insert([
            'name' => 'Marcador de ejemplo',
            'type' => 'marker',
            'radius' => null,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
