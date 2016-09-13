<?php

namespace App\Http\Controllers;

use DB;
use App\Client;
use App\ClientMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ClientController extends Controller
{
    public function index()
    {
        $orderBy  = Input::get('orderBy', 'created_at');
        $orderDir = Input::get('orderDir', 'desc');
        $search   = Input::get('s', '');

        $clients = DB::table('clients')
            ->select('clients.*', 'cm1.meta_value as rate', 'cm2.meta_value as gdrive', 'cm3.meta_value as currency')
            ->leftJoin('client_metas as cm1', function ($join) {
                $join->on('clients.id', '=', 'cm1.client_id')
                     ->where('cm1.meta_key', '=', 'rate');
            })
            ->leftJoin('client_metas as cm2', function ($join) {
                $join->on('clients.id', '=', 'cm2.client_id')
                     ->where('cm2.meta_key', '=', 'gdrive');
            })
            ->leftJoin('client_metas as cm3', function ($join) {
                $join->on('clients.id', '=', 'cm3.client_id')
                     ->where('cm3.meta_key', '=', 'currency');
            })
            ->orderBy($orderBy, $orderDir);

        if ($search) {
            $clients->where(function ($query) use ($search) {
                $query->where('name', 'like', $search);
            });
        }

        $clients = $clients->get();

        return view('clients.index', [
            'orderBy'  => $orderBy,
            'orderDir' => $orderDir,
            'clients'  => $clients,
            'search'   => $search,
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $client = Client::create([
                'name' => $request->name,
            ]);

            $meta = new ClientMeta;
            $meta->meta_key = 'rate';
            $meta->meta_value = $request->meta['rate'];
            Client::find($client->id)->metas()->save($meta);

            $meta = new ClientMeta;
            $meta->meta_key = 'currency';
            $meta->meta_value = $request->meta['currency'];
            Client::find($client->id)->metas()->save($meta);

            $meta = new ClientMeta;
            $meta->meta_key = 'gdrive';
            $meta->meta_value = $request->meta['gdrive'];
            Client::find($client->id)->metas()->save($meta);
        });

        return redirect('/clients');
    }

    public function update(Request $request)
    {
        DB::transaction(function () use ($request) {
            $client = Client::find($request->id);
            $client->name = $request->name;
            $client->save();

            $client->metas()->each(function ($m) use ($request) {
                switch ($m->meta_key) {
                    case 'rate':
                        $m->meta_value = $request->meta['rate'];
                        break;
                    case 'currency':
                        $m->meta_value = $request->meta['currency'];
                        break;
                    case 'gdrive':
                        $m->meta_value = $request->meta['gdrive'];
                        break;
                }
                $m->save();
            });
        });

        return redirect('/clients');
    }

    public function destroy(Request $request)
    {
        Client::destroy($request->id);
        return back();
    }

    public function edit(Request $request)
    {
        return view('clients.edit', [
            'client' => Client::find($request->id),
        ]);
    }
}
