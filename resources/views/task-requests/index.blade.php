@extends('layouts.app')

@section('title', 'Task Requests')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    <table class="mdl-data-table mdl-js-data-table">
        <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric">Issued by</th>
                <th class="mdl-data-table__cell--non-numeric">For task</th>
                <th class="mdl-data-table__cell--non-numeric">Reason</th>
                <th class="mdl-data-table__cell--non-numeric">Time estimate</th>
                <th class="mdl-data-table__cell--non-numeric">Actions</th>
            </tr>
        </thead>

        <tbody>
            @each('task-requests._request', $requests, 'request')
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
    {{-- <script src="{{ elixir('js/projects.js') }}"></script> --}}
@endpush
