<?php

namespace App\Http\Controllers\User;

use DB;
use Auth;
use App\Task;
use App\User;
use App\Worker;
use App\Project;
use App\TaskLog;
use Carbon\Carbon;
use App\TaskStatus;
use App\TaskRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\WorkerTaskRequest;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    public function index()
    {
        return view('user.tasks.index', ['tasks' => auth()->user()->worker->tasks]);
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
        $tasks = Task::select('tasks.id', 'tasks.name', 'tasks.estimate', 'tasks.deadline')
            ->withWorker()
            ->withActivity()
            ->withStatus()
            ->withProject()
            ->withClient()
            ->withDuration()
            ->where('task_worker.worker_id', '=', Auth::user()->worker->id)
            ->where('task_statuses.type', '=', 'worker');

        if ($request->task_id) {
            $tasks->where('tasks.id', '=', $request->task_id);
        }

        return $tasks->get();
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

    public function apiDone(Request $request)
    {
        // push to project manager for approval
        $status = TaskStatus::whereType('project')
            ->whereSlug('approve')
            ->first();

        Task::find($request->task_id)
            ->status()
            ->associate($status)
            ->save();
    }

    public function apiRequest(Request $request)
    {
        $taskrequest = new TaskRequest;
        $taskrequest->estimate = $request->estimate;
        $taskrequest->reason = $request->reason;
        $taskrequest->worker()->associate(Auth::user()->worker);
        $taskrequest->task()->associate(Task::find($request->id));
        $taskrequest->save();

        // push to project manager for approval
        $status = TaskStatus::whereType('project')
            ->whereSlug('request')
            ->first();

        Task::find($request->id)
            ->status()
            ->associate($status)
            ->save();
    }

    /**
     * Request a new task.
     *
     * @return \Illuminate\Http\Response
     */
    public function request()
    {
        User::all()->each(function ($user) {
            if ($user->hasRole(['manager', 'admin']) && $user->id !== auth()->id()) {
                $user->notify(new WorkerTaskRequest(auth()->user()));
            }
        });

        return back()->with('success', 'Task has been requested');
    }
}
