<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Requests;
use App\Client;
use App\Inbox;
use App\Task;
use App\TaskStatus;
use App\Worker;
use App\Project;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class InboxController extends Controller
{
    public function index()
    {
        $orderBy  = Input::get('orderBy', 'created_at');
        $orderDir = Input::get('orderDir', 'desc');
        $search   = Input::get('s', '');

        $inboxes = Inbox::withClients()
            ->done(0)
            ->search($search)
            ->orderBy($orderBy, $orderDir)
            ->get();

        $clients = Client::orderBy('name')->get();

        return view('inbox.index', [
            'orderBy'  => $orderBy,
            'orderDir' => $orderDir,
            'inboxes'  => $inboxes,
            'clients'  => $clients,
            'search'   => $search,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'client_id' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::to('/inbox')
                ->withInput()
                ->withErrors($validator);
        }

        Client::find($request->client_id)->inboxes()->create([
            'description' => $request->description,
            'source_int' => $request->source_int,
            'source_ext' => $request->source_ext,
            'done' => 0,
        ]);

        $request->session()->flash('status', 'Inbox has been created.');

        return redirect('/inbox');
    }

    public function destroy(Request $request)
    {
        Inbox::destroy($request->id);
        return back();
    }

    public function assign(Request $request)
    {
        $projects = DB::table('projects')
            ->leftJoin('clients', 'clients.id', '=', 'projects.client_id')
            ->select('projects.id', DB::raw('CONCAT(clients.name," - ",projects.name) as name'))
            ->orderBy('name', 'asc')
            ->get();
        $statuses = TaskStatus::orderBy('order')->get();
        $workers = Worker::orderBy('name')->get();

        return view('inbox.assign', [
            'inbox' => Inbox::find($request->id),
            'projects' => $projects,
            'statuses' => $statuses,
            'workers'  => $workers,
        ]);
    }

    public function assignStore(Request $request)
    {
        DB::transaction(function () use ($request) {
            $task = new Task;
            $task->status_id   = $request->status_id;
            $task->name        = $request->name;
            $task->description = $request->description;
            $task->source_int  = $request->source_int;
            $task->source_ext  = $request->source_ext;
            $task->deadline    = $request->deadline;
            $task->estimate    = $request->estimate;
            $task->checked     = Carbon::now();

            Project::find($request->project_id)
                ->tasks()
                ->save($task);

            foreach ($request->worker_id as $worker_id) {
                Worker::find($worker_id)->tasks()->attach($task->id);
            }

            Inbox::find($request->id)->update(['done'=>1]);
        });

        return redirect('/inbox');
    }

    public function done(Request $request)
    {
        Inbox::find($request->id)->update(['done'=>1]);
        return back();
    }
}
