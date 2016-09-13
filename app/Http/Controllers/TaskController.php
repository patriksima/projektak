<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Task;
use App\TaskStatus;
use App\Worker;
use App\Project;
use App\Client;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    public function index()
    {
        $orderBy  = Input::get('orderBy', 'deadline');
        $orderDir = Input::get('orderDir', 'asc');
        $search   = Input::get('s', '');

        $tasks = DB::table('tasks')
            ->leftJoin('task_metas as tm1', function ($join) {
                $join->on('tasks.id', '=', 'tm1.task_id')
                     ->where('tm1.meta_key', '=', 'source_int-bc-count');
            })
            ->leftJoin('task_metas as tm2', function ($join) {
                $join->on('tasks.id', '=', 'tm2.task_id')
                     ->where('tm2.meta_key', '=', 'source_ext-bc-count');
            })
            ->leftJoin('task_statuses as ts', 'tasks.status_id', '=', 'ts.id')
            ->leftJoin('projects as p', 'tasks.project_id', '=', 'p.id')
            ->leftJoin('clients as c', 'c.id', '=', 'p.client_id')
            ->leftJoin('task_worker as wht', 'tasks.id', '=', 'wht.task_id')
            ->leftJoin('workers as w', 'w.id', '=', 'wht.worker_id')
            ->select('tasks.id', 'tasks.deadline', 'tasks.name', 'c.name as client', 'p.name as project', DB::raw('GROUP_CONCAT(DISTINCT w.name ORDER BY w.name DESC SEPARATOR "|") workers'), 'ts.name as status', 'tasks.source_int', 'tasks.source_ext', DB::raw('MAX(tm1.meta_value) as source_int_c'), DB::raw('MAX(tm2.meta_value) as source_ext_c'))
            ->where('ts.order', '<>', 99)
            ->groupBy('tasks.id')
            ->orderBy($orderBy, $orderDir);

        if ($search) {
            $tasks->where(function ($query) use ($search) {
                $query->where('tasks.name', 'like', $search)
                      ->orWhere('c.name', 'like', $search)
                      ->orWhere('p.name', 'like', $search);
            });
        }

        $project_id = Input::get('project_id');
        if ($project_id) {
            $tasks->where('tasks.project_id', '=', $project_id);
        }

        $tasks = $tasks->get();

        $projects = DB::table('projects')
            ->leftJoin('clients', 'clients.id', '=', 'projects.client_id')
            ->select('projects.id', DB::raw('CONCAT(clients.name," - ",projects.name) as name'))
            ->orderBy('name', 'asc')
            ->get();
        $statuses = TaskStatus::orderBy('order')->get();
        $workers = Worker::orderBy('name')->get();

        return view('tasks.index', [
            'orderBy'  => $orderBy,
            'orderDir' => $orderDir,
            'tasks'    => $tasks,
            'projects' => $projects,
            'statuses' => $statuses,
            'workers'  => $workers,
            'search'   => $search,
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $task = new Task;
            $task->status_id   = $request->status_id;
            $task->name        = $request->name;
            $task->description = $request->description;
            $task->source_int  = $request->source_int;
            $task->source_ext  = $request->source_ext;
            $task->deadline    = $request->deadline;
            $task->estimate    = $request->estimate;
            $task->checked     = Carbon::now();

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
            $task->status_id   = $request->status_id;
            $task->name        = $request->name;
            $task->description = $request->description;
            $task->source_int  = $request->source_int;
            $task->source_ext  = $request->source_ext;
            $task->deadline    = $request->deadline;
            $task->estimate    = $request->estimate;
            $task->checked     = Carbon::now();
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
            'workers'  => $workers,
            'task_workers' => Task::find($request->id)->workers()->pluck('id')->all(),
        ]);
    }
}
