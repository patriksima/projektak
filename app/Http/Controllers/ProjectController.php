<?php

namespace App\Http\Controllers;

use DB;
use App\Client;
use App\Project;
use App\ProjectStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProjectController extends Controller
{
    public function index()
    {
        $orderBy = Input::get('orderBy', 'deadline');
        $orderDir = Input::get('orderDir', 'desc');
        $search = Input::get('s', '');

        $projects = Project::with(['client', 'status'])
            ->select('projects.*')
            ->joinClients()
            ->joinWorksheets()
            ->search($search)
            ->groupBy('projects.id')
            ->orderBy($orderBy, $orderDir)
            ->get();

        $clients = Client::orderBy('name')->get();
        $statuses = ProjectStatus::orderBy('name')->get();

        return view('projects.index', [
            'orderBy'  => $orderBy,
            'orderDir' => $orderDir,
            'projects' => $projects,
            'search'   => $search,
            'clients'  => $clients,
            'statuses' => $statuses,
        ]);
    }

    public function destroy(Request $request)
    {
        try {
            Project::destroy($request->id);
        } catch (\Illuminate\Database\QueryException $e) {
            $request->session()->flash('status', 'Project cannot be deleted because has some tasks and worksheets.');
        }

        return back();
    }

    public function edit(Request $request)
    {
        $clients = Client::orderBy('name')->get();
        $statuses = ProjectStatus::orderBy('name')->get();

        return view('projects.edit', [
            'project'  => Project::find($request->id),
            'clients'  => $clients,
            'statuses' => $statuses,
        ]);
    }

    public function update(Request $request)
    {
        DB::transaction(function () use ($request) {
            $project = Project::find($request->id);
            $project->deadline = $request->deadline ?: null;
            $project->name = $request->name;
            $project->type = $request->type;
            $project->note = $request->note;
            $project->status_id = $request->status_id;

            Client::find($request->client_id)
                ->projects()
                ->save($project);

            $request->session()->flash('status', 'Project has been changed.');
        });

        return redirect('/projects');
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $project = new Project;
            $project->deadline = $request->deadline ?: null;
            $project->name = $request->name;
            $project->type = $request->type;
            $project->note = $request->note;
            $project->status_id = $request->status_id;

            Client::find($request->client_id)
                ->projects()
                ->save($project);

            $request->session()->flash('status', 'Project has been saved.');
        });

        return back();
    }

    public function apiIndex(Request $request)
    {
        return DB::table('projects')
            ->leftJoin('clients', 'clients.id', '=', 'projects.client_id')
            ->select('projects.id', DB::raw('CONCAT(`clients`.`name`," - ",`projects`.`name`) as `client_project`'))
            ->orderBy('client_project', 'asc')
            ->get();
    }
}
