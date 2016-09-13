@extends('layouts.app')

@section('title', 'Workers')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    @if ($search)
    <h6>Výsledek vyhledávání pro výraz: {{ $search }}</h6>
    @endif
    <table class="mdl-data-table mdl-js-data-table">
        <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('lastname') }}" data-orderby="lastname" data-orderdir="{{ Helper::getOrderDir('lastname') }}">Name</th>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('type') }}" data-orderby="type" data-orderdir="{{ Helper::getOrderDir('type') }}">Type</th>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('job') }}" data-orderby="job" data-orderdir="{{ Helper::getOrderDir('job') }}">Job</th>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('birthday') }}" data-orderby="birthday" data-orderdir="{{ Helper::getOrderDir('birthday') }}">Birthday</th>
                <th class="{{ Helper::getOrderByClass('rate') }}" data-orderby="rate" data-orderdir="{{ Helper::getOrderDir('rate') }}">Rate</th>
                <th class="{{ Helper::getOrderByClass('costs') }}" data-orderby="costs" data-orderdir="{{ Helper::getOrderDir('costs') }}">Costs</th>
                <th class="mdl-data-table__cell--non-numeric">Note</th>
                <th class="mdl-data-table__cell--non-numeric">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($workers as $worker)
            <tr class="@if($worker->status=='inactive')mdl-color-text--grey-500 @endif">
                <td class="mdl-data-table__cell--non-numeric">{{ $worker->name }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ $worker->type }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ $worker->job }}</td>
                <td class="mdl-data-table__cell--non-numeric">@if ($worker->birthday){{ Carbon\Carbon::parse($worker->birthday)->format('j.n.Y') }}@endif</td>
                <td>{{ $worker->rate }}</td>
                <td>{{ $worker->costs }}</td>
                <td class="mdl-data-table__cell--non-numeric wrappable">{{ $worker->note }}</td>
                <td class="mdl-data-table__cell--non-numeric">
                    @if($worker->gdrive)<a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ $worker->gdrive }}" target="_new"><i class="material-icons">bookmark</i></a>@endif
                    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('WorkerController@destroy', ['id' => $worker->id]) }}" onclick="return confirm('Are u sure?!');"><i class="material-icons">delete</i></a>
                    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('WorkerController@edit', ['id' => $worker->id]) }}"><i class="material-icons">edit</i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="#" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="worker__add"><i class="material-icons">add</i></a>
    @include('workers.add')
</div>
@endsection

@push('scripts')
<script src="{{ elixir('js/workers.js') }}"></script>
@endpush