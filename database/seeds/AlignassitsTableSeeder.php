<?php

use Illuminate\Database\Seeder;

class AlignassitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('alignassists')->insert([
            'name' => 'Avenida Santa isabel',
            'type' => 'polygon',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('alignassists')->insert([
            'name' => 'Plaza de toros',
            'type' => 'circle',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

        DB::table('alignassists')->insert([
            'name' => 'Marcador de ejemplo',
            'type' => 'marker',
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);
    }
}
