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
            'name'=> 'mar, del',
        ]);
        DB::table('streets')->insert([
            'type_id'=> 2,
            'name'=> 'celia viñas',
        ]);
        DB::table('streets')->insert([
            'type_id'=> 3,
            'name'=> 'almeria, de',
        ]);
        DB::table('streets')->insert([
            'type_id'=> 2,
            'name'=> 'Lopán',
        ]);
    }
}
