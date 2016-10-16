@extends('layouts.app')

@section('title', 'Workers')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    @if (isset($search))
        <h6>Výsledek vyhledávání pro výraz: {{ $search }}</h6>
    @endif
    <table class="mdl-data-table mdl-js-data-table">
        <thead>
            <tr>
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

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('job') }}"
                    data-orderby="job"
                    data-orderdir="{{ filter()->invertOrderDirection('job') }}"
                >
                    Job
                </th>

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('birthday') }}"
                    data-orderby="birthday"
                    data-orderdir="{{ filter()->invertOrderDirection('birthday') }}"
                >
                    Birthday
                </th>

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('rate') }}"
                    data-orderby="rate"
                    data-orderdir="{{ filter()->invertOrderDirection('rate') }}"
                >
                    Rate
                </th>

                <th class="mdl-data-table__cell--non-numeric">Note</th>
                <th class="mdl-data-table__cell--non-numeric">Action</th>
            </tr>
        </thead>

        <tbody>
            @each('workers._worker', $workers, 'worker')
        </tbody>
    </table>
    <a href="#" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="worker__add"><i class="material-icons">add</i></a>
    @include('workers.add')
</div>
@endsection

@push('scripts')
<script src="/js/workers.js"></script>
@endpush
