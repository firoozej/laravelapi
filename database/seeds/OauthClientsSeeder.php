<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OauthClientsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'id' => 1,
            'name' => 'Laravel Personal Access Client',
            'secret' => '7eelQhm5LtKqhYDc9IOG2POl2IsBMU1iVs46wE7O',
            'redirect' => 'http://localhost',
            'personal_access_client' => 1,
            'password_client' => 0,
            'revoked' => 0,
        ]);

        DB::table('oauth_clients')->insert([
            'id' => 2,
            'name' => 'Laravel Password Grant Client',
            'secret' => 'dIqjDvn6QiPpApH2PIEZiWJ5S3UlDiwV5PojuhFz',
            'redirect' => 'http://localhost',
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' => 0,
        ]);
    }
}