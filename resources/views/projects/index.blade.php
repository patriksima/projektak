@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    @if ($search)
    <h6>Výsledek vyhledávání pro výraz: {{ $search }}</h6>
    @endif
    <table class="mdl-data-table mdl-js-data-table">
        <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('deadline') }}" data-orderby="deadline" data-orderdir="{{ Helper::getOrderDir('deadline') }}">Deadline</th>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('client_name') }}" data-orderby="client_name" data-orderdir="{{ Helper::getOrderDir('client_name') }}">Client</th>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('name') }}" data-orderby="name" data-orderdir="{{ Helper::getOrderDir('name') }}">Name</th>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('type') }}" data-orderby="type" data-orderdir="{{ Helper::getOrderDir('type') }}">Type</th>
                <th class="{{ Helper::getOrderByClass('duration') }}" data-orderby="duration" data-orderdir="{{ Helper::getOrderDir('duration') }}">Duration</th>
                <th class="{{ Helper::getOrderByClass('costs') }}" data-orderby="costs" data-orderdir="{{ Helper::getOrderDir('costs') }}">Costs</th>
                <th class="mdl-data-table__cell--non-numeric">Note</th>
                <th class="mdl-data-table__cell--non-numeric">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($projects as $project)
            <tr class="{{ Helper::getProjectRowClass($project->deadline, $project->status->slug) }}">
                <td class="mdl-data-table__cell--non-numeric">@if ($project->deadline){{ Carbon\Carbon::parse($project->deadline)->format('j.n.Y') }}@endif</td>
                <td class="mdl-data-table__cell--non-numeric">{{ $project->client->name }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ $project->name }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ $project->type }}</td>
                <td>{{ $project->duration }}</td>
                <td>{{ $project->costs }}</td>
                <td class="mdl-data-table__cell--non-numeric wrappable">{{ $project->note }}</td>
                <td class="mdl-data-table__cell--non-numeric">
                    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('ProjectController@destroy', ['id' => $project->id]) }}" onclick="return confirm('Are u sure?!');"><i class="material-icons">delete</i></a>
                    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('ProjectController@edit', ['id' => $project->id]) }}"><i class="material-icons">edit</i></a>
                    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('TaskController@index', ['project_id' => $project->id]) }}"><i class="material-icons">assignment</i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="#add" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="project__add"><i class="material-icons">add</i></a>
    @include('projects.add')
</div>
@endsection

@push('scripts')
<script src="/js/projects.js"></script>
@endpush
