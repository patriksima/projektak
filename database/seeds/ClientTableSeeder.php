<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Client::class, 10)->create()->each(function ($u) {
            for ($i = 0; $i < 5; $i++) {
                $u->inboxes()->save(factory(App\Inbox::class)->make());
            }

            for ($i = 0; $i < 3; $i++) {
                $project = factory(App\Project::class)->make();
                $u->projects()->save($project);

                for ($i = 0; $i < 10; $i++) {
                    $task = factory(App\Task::class)->make();
                    $project->tasks()->save($task);
                }
            }
        });
    }
}
