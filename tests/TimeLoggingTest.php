<?php

use App\Worker;
use App\TaskLog;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CrudTraitTest extends TestCase
{
    protected $auth;

    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate:refresh', ['--seed' => true]);

        auth()->loginUsingId(1);

        $this->auth = ['Authorization' => 'Bearer '.auth()->user()->api_token];
    }

    /** @test */
    public function it_finds_all_running_tasks_for_a_user()
    {
        $log = TaskLog::running();

        $this->assertEquals($log->end, null);
    }

    /** @test */
    public function it_doesnt_start_logging_a_task_when_there_is_one_being_logged()
    {
        // there is one task running by default
        $this->put('/api/tasks/1/start', [], $this->auth)
            ->assertResponseStatus(403);
    }

    /** @test */
    public function it_stops_logging_a_task()
    {
        $task = TaskLog::where('worker_id', 1)->where('end', null)->first()->task;

        $this->put('/api/tasks/'.$task->id.'/stop', [], $this->auth)
            ->assertResponseStatus(200);

        $this->assertCount(0, TaskLog::where('worker_id', 1)->where('end', null)->get());
    }

    /** @test */
    public function it_starts_logging_a_task()
    {
        $task = TaskLog::where('worker_id', 1)->where('end', null)->first()->task;

        $this->put('/api/tasks/'.$task->id.'/stop', [], $this->auth)
            ->assertResponseStatus(200);

        $this->assertCount(0, TaskLog::where('worker_id', 1)->where('end', null)->get());

        $task = Worker::find(1)->tasks->first();

        $this->put('/api/tasks/'.$task->id.'/start', [], $this->auth)
            ->assertResponseStatus(200);

        $this->assertCount(1, TaskLog::where('worker_id', 1)->where('end', null)->get());
    }

    /** @test */
    public function it_computes_total_time_logged()
    {
        $this->get('/api/tasks/total/week', $this->auth)
            ->assertResponseStatus(200);

        $this->get('/api/tasks/total/month', $this->auth)
            ->assertResponseStatus(200);
    }
}
