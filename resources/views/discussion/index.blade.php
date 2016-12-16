@extends('layouts.app')

@section('title', 'Discussion')

@section('content')
    <chat channel="{{ $channel }}"></chat>
@endsection

@push('scripts')
    <script src="/js/chat.js"></script>
@endpush
