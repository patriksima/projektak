<?php

use Illuminate\Database\Seeder;
use App\User;
use App\SocialAccount;

class SocialAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         // default social for primary user
         User::findOrFail(1)
            ->socials()
            ->save(factory(App\SocialAccount::class, 'primary')->make());
     }
}
