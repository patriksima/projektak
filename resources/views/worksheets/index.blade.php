@extends('layouts.app')

@section('title', 'Worksheets')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    @if (isset($search))
        <h6>Výsledek vyhledávání pro výraz: {{ $search }}</h6>
    @endif

    <table class="mdl-data-table mdl-js-data-table">
        <thead>
            <tr>
                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('start') }}"
                    data-orderby="start"
                    data-orderdir="{{ filter()->invertOrderDirection('start') }}"
                >
                    Start
                </th>

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('end') }}"
                    data-orderby="end"
                    data-orderdir="{{ filter()->invertOrderDirection('end') }}"
                >
                    End
                </th>

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('worker') }}"
                    data-orderby="worker"
                    data-orderdir="{{ filter()->invertOrderDirection('worker') }}"
                >
                    Worker
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

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('task') }}"
                    data-orderby="task"
                    data-orderdir="{{ filter()->invertOrderDirection('task') }}"
                >
                    Task
                </th>

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('duration') }}"
                    data-orderby="duration"
                    data-orderdir="{{ filter()->invertOrderDirection('duration') }}"
                >
                    Duration
                </th>

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('cost') }}"
                    data-orderby="cost"
                    data-orderdir="{{ filter()->invertOrderDirection('cost') }}"
                >
                    Cost
                </th>
            </tr>
        </thead>
        <tbody>
            @each('worksheets._worksheet', $worksheets, 'worksheet')
        </tbody>
    </table>

    <a href="#" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="worksheet__add"><i class="material-icons">add</i></a>
    <a href="#" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--indigo" id="worksheet__import"><i class="material-icons">file_upload</i></a>
    @include('worksheets.add')
    @include('worksheets.filter')
    @include('worksheets.import')
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.0/vue-resource.js"></script>
<script src="/js/worksheets.js"></script>
@endpush
