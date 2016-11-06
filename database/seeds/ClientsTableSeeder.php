<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Client::class, 10)->create()->each(function ($c) {
            factory(App\Inbox::class, 5)->make()->each(function ($i) use ($c) {
                $c->inboxes()->save($i);
            });

            factory(App\Project::class, 3)->make()->each(function ($p) use ($c) {
                $c->projects()->save($p);

                factory(App\Task::class, 10)->make()->each(function ($t) use ($p) {
                    $p->tasks()->save($t);
                });
            });
        });
    }
}
