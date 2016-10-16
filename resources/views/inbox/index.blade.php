@extends('layouts.app')

@section('title', 'Inbox')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    @if ($search)
    <h6>Výsledek vyhledávání pro výraz: {{ $search }}</h6>
    @endif
    <table class="mdl-data-table mdl-js-data-table">
        <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('created_at') }}" data-orderby="created_at" data-orderdir="{{ Helper::getOrderDir('created_at') }}">Created</th>
                <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('client') }}" data-orderby="client" data-orderdir="{{ Helper::getOrderDir('client') }}">Client</th>
                <th class="mdl-data-table__cell--non-numeric">Description</th>
                <th class="mdl-data-table__cell--non-numeric">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($inboxes as $inbox)
            <tr class="{{ Helper::getInboxRowClass($inbox->created_at) }}">
                <td class="mdl-data-table__cell--non-numeric">{{ $inbox->created_at }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ $inbox->client }}</td>
                <td class="mdl-data-table__cell--non-numeric wrappable">{{ $inbox->description }}</td>
                <td class="mdl-data-table__cell--non-numeric">
                    @if($inbox->source_int)<a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ $inbox->source_int }}" target="_new"><i class="material-icons">bookmark</i></a>@endif
                    @if($inbox->source_int)<a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ $inbox->source_ext }}" target="_new"><i class="material-icons">bookmark_border</i></a>@endif
                    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('InboxController@destroy', ['id' => $inbox->id]) }}" onclick="return confirm('Are u sure?!');"><i class="material-icons">delete</i></a>
                    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('InboxController@assign', ['id' => $inbox->id]) }}"><i class="material-icons">assignment</i></a>
                    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('InboxController@done', ['id' => $inbox->id]) }}" onclick="return confirm('Are u sure?!');"><i class="material-icons">check</i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="#add" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="inbox__add"><i class="material-icons">add</i></a>
    @include('inbox.add')
</div>
@endsection

@push('scripts')
<script src="/js/inbox.js"></script>
@endpush
