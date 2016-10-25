@extends('layouts.app')

@section('title', 'Projects')

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
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('client') }}"
                    data-orderby="client"
                    data-orderdir="{{ filter()->invertOrderDirection('client') }}"
                >
                    Client
                </th>

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('name') }}"
                    data-orderby="name"
                    data-orderdir="{{ filter()->invertOrderDirection('name') }}"
                >
                    Name
                </th>

                <th
                class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('type') }}"
                    data-orderby="type"
                    data-orderdir="{{ filter()->invertOrderDirection('type') }}"
                >
                    Type
                </th>

                <th class="mdl-data-table__cell--non-numeric">Duration</th>
                <th class="mdl-data-table__cell--non-numeric">Total cost</th>
                <th class="mdl-data-table__cell--non-numeric">Note</th>
                <th class="mdl-data-table__cell--non-numeric">Action</th>
            </tr>
        </thead>

        <tbody>
            @each('projects._project', $projects, 'project')
        </tbody>
    </table>

    <a
        href="#add"
        class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
        id="project__add"
    >
        <i class="material-icons">add</i>
    </a>

    @include('projects.add')
</div>
@endsection

@push('scripts')
<script src="/js/projects.js"></script>
@endpush
