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
        @foreach ($tasks as $i=>$task)
            <tr class="{{ Helper::getRowClass($task->deadline, $task->status) }}">
                <td class="mdl-data-table__cell--non-numeric">@if ($task->deadline){{ Carbon\Carbon::parse($task->deadline)->format('j.n.Y') }}@endif</td>
                <td class="mdl-data-table__cell--non-numeric wrappable">{{ $task->name }}</td>
                <td class="mdl-data-table__cell--non-numeric wrappable">{{ $task->client }}</td>
                <td class="mdl-data-table__cell--non-numeric wrappable">{{ $task->project }}</td>
                <td class="mdl-data-table__cell--non-numeric wrappable">
                @if ($task->workers)
                    @foreach (explode('|',$task->workers) as $j=>$worker)
                    <i id="tt{{ $i }}-{{ $j }}" class="material-icons mdl-color-text--blue">account_circle</i>
                    <div class="mdl-tooltip" for="tt{{ $i }}-{{ $j }}">{{ $worker }}</div>
                    @endforeach
                @endif
                </td>
                <td class="mdl-data-table__cell--non-numeric">{{ $task->status }}</td>
                <td class="mdl-data-table__cell--non-numeric">
                    @if($task->source_int)<a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ $task->source_int }}" target="_new"><i class="material-icons @if($task->source_int_c) mdl-badge mdl-badge--overlap @endif" data-badge="{{ $task->source_int_c }}">bookmark</i></a>@endif
                    @if($task->source_int)<a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ $task->source_ext }}" target="_new"><i class="material-icons @if($task->source_ext_c) mdl-badge mdl-badge--overlap @endif" data-badge="{{ $task->source_ext_c }}">bookmark_border</i></a>@endif
                    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('TaskController@destroy', ['id' => $task->id]) }}" onclick="return confirm('Are u sure?!');"><i class="material-icons">delete</i></a>
                    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('TaskController@edit', ['id' => $task->id]) }}"><i class="material-icons">edit</i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="#add" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="task__add"><i class="material-icons">add</i></a>
    @include('tasks.add')
</div>
@endsection

@push('scripts')
<script src="/js/tasks.js"></script>
@endpush
