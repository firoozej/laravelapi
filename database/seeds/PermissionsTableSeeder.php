<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'user',
                'guard_name' => 'api',
            ],
            [
                'name' => 'permission',
                'guard_name' => 'api',
            ],
            [
                'name' => 'role',
                'guard_name' => 'api',
            ],
            [
                'name' => 'category',
                'guard_name' => 'api',
            ]
        ]);
    }
}