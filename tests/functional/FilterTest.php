<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FilterTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, WithoutMiddleware;

    /** @test */
    public function it_orders_resources_by_given_param()
    {
        // $user = factory(App\User::class)->create();
        // $tasks = factory(App\Task::class)->create();
        // auth()->login($user);

        // $this->visit('tasks?name=asc');
        // var_dump(request());


    }
}

class TestFilter extends App\Filters\Filter
{
    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = ['name', 'projects.name'];

    /**
     * Orderable columns.
     *
     * @var array
     */
    protected $orderable = [
        'name' => 'name',
        'client' => 'projects.name',
    ];
}
