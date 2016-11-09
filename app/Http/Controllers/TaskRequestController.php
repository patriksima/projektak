<?php

namespace App\Http\Controllers;

use App\TaskRequest;
use App\Notifications\TimeRequestDenied;
use App\Notifications\TimeRequestApproved;
use App\Http\Controllers\Behavior\NotifiesUsers;

class TaskRequestController extends Controller
{
    use NotifiesUsers;

    /**
     * Handles listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = TaskRequest::with('task', 'worker')->get();

        return view('task-requests.index', compact('requests'));
    }

    /**
     * Handles approval of given task request.
     *
     * @param  \App\TaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function approve(TaskRequest $request)
    {
        $this->notify($request->worker, new TimeRequestApproved($request));

        $request->approve();

        return back()->withSuccess('Request has been approved.');
    }

    /**
     * Handles denial of given task request.
     *
     * @param  \App\TaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function deny(TaskRequest $request)
    {
        $this->notify($request->worker, new TimeRequestDenied($request));

        $request->deny();

        return back()->withSuccess('Request has been denied');
    }
}
