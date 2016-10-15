@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    @if ($search)
        <h6>Výsledek vyhledávání pro výraz: {{ $search }}</h6>
    @endif

    <table class="mdl-data-table mdl-js-data-table">
        <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('deadline') }}" data-orderby="deadline" data-orderdir="{{ Helper::getOrderDir('deadline') }}">Deadline</th>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('name') }}" data-orderby="name" data-orderdir="{{ Helper::getOrderDir('name') }}">Task</th>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('client') }}" data-orderby="client" data-orderdir="{{ Helper::getOrderDir('client') }}">Client</th>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('project') }}" data-orderby="project" data-orderdir="{{ Helper::getOrderDir('project') }}">Project</th>
                <th class="mdl-data-table__cell--non-numeric">Workers</th>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('status') }}" data-orderby="status" data-orderdir="{{ Helper::getOrderDir('status') }}">Status</th>
                <th class="mdl-data-table__cell--non-numeric">Action</th>
            </tr>
        </thead>

        <tbody>
            @each('tasks._task', $tasks, 'task')
        </tbody>
    </table>

    <a
        class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
        href="#add"
        id="task__add"
    >
        <i class="material-icons">add</i>
    </a>

    @include('tasks.add')
</div>
@endsection

@push('scripts')
<script src="{{ elixir('js/tasks.js') }}"></script>
@endpush
