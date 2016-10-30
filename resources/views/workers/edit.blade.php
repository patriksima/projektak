@extends('layouts.app')

@section('title', 'Edit Worker')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
	<form id="task-form__edit" action="/workers/{{ $worker->id }}" method="post">
		{{ csrf_field() }}
        {{ method_field('PATCH') }}

		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="name" value="{{ $worker->name }}" required/>
			<label class="mdl-textfield__label">Name</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="email" value="{{ $worker->email }}" required/>
			<label class="mdl-textfield__label">E-mail</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
			<select name="type" class="mdl-selectfield__select">
				<option value=""></option>
				<option value="fulltime"@if($worker->type=='fulltime') selected @endif>full-time zaměstnanec</option>
				<option value="parttime"@if($worker->type=='parttime') selected @endif>part-time zaměstnanec</option>
				<option value="dohodar"@if($worker->type=='dohodar') selected @endif>dohodář</option>
				<option value="externista"@if($worker->type=='externista') selected @endif>externista</option>
				<option value="majitel"@if($worker->type=='majitel') selected @endif>majitel</option>
			</select>
			<label class="mdl-selectfield__label">Type</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="job" value="{{ $worker->job }}" />
			<label class="mdl-textfield__label">Job</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="number" step="0.01" name="rate" value="{{ $worker->rate }}" />
			<label class="mdl-textfield__label">Rate</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="date" name="birthday" value="{{ $worker->birthday }}" />
			<label class="mdl-textfield__label">Birthday</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="bank" value="{{ $worker->bank }}" />
			<label class="mdl-textfield__label">Bank account</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<textarea class="mdl-textfield__input" name="address">{{ $worker->address }}</textarea>
			<label class="mdl-textfield__label">Address</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<textarea class="mdl-textfield__input" name="note">{{ $worker->note }}</textarea>
			<label class="mdl-textfield__label">Note</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="gdrive" value="{{ $worker->gdrive }}" />
			<label class="mdl-textfield__label">Google Drive</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
			<select name="status" class="mdl-selectfield__select">
				<option value="active"@if($worker->status=='active') selected @endif>Active</option>
				<option value="inactive"@if($worker->status=='inactive') selected @endif>Inactive</option>
			</select>
			<label class="mdl-selectfield__label">Status</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div>
			<a class="mdl-button mdl-js-button" href="{{ url()->previous() }}">Cancel</a>
			<input value="Save" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" />
		</div>
	</form>
</div>
@endsection
