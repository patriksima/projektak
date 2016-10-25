<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use App\Filters\TaskFilter;

class ControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Filters\TaskFilter  $filter
     * @return \Illuminate\Http\Response
     */
    public function index(TaskFilter $filter)
    {
        $tasks = Task::filter($filter)->with('project.client', 'workers', 'status')
            ->where('updated_at', '<', Carbon::now()->subHours(4))
            ->get();

        return view('control.index', compact('tasks'));
    }

    /**
     * Completeing given resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function complete(Task $task)
    {
        $task->update(['status_id' => 1]);

        return back()->with('success', 'Task has been completed');
    }

    /**
     * Checking given resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function check(Task $task)
    {
        $task->touch();

        return back()->with('success', 'Task has been checked');
    }
}
