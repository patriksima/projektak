@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    @if (isset($search))
        <h6>Search result for: {{ $search }}</h6>
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
                    class="mdl-data-table__cell--non-numeric sortable {{ filter()->orderClass('email') }}"
                    data-orderby="type"
                    data-orderdir="{{ filter()->invertOrderDirection('email') }}"
                >
                    E-mail
                </th>

                <th
                    class="mdl-data-table__cell--non-numeric"
                >
                    Roles
                </th>

                <th
                    class="mdl-data-table__cell--non-numeric"
                >
                    Socials
                </th>

                <th class="mdl-data-table__cell--non-numeric">Action</th>
            </tr>
        </thead>

        <tbody>
            @each('users._user', $users, 'user')
        </tbody>
    </table>
    <a href="#" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="user__add"><i class="material-icons">add</i></a>
    @include('users.add')
</div>
@endsection

@push('scripts')
<script src="/js/users.js"></script>
@endpush
