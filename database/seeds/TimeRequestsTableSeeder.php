<?php

use Illuminate\Database\Seeder;

class TimeRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Task::where('status_id', 10)->get()->each(function ($t) {
            factory(App\TimeRequest::class)->create([
                'worker_id' => App\Worker::inRandomOrder()->first()->id,
                'task_id' => $t->id,
            ]);
        });
    }
}
