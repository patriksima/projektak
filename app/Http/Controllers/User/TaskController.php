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
        $tasks = auth()->user()->worker->tasks;

        return view('user.tasks.index', compact('tasks'));
    }
}
