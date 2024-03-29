<?php

use Illuminate\Database\Seeder;

class PointsStreetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('points_streets')->truncate();
        DB::table('points_streets')->insert([
            'street_id' => 1,
            'point_id' => 1,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('points_streets')->insert([
            'street_id' => 2,
            'point_id' => 2,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('points_streets')->insert([
            'street_id' => 3,
            'point_id' => 3,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('points_streets')->insert([
            'street_id' => 4,
            'point_id' => 4,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
