<?php

namespace App\Http\Controllers;

use App\Worker;
use Illuminate\Http\Request;
use App\Filters\WorkerFilter;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WorkerFilter $filter)
    {
        $workers = Worker::filter($filter)->get();

        return view('workers.index', compact('workers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Worker::create(request()->all());

        return back()->with('success', 'Worker has been successfully added.');
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
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        return view('workers.edit', compact('worker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Worker $worker)
    {
        $worker->update(request()->all());

        return redirect('/workers')->with('success', 'Worker has been successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $worker = Worker::find($id);

        if ($worker->worksheets->count() > 0) {
            return back()->with('danger', 'Worker has worksheets.');
        }

        $worker->delete();

        return back()->with('success', 'Worker has been deleted.');
    }
}
