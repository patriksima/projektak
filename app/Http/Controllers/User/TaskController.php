<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->worker->tasks;

        return view('user.tasks.index', compact('tasks'));
    }
}
