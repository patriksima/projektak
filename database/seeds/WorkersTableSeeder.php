<?php

use Illuminate\Database\Seeder;

class WorkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Worker::class, 10)->create()->each(function ($w) {
            $ts = App\Task::inRandomOrder()->limit(10)->get();

            $w->tasks()->sync($ts);

            $ts->each(function ($t) use ($w) {
                factory(App\TaskLog::class, 5)->make()->each(function ($l) use ($w, $t) {
                    $l->task()->associate($t);
                    $w->taskLogs()->save($l);
                });
            });

            factory(App\Worksheet::class, 10)->make()->each(function ($ws) use ($w) {
                $ws->project()->associate(App\Project::inRandomOrder()->first());
                $w->worksheets()->save($ws);
            });
        });
    }
}
