<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClientTableSeeder::class);
        $this->call(WorkerTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(SocialAccountSeeder::class);
    }
}
