<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Task;
use App\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ControlController extends Controller
{
    public function index()
    {
        $orderBy = Input::get('orderBy', 'deadline');
        $orderDir = Input::get('orderDir', 'desc');
        $search = Input::get('s', '');

        $tasks = DB::table('tasks')
            ->leftJoin('task_metas as tm1', function ($join) {
                $join->on('tasks.id', '=', 'tm1.task_id')
                     ->where('tm1.meta_key', '=', 'source_int-bc-count');
            })
            ->leftJoin('task_metas as tm2', function ($join) {
                $join->on('tasks.id', '=', 'tm2.task_id')
                     ->where('tm2.meta_key', '=', 'source_ext-bc-count');
            })
            ->leftJoin('task_statuses as ts', 'tasks.status_id', '=', 'ts.id')
            ->leftJoin('projects as p', 'tasks.project_id', '=', 'p.id')
            ->leftJoin('clients as c', 'c.id', '=', 'p.client_id')
            ->leftJoin('task_worker as wht', 'tasks.id', '=', 'wht.task_id')
            ->leftJoin('workers as w', 'w.id', '=', 'wht.worker_id')
            ->select('tasks.id', 'tasks.deadline', 'tasks.name', 'c.name as client', 'p.name as project', DB::raw('GROUP_CONCAT(DISTINCT w.name ORDER BY w.name DESC SEPARATOR ", ") workers'), 'ts.name as status', 'tasks.source_int', 'tasks.source_ext', DB::raw('MAX(tm1.meta_value) as source_int_c'), DB::raw('MAX(tm2.meta_value) as source_ext_c'))
            ->where('ts.order', '<>', 99)
            ->where('ts.order', '<>', 0)
            ->Where(function ($query) {
                $query->whereNull('tasks.checked')
                      ->orWhere(DB::raw('DATE_ADD(tasks.checked, INTERVAL 4 HOUR)'), '<', DB::raw('NOW()'));
            })
            ->groupBy('tasks.id')
            ->orderBy($orderBy, $orderDir);

        if ($search) {
            $tasks->where(function ($query) use ($search) {
                $query->where('tasks.name', 'like', $search)
                      ->orWhere('c.name', 'like', $search)
                      ->orWhere('p.name', 'like', $search);
            });
        }

        $tasks = $tasks->get();

        return view('control.index', [
            'orderBy'  => $orderBy,
            'orderDir' => $orderDir,
            'tasks'    => $tasks,
            'search'   => $search,
        ]);
    }

    public function done(Request $request)
    {
        $status = TaskStatus::where('order', 99)->first();

        Task::find($request->id)
            ->update(['status_id' => $status->id]);

        return back();
    }

    public function check(Request $request)
    {
        Task::find($request->id)
            ->update(['checked' => Carbon::now()]);

        Task::find($request->id)
            ->metas()
            ->where('meta_key', '=', 'source_int-bc-count')
            ->orWhere('meta_key', '=', 'source_ext-bc-count')
            ->update(['meta_value' => 0]);

        return back();
    }
}
