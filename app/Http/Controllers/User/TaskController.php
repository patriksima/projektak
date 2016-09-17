<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Task;
use App\TaskLog;
use App\TaskStatus;
use App\TaskRequest;
use App\Worker;
use App\Project;
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
            ->where('task_statuses.type', '=', 'worker')
            ->orderBy('deadline', 'desc');

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
}
