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
            'tipe'=> 'avenida',
            'name'=> 'mar, del',
           
        ]);
        
    }
}
