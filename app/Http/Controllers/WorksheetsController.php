<?php

namespace App\Http\Controllers;

use App\Client;
use App\Worker;
use App\Project;
use App\Worksheet;
use Illuminate\Http\Request;
use App\Filters\WorksheetFilter;

class WorksheetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Filters\WorksheetFilter  $filter
     * @return \Illuminate\Http\Response
     */
    public function index(WorksheetFilter $filter)
    {
        $worksheets = Worksheet::filter($filter)->get();
        $workers = Worker::orderBy('name')->get();
        $clients = Client::orderBy('name')->get();
        $projects = Project::orderBy('name')->get();

        return view('worksheets.index', compact('worksheets', 'workers', 'clients', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $worker = Worker::find(request('worker_id'));
        $project = Project::find(request('project_id'));

        $worksheet = Worksheet::create(request()->all());

        $worksheet->description = request('task');
        $worksheet->currency = 'CZK';
        $worksheet->amount = request('duration') * $worker->rate;
        $worksheet->worker()->associate($worker);
        $worksheet->project()->associate($project);

        $worksheet->save();

        return back();
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
        //
    }

    public function import()
    {

    }

    public function assign()
    {

    }
}
