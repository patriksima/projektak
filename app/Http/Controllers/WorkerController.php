<?php

namespace App\Http\Controllers;

use DB;
use Input;
use App\Worker;
use App\WorkerMeta;
use App\Http\Requests;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index()
    {
        $orderBy  = Input::get('orderBy', 'lastname');
        $orderDir = Input::get('orderDir', 'asc');
        $search   = Input::get('s', '');

        $workers = Worker::select('workers.*', DB::raw('SUBSTRING_INDEX(SUBSTRING_INDEX(workers.name, " ", 1), " ", -1) as firstname,
                SUBSTRING_INDEX(SUBSTRING_INDEX(workers.name, " ", 2), " ", -1) as lastname'))
            ->joinMetas()
            ->joinBanks()
            ->search($search)
            ->groupBy('workers.id');

/*
        if ($orderBy == 'birthday') {
            $workers = $workers->orderBy(DB::raw('MONTH(birthday)'), $orderDir);
            $workers = $workers->orderBy(DB::raw('DAY(birthday)'), $orderDir);
        } else {
            $workers = $workers->orderBy($orderBy, $orderDir);
        }
*/
        $workers = $workers->orderBy($orderBy, $orderDir);
        $workers = $workers->get();

        return view('workers.index', [
            'orderBy'  => $orderBy,
            'orderDir' => $orderDir,
            'workers'  => $workers,
            'search'   => $search,
        ]);
    }

    public function destroy(Request $request)
    {
        try {
            Worker::destroy($request->id);
            $request->session()->flash('status', 'Worker has been deleted.');
        } catch (\Illuminate\Database\QueryException $e) {
            $request->session()->flash('status', 'Worker cannot be deleted because has some worksheets.');
        }

        return back();
    }

    public function edit(Request $request)
    {
        $worker = Worker::select('workers.*', DB::raw('SUBSTRING_INDEX(SUBSTRING_INDEX(workers.name, " ", 1), " ", -1) as firstname,
                SUBSTRING_INDEX(SUBSTRING_INDEX(workers.name, " ", 2), " ", -1) as lastname'))
            ->joinMetas()
            ->groupBy('workers.id')
            ->find($request->id);

        return view('workers.edit', [
            'worker' => $worker,
        ]);
    }

    public function update(Request $request)
    {
        DB::transaction(function () use ($request) {
            $worker = Worker::find($request->id);
            $worker->name = $request->name;
            $worker->email = $request->email;
            $worker->metas()->delete();
            $worker->save();

            foreach ($request->meta as $meta_key => $meta_value) {
                $meta = new WorkerMeta;
                $meta->meta_key = $meta_key;
                $meta->meta_value = $meta_value;
                $worker->metas()->save($meta);
            }

            $request->session()->flash('status', 'Worker has been changed.');
        });

        return redirect('/workers');
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $worker = new Worker;
            $worker->name = $request->name;
            $worker->email = $request->email;
            $worker->save();

            foreach ($request->meta as $meta_key => $meta_value) {
                $meta = new WorkerMeta;
                $meta->meta_key = $meta_key;
                $meta->meta_value = $meta_value;
                $worker->metas()->save($meta);
            }

            $request->session()->flash('status', 'Worker has been saved.');
        });

        return back();
    }
}
