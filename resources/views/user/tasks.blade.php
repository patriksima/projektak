@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    @if ($search)
    <h6>Výsledek vyhledávání pro výraz: {{ $search }}</h6>
    @endif
    <tasks></tasks>
</div>
@endsection

@push('scripts')
<script src="/js/user/tasks.js"></script>
@endpush
