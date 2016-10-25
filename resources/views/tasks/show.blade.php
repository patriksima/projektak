@extends('layouts.app')

@section('title', $task->name)

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    {{-- <h1>{{ $task->name }}</h1> --}}

    <chat channel="tasks.{{ $task->id }}.chat"></chat>
</div>

@endsection

@push('scripts')
    <script src="/js/chat.js"></script>
@endpush
