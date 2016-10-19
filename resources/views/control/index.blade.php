@extends('layouts.app')

@section('title', 'Control')

@section('content')

<div class="mdl-cell mdl-cell--12-col">
    @if (isset($search))
        <h6>Výsledek vyhledávání pro výraz: {{ $search }}</h6>
    @endif

    <table class="mdl-data-table mdl-js-data-table">
        <thead>
            <tr>
                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('deadline') }}"
                    data-orderby="deadline"
                    data-orderdir="{{ filter()->invertOrderDirection('deadline') }}"
                >
                    Deadline
                </th>

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('task') }}"
                    data-orderby="task"
                    data-orderdir="{{ filter()->invertOrderDirection('task') }}"
                >
                    Task
                </th>

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('client') }}"
                    data-orderby="client"
                    data-orderdir="{{ filter()->invertOrderDirection('client') }}"
                >
                    Client
                </th>

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('project') }}"
                    data-orderby="project"
                    data-orderdir="{{ filter()->invertOrderDirection('project') }}"
                >
                    Project
                </th>

                <th class="mdl-data-table__cell--non-numeric">Workers</th>

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('status') }}"
                    data-orderby="status"
                    data-orderdir="{{ filter()->invertOrderDirection('status') }}"
                >
                    Status
                </th>

                <th class="mdl-data-table__cell--non-numeric">Action</th>
            </tr>
        </thead>

        <tbody>
            @each('control._task', $tasks, 'task', 'control._empty')
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script src="/js/control.js"></script>
@endpush
