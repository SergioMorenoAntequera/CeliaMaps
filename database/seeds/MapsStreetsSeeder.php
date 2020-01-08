<?php

use Illuminate\Database\Seeder;

class MapsStreetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maps_streets')->truncate();
        DB::table('maps_streets')->insert([
            'street_id' => 2,
            'map_id' => 1,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('maps_streets')->insert([
            'street_id' => 3,
            'map_id' => 1,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('maps_streets')->insert([
            'street_id' => 3,
            'map_id' => 3,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('maps_streets')->insert([
            'street_id' => 4,
            'map_id' => 4,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('maps_streets')->insert([
            'street_id' => 1,
            'map_id' => 5,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
