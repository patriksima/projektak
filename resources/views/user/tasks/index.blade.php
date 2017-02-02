@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="mdl-cell mdl-cell--12-col">

    <tasks></tasks>

</div>

{{-- <div class="mdl-cell mdl-cell--5-col">

    <task-log></task-log>

</div> --}}
@endsection

@push('scripts')
    <script src="/js/user/tasks.js"></script>
@endpush
