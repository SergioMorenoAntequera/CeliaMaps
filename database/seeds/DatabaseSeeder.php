<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(MapsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StreetsTableSeeder::class);
        $this->call(HotspotTableSeeder::class);
        $this->call(PointsTableSeeder::class);
        $this->call(StreetTypeTableSeeder::class);
        $this->call(MapsStreetsTableSeeder::class);
        $this->call(PointsStreetsTableSeeder::class);
    }
}
