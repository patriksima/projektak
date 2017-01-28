<?php

namespace App\Http\Controllers;

use App\TimeRequest;
use App\Notifications\TimeRequestDenied;
use App\Notifications\TimeRequestApproved;
use App\Http\Controllers\Behavior\NotifiesUsers;

class TimeRequestController extends Controller
{
    use NotifiesUsers;

    /**
     * Handles listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = TimeRequest::with('worker', 'task.project.client')->get();

        return view('time-requests.index', compact('requests'));
    }

    /**
     * Handles approval of given task request.
     *
     * @param  \App\TimeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function approve(TimeRequest $request)
    {
        $this->notify($request->worker, new TimeRequestApproved($request));

        $request->approve();

        return back()->withSuccess('Request has been approved.');
    }

    /**
     * Handles denial of given task request.
     *
     * @param  \App\TimeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function deny(TimeRequest $request)
    {
        $this->notify($request->worker, new TimeRequestDenied($request));

        $request->deny();

        return back()->withSuccess('Request has been denied');
    }
}
