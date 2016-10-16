<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\Filters\ClientFilter;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Filters\ClientFilter  $filter
     * @return \Illuminate\Http\Response
     */
    public function index(ClientFilter $filter)
    {
        $clients = Client::filter($filter)->get();

        return view('clients.index', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Client::create(request()->all());

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
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Client $client)
    {
        $client->update(request()->all());

        return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::destroy($id);

        return back();
    }
}
