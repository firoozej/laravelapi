<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasRolesTableSeeder extends Seeder
{
    public function run()
    {
        $userId      = DB::table('users')->where('email', 'firooze.javaheri@gmail.com')->first();
        $roleId      = DB::table('roles')->where('name', 'admin')->first();

        DB::table('model_has_roles')->insert([
            'model_id' => $userId->id,
            'role_id' => $roleId->id,
            'model_type' => 'App\User'
        ]);
    }
}