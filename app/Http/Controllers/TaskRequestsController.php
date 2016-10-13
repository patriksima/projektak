<?php

namespace App\Http\Controllers;

use App\TaskRequest;

class TaskRequestsController extends Controller
{
    public function index()
    {
        $requests = TaskRequest::with('task', 'worker')->get();

        return view('task-requests.index', compact('requests'));
    }

    public function approve(TaskRequest $request)
    {
        $request->approve();

        return back()->withSuccess('');
    }
}
