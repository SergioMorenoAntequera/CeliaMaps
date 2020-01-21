<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'carmen',
            'email'=> 'carmen@mail.com',
            'password'=> Hash::make('12341234'),
            'level'=> 1,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
            //'password'=> Hash::make('1234'), para encriptar la contraseña
        ]);
        DB::table('users')->insert([
            'name'=> 'paula',
            'email'=> 'paula@mail.com',
            'password'=> Hash::make('12341234'),
            'level'=> 1 ,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
            
        ]);
        DB::table('users')->insert([
            'name'=> 'sergio',
            'email'=> 'csergio@mail.com',
            'password'=> Hash::make('12341234'),
            'level'=> 1,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
            
        ]);
        DB::table('users')->insert([
            'name'=> 'luis',
            'email'=> 'luis@mail.com',
            'password'=> Hash::make('12341234'),
            'level'=> 1,
            'created_at' => date('Y-m-d H-m-s'),
            'updated_at' => date('Y-m-d H-m-s'),
        ]);

    }
}
