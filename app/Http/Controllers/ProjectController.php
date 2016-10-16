<?php

namespace App\Http\Controllers;

use App\Client;
use App\Project;
use App\ProjectStatus;
use Illuminate\Http\Request;
use App\Filters\ProjectFilter;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectFilter $filter)
    {
        $projects = Project::filter($filter)->get();
        $clients = Client::orderBy('name')->get();
        $statuses = ProjectStatus::orderBy('name')->get();

        return view('projects.index', compact('projects', 'clients', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $project = Project::create(request()->all());

        Client::find(request('client_id'))
            ->projects()
            ->save($project);

        return back()->with('success', 'Project has been stored.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $clients = Client::orderBy('name')->get();
        $statuses = ProjectStatus::orderBy('name')->get();

        return view('projects.edit', compact('project', 'clients', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project)
    {
        $project->update(request()->all());

        Client::find(request('client_id'))
            ->projects()
            ->save($project);

        return redirect('/projects')->with('success', 'Project has been changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if ($project->worksheets->count() > 0 || $project->tasks->count() > 0) {
            return back()->with('danger', 'Project has worksheets or tasks still assigned.');
        }

        $project->delete();

        return back()->with('success', 'Project has been deleted.');
    }
}
