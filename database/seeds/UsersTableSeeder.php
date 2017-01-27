<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    protected $default = [
        ['name' => 'Pavel Koch', 'email' => 'kouks.koch@gmail.com', 'id' => '10202237305571244'],
        ['name' => 'Patrik Šíma', 'email' => 'patrik@wrongware.cz', 'id' => '100005052495944'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = factory(App\Role::class, 'admin')->create();
        $m = factory(App\Role::class, 'manager')->create();
        $w = factory(App\Role::class, 'worker')->create();
        $g = factory(App\Role::class, 'guest')->create();

        foreach ($this->default as $index=>$user) {
            $u = factory(App\User::class)->create([
                'email' => $user['email'],
                'allowed' => 1,
                'api_token' => str_random(60),
            ]);

            $sa = factory(App\SocialAccount::class)->make([
                'provider_user_id' => $user['id'],
                'provider' => 'facebook',
                'name' => $user['name'],
                'avatar' => "https://graph.facebook.com/v2.6/{$user['id']}/picture?type=normal",
            ]);

            $u->socials()->save($sa);

            $u->roles()->sync([$a->id, $m->id, $w->id]);

            $u->worker()->associate(++$index)->save();
        }
    }
}
