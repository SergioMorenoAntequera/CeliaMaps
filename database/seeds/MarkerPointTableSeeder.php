<?php

use Illuminate\Database\Seeder;

class MarkerPointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marker_point')->truncate();
        DB::table('marker_point')->insert([
            'marker_id' => 1,
            'point_id' => 1,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('marker_point')->insert([
            'marker_id' => 1,
            'point_id' => 2,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('marker_point')->insert([
            'marker_id' => 2,
            'point_id' => 1,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('marker_point')->insert([
            'marker_id' => 3,
            'point_id' => 3,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
