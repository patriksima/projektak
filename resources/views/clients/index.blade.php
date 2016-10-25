@extends('layouts.app')

@section('title', 'Clients')

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
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('rate') }}"
                    data-orderby="rate"
                    data-orderdir="{{ filter()->invertOrderDirection('rate') }}"
                >
                    Rate
                </th>

                <th class="mdl-data-table__cell--non-numeric">GDrive</th>
                <th class="mdl-data-table__cell--non-numeric">Action</th>
            </tr>
        </thead>

        <tbody>
            @each('clients._client', $clients, 'client')
        </tbody>
    </table>

    <a
        href="#add"
        class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
        id="client__add"
    >
        <i class="material-icons">add</i>
    </a>

    @include('clients.add')
</div>
@endsection

@push('scripts')
<script src="{{ elixir('js/clients.js') }}"></script>
@endpush
