<?php

use App\Task;
use App\User;
use App\Worker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Worker::class, 10)->create()->each(function ($worker) {
            $tasks = Task::orderBy(DB::raw('RAND()'))->take(10)->select('id')->get();
            $task_ids = [];
            foreach ($tasks as $task) {
                $task_ids[] = $task->id;
            }
            $worker->tasks()->attach($task_ids);

            // time logs
            foreach ($task_ids as $task_id) {
                for ($i = 0; $i < 5; $i++) {
                    $tasklog = factory(App\TaskLog::class)->make();
                    $tasklog->task()->associate(App\Task::find($task_id));
                    $worker->tasklogs()->save($tasklog);
                }
            }

            // worksheets
            for ($i = 0; $i < 10; $i++) {
                $worksheet = factory(App\Worksheet::class)->make();
                $worksheet->project()->associate(App\Project::orderBy(DB::raw('RAND()'))->first());
                $worker->worksheets()->save($worksheet);
            }

            // user is a worker
            $worker->user()->associate(1);
        });
    }
}
