@extends('layouts.app')

@section('title', 'Project Edit')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
	<form id="project-form__edit" action="{{ action('ProjectController@update', $project->id) }}" method="post">
		{{ csrf_field() }}
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="date" name="deadline" value="{{ $project->deadline }}" />
			<label class="mdl-textfield__label">Deadline</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="name" value="{{ $project->name }}" required/>
			<label class="mdl-textfield__label">Name</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="type" value="{{ $project->type }}" />
			<label class="mdl-textfield__label">Type</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
			<select name="client_id" class="mdl-selectfield__select" required>
				@foreach ($clients as $client)
				<option value="{{ $client->id }}"@if($client->id==$project->client_id) selected @endif>{{ $client->name }}</option>
				@endforeach
			</select>
			<label class="mdl-selectfield__label">Client</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
			<select name="status_id" class="mdl-selectfield__select" required>
				@foreach ($statuses as $status)
				<option value="{{ $status->id }}"@if($status->id==$project->status_id) selected @endif>{{ $status->name }}</option>
				@endforeach
			</select>
			<label class="mdl-selectfield__label">Status</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
			<textarea class="mdl-textfield__input" name="note">{{ $project->note }}</textarea>
			<label class="mdl-textfield__label">Note</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div>
			<a class="mdl-button mdl-js-button" href="{{ url()->previous() }}">Cancel</a>
			<input value="Save" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" />
		</div>
	</form>
</div>
@endsection
