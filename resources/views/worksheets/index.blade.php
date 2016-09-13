@extends('layouts.app')

@section('title', 'Worksheets')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
    <div class="mdl-card mdl-shadow--4dp" style="width:100%">
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">@if ($search)Search result for term '{{ $search }}'@endif</h2>
        </div>
        <div class="mdl-card__menu">
            <a id="worksheet_filter" href="#"><i class="material-icons">filter_list</i></a>
        </div>
        <div class="mdl-card__supporting-text" style="width:100%">
            <table class="mdl-data-table mdl-js-data-table">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('start') }}" data-orderby="start" data-orderdir="{{ Helper::getOrderDir('start') }}">Start</th>
                        <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('end') }}" data-orderby="end" data-orderdir="{{ Helper::getOrderDir('end') }}">End</th>
                        <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('worker') }}" data-orderby="worker" data-orderdir="{{ Helper::getOrderDir('worker') }}">Worker</th>
                        <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('client') }}" data-orderby="client" data-orderdir="{{ Helper::getOrderDir('client') }}">Client</th>
                        <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('project') }}" data-orderby="project" data-orderdir="{{ Helper::getOrderDir('project') }}">Project</th>
                        <th class="mdl-data-table__cell--non-numeric {{ Helper::getOrderByClass('task') }}" data-orderby="task" data-orderdir="{{ Helper::getOrderDir('task') }}">Task</th>
                        <th class="{{ Helper::getOrderByClass('duration') }}" data-orderby="duration" data-orderdir="{{ Helper::getOrderDir('duration') }}">Duration</th>
                        <th class="{{ Helper::getOrderByClass('costs') }}" data-orderby="costs" data-orderdir="{{ Helper::getOrderDir('costs') }}">Costs</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($worksheets as $worksheet)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">{{ Carbon\Carbon::parse($worksheet->start)->format('j.n.Y') }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ Carbon\Carbon::parse($worksheet->end)->format('j.n.Y') }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $worksheet->worker }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $worksheet->client }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $worksheet->project }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $worksheet->task }}</td>
                        <td>{{ $worksheet->duration }}</td>
                        <td>{{ $worksheet->costs }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <a href="#" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="worksheet__add"><i class="material-icons">add</i></a>
    <a href="#" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--indigo" id="worksheet__import"><i class="material-icons">file_upload</i></a>
    @include('worksheets.add')
    @include('worksheets.filter')
    @include('worksheets.import')
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.0/vue-resource.js"></script>
<script src="{{ elixir('js/worksheets.js') }}"></script>
@endpush