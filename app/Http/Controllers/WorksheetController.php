<?php

namespace App\Http\Controllers;

use DB;
use App\Worker;
use App\Client;
use App\Project;
use App\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorksheetController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
                    $start = Carbon::createFromFormat('Y-m-d H:i:s', $data[7].' '.$data[8]);
                    $end = Carbon::createFromFormat('Y-m-d H:i:s', $data[9].' '.$data[10]);
                    $duration = $end->diffInMinutes($start) / 60;
                } else {
                    $start = Carbon::createFromFormat('Y-m-d H:i:s', $data[7].' '.$data[8]);
                    $end = Carbon::createFromFormat('Y-m-d H:i:s', $data[7].' '.$data[8]);
                    list($h, $m, $s) = explode(':', $data[11]);
                    $duration = ($h * 60 + $m) / 60;
                }

                try {
                    $worksheet = new Worksheet;
                    $worksheet->project_id = null;
                    $worksheet->client = $data[2];
                    $worksheet->project = $data[3];
                    $worksheet->task = ($data[4] == '') ? $data[5] : $data[4];
                    $worksheet->description = $data[5];
                    $worksheet->start = $start;
                    $worksheet->end = $end;
                    $worksheet->duration = $duration;
                    $worksheet->tags = $data[12];
                    $worksheet->amount = $worker_rate * $duration;
                    $worksheet->currency = 'CZK';
                    $worksheet->billable = ('Yes' == $data[6]) ? 1 : 0;
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
