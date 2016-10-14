<?php

namespace App\Http\Controllers;

use App\TaskRequest;

class TaskRequestsController extends Controller
{
    /**
     * Handles listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = TaskRequest::with('task', 'worker')->get();

        return view('task-requests.index', compact('requests'));
    }

    /**
     * Handles approval of given task request
     *
     * @param  \App\TaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function approve(TaskRequest $request)
    {
        $request->approve();

        return back()->withSuccess('');
    }
}
