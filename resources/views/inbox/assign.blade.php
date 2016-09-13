@extends('layouts.app')

@section('title', 'Inbox Assign')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
	<form id="inbox-form__assign" action="{{ action('InboxController@assignStore', $inbox->id) }}" method="post">
	    {{ csrf_field() }}
		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
			<select name="project_id" class="mdl-selectfield__select" required>
				<option value=""></option>
				@foreach ($projects as $project)
				<option value="{{ $project->id }}">{{ $project->name }}</option>
				@endforeach
			</select>
			<label class="mdl-selectfield__label">Project</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="name" value="" required/>
			<label class="mdl-textfield__label">Name</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
			<select name="status_id" class="mdl-selectfield__select" required>
				<option value=""></option>
				@foreach ($statuses as $status)
				<option value="{{ $status->id }}"@if($status->order==2) selected @endif>{{ $status->name }}</option>
				@endforeach
			</select>
			<label class="mdl-selectfield__label">Status</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
			<textarea class="mdl-textfield__input" name="description">{{ $inbox->description }}</textarea>
			<label class="mdl-textfield__label">Description</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
			<input class="mdl-textfield__input" type="text" name="source_int" value="" />
			<label class="mdl-textfield__label">Internal Source</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
			<input class="mdl-textfield__input" type="text" name="source_ext" value="" />
			<label class="mdl-textfield__label">External Source</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="date" name="deadline" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" />
			<label class="mdl-textfield__label">Deadline</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="estimate" value="1.0" />
			<label class="mdl-textfield__label">Estimate</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
			<select name="worker_id[]" multiple="multiple" size="10" class="mdl-selectfield__select" required>
				@foreach ($workers as $worker)
				<option value="{{ $worker->id }}">{{ $worker->name }}</option>
				@endforeach
			</select>
			<label class="mdl-selectfield__label">Workers</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div>
			<a class="mdl-button mdl-js-button" href="{{ url()->previous() }}">Cancel</a>
			<input value="Save" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" />
		</div>
	</form>
</div>
@endsection
