@extends('layouts.app')

@section('title', 'Inbox')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    @if (isset($search))
        <h6>Výsledek vyhledávání pro výraz: {{ $search }}</h6>
    @endif

    <table class="mdl-data-table mdl-js-data-table">
        <thead>
            <tr>
                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('created') }}"
                    data-orderby="created"
                    data-orderdir="{{ filter()->invertOrderDirection('created') }}"
                >
                    Created
                </th>

                <th
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('client') }}"
                    data-orderby="client"
                    data-orderdir="{{ filter()->invertOrderDirection('client') }}"
                >
                    Client
                </th>

                <th class="mdl-data-table__cell--non-numeric">Description</th>
                <th class="mdl-data-table__cell--non-numeric">Action</th>
            </tr>
        </thead>

        <tbody>
            @each('inbox._message', $inbox, 'message')
        </tbody>
    </table>

    <a
        href="#add"
        class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
        id="inbox__add"
    >
        <i class="material-icons">add</i>
    </a>

    @include('inbox.add')
</div>
@endsection

@push('scripts')
<script src="/js/inbox.js"></script>
@endpush
