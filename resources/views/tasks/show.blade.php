@extends('layouts.app')

@section('title', $task->name)

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    <h1>{{ $task->name }}</h1>
</div>

@endsection

