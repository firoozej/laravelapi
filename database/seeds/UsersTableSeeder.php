<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Firooze Javaheri',
            'email' => 'firooze.javaheri@gmail.com',
            'password' => bcrypt('123'),
        ]);
    }
}