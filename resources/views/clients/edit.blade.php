@extends('layouts.app')

@section('title', 'Edit Client')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
	<form id="client-form__edit" action="{{ action('ClientController@update', $client->id) }}" method="post">
		{{ csrf_field() }}
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="name" value="{{ $client->name }}" required/>
			<label class="mdl-textfield__label">Name</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="number" name="meta[rate]" value="{{ Helper::getMeta($client->metas,'rate') }}" required/>
			<label class="mdl-textfield__label">Rate</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="meta[currency]" value="{{ Helper::getMeta($client->metas,'currency') }}" size="3" required/>
			<label class="mdl-textfield__label">Currency (CZK, USD, EUR)</label>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="meta[gdrive]" value="{{ Helper::getMeta($client->metas,'gdrive') }}" />
			<label class="mdl-textfield__label">Google Drive Link</label>
		</div>	
		<div class="mdl-layout-spacer"></div>
		<div>
			<a class="mdl-button mdl-js-button" href="{{ url()->previous() }}">Cancel</a>
			<input value="Save" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" />
		</div>
	</form>
</div>
@endsection
