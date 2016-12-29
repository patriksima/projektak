<?php

namespace App\Http\Controllers\Api;

use App\Task;
use App\User;
use App\TaskLog;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Notifications\WorkerTaskRequest;

class TaskController extends Controller
{
    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Returns tasks for the logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function forUser()
    {
        return Task::loggable();
    }

    /**
     * Returns runnning tasks for the logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function running()
    {
        return TaskLog::running();
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

        return response(200);
    }

    /**
     * Starts the timer.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function start(Task $task)
    {
        if (TaskLog::running()) {
            return response(403);
        }

        $task->startLogging();

        return response(200);
    }

    /**
     * Stops the timer.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function stop(Task $task)
    {
        $task->stopLogging();

        return response(200);
    }

    /**
     * Returns all the logs for the last month.
     *
     * @return \Illuminate\Http\Response
     */
    public function logs()
    {
        $logs = TaskLog::where('end', '!=', null)
            ->where('start', '>', Carbon::now()->startOfMonth())
            ->where('worker_id', auth()->user()->worker->id)
            ->orderBy('start', 'desc')
            ->get()->load('task');

        return $logs;
    }

    /**
     * Returns total time logged for the given period.
     *
     * @param  string  $period
     * @return \Illuminate\Http\Response
     */
    public function total($period = 'month')
    {
        $period = $period == 'month' ? Carbon::now()->startOfMonth() : Carbon::now()->startOfWeek();

        $logs = TaskLog::where('end', '!=', null)
            ->where('start', '>=', $period)
            ->where('worker_id', auth()->user()->worker->id)
            ->orderBy('start', 'desc')
            ->get()->load('task');

        $total = 0;

        $logs->each(function ($log) use (&$total) {
            $total += $log->end->diffInSeconds($log->start);
        });

        return $total;
    }
}
