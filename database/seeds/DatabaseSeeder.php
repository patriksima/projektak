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
        $this->call(UsersTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(WorkersTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(TaskStatusesTableSeeder::class);
        $this->call(TimeRequestsTableSeeder::class);
    }
}
