<?php

namespace App\Http\Controllers;

use DB;
use Input;
use App\Worker;
use App\Client;
use App\Project;
use App\Worksheet;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorksheetController extends Controller
{
    public function index()
    {
        $orderBy  = Input::get('orderBy', 'start');
        $orderDir = Input::get('orderDir', 'desc');
        $search   = Input::get('s', '');

        $filterStart = Input::get('start', Carbon::parse('first day of this month')->format('Y-m-d'));
        $filterEnd = Input::get('end', Carbon::parse('last day of this month')->format('Y-m-d'));

        $worksheets = Worksheet::select('worksheets.id', 'start', 'end', 'task', 'currency')
            ->joinWorkers()
            ->joinProjects()
            ->joinClients()
            ->search($search);

        if (Input::get('detailed')) {
            $worksheets->addSelect(DB::raw('`worksheets`.`amount` as `costs`'));
            $worksheets->groupBy('worksheets.id');
        } else {
            $worksheets->addSelect(DB::raw('SUM(`worksheets`.`amount`) as `costs`'));
            $worksheets->groupBy('worksheets.project_id', 'worksheets.task');
        }

        if (Input::get('worker_id')) {
            $worksheets->where('workers.id', '=', Input::get('worker_id'));
        }
        if (Input::get('client_id')) {
            $worksheets->where('clients.id', '=', Input::get('client_id'));
        }
        if (Input::get('project_id')) {
            $worksheets->where('projects.id', '=', Input::get('project_id'));
        }

        $worksheets->where(DB::raw('DATE(`start`)'), '>=', $filterStart);
        $worksheets->where(DB::raw('DATE(`end`)'), '<=', $filterEnd);

        switch (Input::get('round')) {
            case 'quarter':
                if (Input::get('detailed')) {
                    $worksheets->addSelect(DB::raw('TRUNCATE(CEIL((`worksheets`.`duration`)*4)/4,2) as `duration`'));
                } else {
                    $worksheets->addSelect(DB::raw('TRUNCATE(CEIL(SUM(`worksheets`.`duration`)*4)/4,2) as `duration`'));
                }
                break;
            case 'half':
                if (Input::get('detailed')) {
                    $worksheets->addSelect(DB::raw('TRUNCATE(CEIL((`worksheets`.`duration`)*2)/2,2) as `duration`'));
                } else {
                    $worksheets->addSelect(DB::raw('TRUNCATE(CEIL(SUM(`worksheets`.`duration`)*2)/2,2) as `duration`'));
                }
                break;
            case 'hour':
                if (Input::get('detailed')) {
                    $worksheets->addSelect(DB::raw('TRUNCATE(CEIL((`worksheets`.`duration`)),2) as `duration`'));
                } else {
                    $worksheets->addSelect(DB::raw('TRUNCATE(CEIL(SUM(`worksheets`.`duration`)),2) as `duration`'));
                }
                break;
            default:
                if (Input::get('detailed')) {
                    $worksheets->addSelect(DB::raw('TRUNCATE((`worksheets`.`duration`),2) as `duration`'));
                } else {
                    $worksheets->addSelect(DB::raw('TRUNCATE(SUM(`worksheets`.`duration`),2) as `duration`'));
                }
                break;
        }

        $worksheets = $worksheets->orderBy($orderBy, $orderDir);
        $worksheets = $worksheets->get();

        $workers = Worker::orderBy('name')->get();
        $clients = Client::orderBy('name')->get();
        $projects = DB::table('projects')
            ->leftJoin('clients', 'clients.id', '=', 'projects.client_id')
            ->select('projects.id', DB::raw('CONCAT(clients.name," - ",projects.name) as name'))
            ->orderBy('name', 'asc')
            ->get();

        return view('worksheets.index', [
            'orderBy'  => $orderBy,
            'orderDir' => $orderDir,
            'worksheets' => $worksheets,
            'workers'  => $workers,
            'clients'  => $clients,
            'projects' => $projects,
            'search'   => $search,
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $worker = Worker::find($request->worker_id)
                ->metas()
                ->where('meta_key', '=', 'rate')
                ->first();
            $amount = $worker->meta_value * $request->duration;

            $worksheet = new Worksheet;
            $worksheet->client = '';
            $worksheet->project = '';
            $worksheet->tags = '';
            $worksheet->currency = 'CZK';
            $worksheet->billable = 1;
            $worksheet->task = $request->task;
            $worksheet->description = $request->task;
            $worksheet->start = $request->start;
            $worksheet->end = $request->end;
            $worksheet->duration = $request->duration;
            $worksheet->amount = $amount;
            $worksheet->worker()->associate(Worker::find($request->worker_id));
            $worksheet->project()->associate(Project::find($request->project_id));
            $worksheet->save();

            $request->session()->flash('status', 'Worksheet has been saved.');
        });

        return back();
    }

    public function import(Request $request)
    {
        $row = -1;
        $imported = 0;
        $worker_id = 0;
        $worker_rate = 0;

        try {
            $fhandle = fopen($request->worksheet->getRealPath(), 'r');

            while (($data = fgetcsv($fhandle)) !== false) {
                $row++;

                // skip first line
                if (0 == $row) {
                    continue;
                }

                if (0 == $worker_id) {
                    $worker = Worker::where('email', '=', $data[1])->first();
                    if (is_null($worker)) {
                        $request->session()->flash('status', 'Worker was not found.');
                        return response()->json(['response' => 'fail', 'error' => 'Worker was not found.']);
                    }
                    $worker_id = $worker->id;
                    $worker_rate = $worker
                        ->metas()
                        ->where('meta_key', '=', 'rate')
                        ->first()
                        ->meta_value;
                }

                if ($data[9]) {
                    $start = Carbon::createFromFormat('Y-m-d H:i:s', $data[7] . ' ' . $data[8]);
                    $end   = Carbon::createFromFormat('Y-m-d H:i:s', $data[9] . ' ' . $data[10]);
                    $duration = $end->diffInMinutes($start) / 60;
                } else {
                    $start = Carbon::createFromFormat('Y-m-d H:i:s', $data[7] . ' ' . $data[8]);
                    $end   = Carbon::createFromFormat('Y-m-d H:i:s', $data[7] . ' ' . $data[8]);
                    list( $h, $m, $s ) = explode(':', $data[11]);
                    $duration = ( $h * 60 + $m ) / 60;
                }
                
                try {
                    $worksheet = new Worksheet;
                    $worksheet->project_id  = null;
                    $worksheet->client      = $data[2];
                    $worksheet->project     = $data[3];
                    $worksheet->task        = ($data[4] == '') ? $data[5] : $data[4];
                    $worksheet->description = $data[5];
                    $worksheet->start       = $start;
                    $worksheet->end         = $end;
                    $worksheet->duration    = $duration;
                    $worksheet->tags        = $data[12];
                    $worksheet->amount      = $worker_rate * $duration;
                    $worksheet->currency    = 'CZK';
                    $worksheet->billable    = ( 'Yes' == $data[6] ) ? 1 : 0;
                    $worksheet->worker()->associate($worker);
                    $worksheet->save();
                    $imported++;
                } catch (\Illuminate\Database\QueryException $e) {
                    // duplicated
                }
            }
            fclose($fhandle);

            $request->session()->flash('status', 'The '.$imported.' rows were been imported.');
        } catch (\ErrorException $e) {
            $request->session()->flash('status', 'Something wrong: '.$e->getMessage());
            return response()->json(['response' => 'fail', 'error' => $e->getMessage()]);
        }

        return response()->json(['response' => 'ok', 'imported' => $imported]);
    }

    public function assign(Request $request)
    {
        foreach ($request->project_ids as $hash => $project_id) {
            Worksheet::where(DB::raw('MD5(CONCAT(`client`," - ",`project`))'), '=', $hash)
                ->update(['project_id' => $project_id]);
        }

        return redirect('/worksheets');
    }

    public function apiUnassigned(Request $request)
    {
        return Worksheet::select(DB::raw('DISTINCT CONCAT(`client`," - ",`project`) as `client_project`'), DB::raw('MD5(CONCAT(`client`," - ",`project`)) as `client_project_hash`'))
            ->whereNull('project_id')
            ->orderBy('client_project', 'asc')
            ->get();
    }
}
