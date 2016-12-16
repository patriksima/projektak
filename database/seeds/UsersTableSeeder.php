<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = factory(App\User::class)->create([
            'email' => env('DEFAULT_EMAIL', 'jon@doe.com'),
            'name' => env('DEFAULT_NAME', 'Jon Doe'),
            'allowed' => 1,
            'api_token' => str_random(60),
        ]);

        $sa = factory(App\SocialAccount::class)->make([
            'provider_user_id' => env('DEFAULT_SOCIAL_ID', 0),
            'provider' => env('DEFAULT_PROVIDER_NAME', 'facebook'),
            'name' => env('DEFAULT_NAME', 'Jon Doe'),
            'avatar' => env('DEFAULT_AVATAR', ''),
        ]);

        $u->socials()->save($sa);

        $a = factory(App\Role::class, 'admin')->create();
        $m = factory(App\Role::class, 'manager')->create();
        $w = factory(App\Role::class, 'worker')->create();
        $g = factory(App\Role::class, 'guest')->create();

        $u->roles()->sync([$a->id, $m->id, $w->id]);

        $u->worker()->associate(1)->save();
    }
}
