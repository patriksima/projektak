<?php

namespace App\Http\Controllers;

use App\Task;
use App\Inbox;
use App\Client;
use App\Worker;
use App\Project;
use App\TaskStatus;
use App\Filters\InboxFilter;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InboxFilter $filter)
    {
        $inbox = Inbox::filter($filter)->with('client')->where('done', false)->get();

        $clients = Client::orderBy('name')->get();

        return view('inbox.index', compact('inbox', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Client::find(request('client_id'))->inboxes()->create(request()->all());

        return redirect('/inbox')->with('success', 'Inbox successfully updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function show(Inbox $inbox)
    {
        $projects = Project::orderBy('name')->get();
        $statuses = TaskStatus::orderBy('name')->get();
        $workers = Worker::orderBy('name')->get();

        return view('inbox.show',
            compact('inbox', 'projects', 'statuses', 'workers')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inbox::destroy($id);

        return back()->with('success', 'Task has been deleted');
    }

    /**
     * Set the completion status to one.
     *
     * @param  \App\Inbox  $message
     * @return \Illuminate\Http\Response
     */
    public function assign(Inbox $message)
    {
        $message->update(['done' => true]);

        // This code has been copied from TaskController@store
        // consider extracting a common method or w/e
        $task = Task::create(request()->all());

        Project::find(request('project_id'))
            ->tasks()
            ->save($task);

        foreach (request('worker_ids') as $id) {
            $task->workers()->attach($id);
        }

        return back()->with('success', 'Task has been completed');
    }

    /**
     * Set the completion status to one.
     *
     * @param  \App\Inbox  $message
     * @return \Illuminate\Http\Response
     */
    public function complete(Inbox $message)
    {
        $message->update(['done' => true]);

        return back()->with('success', 'Task has been completed');
    }
}
