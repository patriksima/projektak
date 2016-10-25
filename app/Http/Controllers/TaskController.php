<?php

namespace App\Http\Controllers;

use App\Task;
use App\Worker;
use App\Project;
use App\TaskStatus;
use App\Filters\TaskFilter;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Filters\TaskFilter  $filter
     * @return \Illuminate\Http\Response
     */
    public function index(TaskFilter $filter)
    {
        $tasks = Task::filter($filter)->with('project.client', 'workers', 'status')->get();

        $workers = Worker::orderBy('name')->get();
        $projects = Project::orderBy('name')->get();
        $statuses = TaskStatus::orderBy('name')->get();

        return view('tasks.index', compact('tasks', 'projects', 'statuses', 'workers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $task = Task::create(request()->all());

        Project::find(request('project_id'))
            ->tasks()
            ->save($task);

        foreach (request('worker_ids') as $id) {
            $task->workers()->attach($id);
        }

        return back()->with('success', 'Task successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $ŧask
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $workers = Worker::orderBy('name')->get();
        $projects = Project::orderBy('name')->get();
        $statuses = TaskStatus::orderBy('name')->get();

        return view('tasks.edit', compact('task', 'projects', 'statuses', 'workers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Task $task)
    {
        $task->update(request()->all());

        $task->workers()->detach();

        foreach (request('worker_ids') as $id) {
            $task->workers()->attach($id);
        }

        return redirect('/tasks')->with('success', 'Task successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);

        return back();
    }
}
