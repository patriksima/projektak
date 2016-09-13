<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class RolesDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Role::class, 'admin')->create();
        factory(App\Role::class, 'manager')->create();
        factory(App\Role::class, 'worker')->create();
        factory(App\Role::class, 'guest')->create();

        // Admin has admin role
        User::findOrFail(1)->roles()->attach(Role::findOrFail(1));
        // Admin has manager role
        User::findOrFail(1)->roles()->attach(Role::findOrFail(2));
        // Admin has user role
        User::findOrFail(1)->roles()->attach(Role::findOrFail(3));
    }
}
