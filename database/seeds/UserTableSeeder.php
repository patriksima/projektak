<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'patrik@wrongware.cz',
            'name' => 'Patrik',
            'allowed' => 1,
            'password' => 'secret',
            'api_token' => str_random(60),
        ]);
    }
}
