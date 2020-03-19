<?php

use Illuminate\Database\Seeder;

class AlignassitsPointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alignassist_point')->truncate();
        DB::table('alignassist_point')->insert([
            'alignassist_id' => 1,
            'point_id' => 1,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
        DB::table('alignassist_point')->insert([
            'alignassist_id' => 1,
            'point_id' => 2,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
