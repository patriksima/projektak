@extends('layouts.app')

@section('title', 'Clients')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    @if ($search)
    <h6>Výsledek vyhledávání pro výraz: {{ $search }}</h6>
    @endif
    <table class="mdl-data-table mdl-js-data-table">
        <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('name') }}" data-orderby="name" data-orderdir="{{ Helper::getOrderDir('name') }}">Name</th>
                <th class="{{ Helper::getOrderByClass('rate') }}" data-orderby="rate" data-orderdir="{{ Helper::getOrderDir('rate') }}">Rate</th>
                <th class="mdl-data-table__cell--non-numeric">GDrive</th>
                <th class="mdl-data-table__cell--non-numeric">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($clients as $client)
            <tr class="">
                <td class="mdl-data-table__cell--non-numeric">{{ $client->name }}</td>
                <td>{{ $client->rate }} {{ $client->currency }}</td>
                <td class="mdl-data-table__cell--non-numeric">@if ($client->gdrive)<a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ $client->gdrive }}"><i class="material-icons">bookmark</i></a>@endif</td>
                <td class="mdl-data-table__cell--non-numeric">
                    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('ClientController@destroy', ['id' => $client->id]) }}" onclick="return confirm('Are u sure?!');"><i class="material-icons">delete</i></a>
                    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('ClientController@edit', ['id' => $client->id]) }}"><i class="material-icons">edit</i></a>
                    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('ProjectController@index', ['client_id' => $client->id]) }}"><i class="material-icons">assignment</i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="#add" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="client__add"><i class="material-icons">add</i></a>
    @include('clients.add')
</div>
@endsection

@push('scripts')
<script src="{{ elixir('js/clients.js') }}"></script>
@endpush