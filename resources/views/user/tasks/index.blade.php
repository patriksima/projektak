@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="mdl-cell mdl-cell--12-col">

    <tasks></tasks>

</div>
@endsection

@push('scripts')
    <script src="/js/user/tasks.js"></script>
@endpush
