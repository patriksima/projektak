<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! auth()->user()->worker) {
            return back()->withError('You do not have a worker assigned');
        }

        $tasks = auth()->user()->worker->tasks;

        return view('user.tasks.index', compact('tasks'));
    }
}
