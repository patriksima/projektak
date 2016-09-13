<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Task;
use App\TaskLog;
use App\TaskStatus;
use App\Worker;
use App\Project;
use App\Client;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index()
    {
        return view('user.tasks', [
            'search' => '',
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $task = new Task();
            $task->status_id = $request->status_id;
            $task->name = $request->name;
            $task->description = $request->description;
            $task->source_int = $request->source_int;
            $task->source_ext = $request->source_ext;
            $task->deadline = $request->deadline;
            $task->estimate = $request->estimate;
            $task->checked = Carbon::now();

            Project::find($request->project_id)
                ->tasks()
                ->save($task);

            foreach ($request->worker_id as $worker_id) {
                Worker::find($worker_id)->tasks()->attach($task->id);
            }
        });

        return back();
    }

    public function update(Request $request)
    {
        DB::transaction(function () use ($request) {
            $task = Task::find($request->id);
            $task->status_id = $request->status_id;
            $task->name = $request->name;
            $task->description = $request->description;
            $task->source_int = $request->source_int;
            $task->source_ext = $request->source_ext;
            $task->deadline = $request->deadline;
            $task->estimate = $request->estimate;
            $task->checked = Carbon::now();
            $task->workers()->detach();
            $task->save();

            foreach ($request->worker_id as $worker_id) {
                Worker::find($worker_id)->tasks()->attach($task->id);
            }
        });

        return redirect('/tasks');
    }

    public function destroy(Request $request)
    {
        Task::destroy($request->id);

        return back();
    }

    public function edit(Request $request)
    {
        $projects = DB::table('projects')
            ->leftJoin('clients', 'clients.id', '=', 'projects.client_id')
            ->select('projects.id', DB::raw('CONCAT(clients.name," - ",projects.name) as name'))
            ->orderBy('name', 'asc')
            ->get();
        $statuses = TaskStatus::orderBy('order')->get();
        $workers = Worker::orderBy('name')->get();

        return view('tasks.edit', [
            'task' => Task::find($request->id),
            'projects' => $projects,
            'statuses' => $statuses,
            'workers' => $workers,
            'task_workers' => Task::find($request->id)->workers()->pluck('id')->all(),
        ]);
    }

    public function apiIndex(Request $request)
    {
        return Auth::user()
            ->worker
            ->tasks()
            ->with([
                'durations' => function ($query) {
                    $query->where('worker_id', '=', Auth::user()->worker->id);
                },
                'project' => function ($query) {
                    $query->with(['client']);
                },
                'tasklogs' => function ($query) {
                    $query->whereNull('end');
                },
                'status' => function ($query) {
                    $query->where('order', '<>', 99);
                },
            ])
            ->groupBy('tasks.id')
            ->get();
    }

    public function apiStart(Request $request)
    {
        TaskLog::where('worker_id', Auth::user()->worker->id)
            ->whereNull('end')
            ->update(['end' => DB::raw('NOW()')]);

        $tasklog = new TaskLog;
        $tasklog->start = DB::raw('NOW()');
        $tasklog->worker()->associate(Auth::user()->worker);
        $tasklog->task()->associate(Task::find($request->task_id));
        $tasklog->save();
    }

    public function apiStop(Request $request)
    {
        TaskLog::where('worker_id', Auth::user()->worker->id)
            ->whereNull('end')
            ->update(['end' => DB::raw('NOW()')]);
    }
}
