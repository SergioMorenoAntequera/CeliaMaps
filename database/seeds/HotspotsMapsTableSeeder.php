<?php

use Illuminate\Database\Seeder;

class HotspotsMapsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotspots_maps')->insert([
            'hotspot_id' => 2,
            'map_id' => 1,
        ]);

        DB::table('hotspots_maps')->insert([
            'hotspot_id' => 4,
            'map_id' => 2,
        ]);

        DB::table('hotspots_maps')->insert([
            'hotspot_id' => 3,
            'map_id' => 4,
        ]);

        DB::table('hotspots_maps')->insert([
            'hotspot_id' => 3,
            'map_id' => 3,
        ]);

        DB::table('hotspots_maps')->insert([
            'hotspot_id' => 3,
            'map_id' => 1,
        ]);

        DB::table('hotspots_maps')->insert([
            'hotspot_id' => 1,
            'map_id' => 2,
        ]);
    }
}
