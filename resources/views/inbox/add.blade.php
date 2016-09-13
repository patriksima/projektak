<dialog class="mdl-dialog">
	<h4 class="mdl-dialog__title">Inbox Add</h4>
	<form id="inbox-form__add" action="{{ url('inbox') }}" method="post">
	<div class="mdl-dialog__content">
			<div class="mdl-textfield mdl-js-textfield">
				<textarea class="mdl-textfield__input" name="description" required></textarea>
				<label class="mdl-textfield__label">Description</label>
				<span class="mdl-textfield__error">Fill the description</span>
			</div>
			<div class="mdl-selectfield mdl-js-selectfield">
				<select name="client_id" class="mdl-selectfield__select" required>
					<option value=""></option>
					@foreach ($clients as $client)
					<option value="{{ $client->id }}">{{ $client->name }}</option>
					@endforeach
				</select>
				<label class="mdl-selectfield__label">Client</label>
				<span class="mdl-selectfield__error">Choose the client</span>
			</div>
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" type="text" name="source_int" value="" />
				<label class="mdl-textfield__label">Internal Source</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" type="text" name="source_ext" value="" />
				<label class="mdl-textfield__label">External Source</label>
			</div>
	</div>
	<div class="mdl-dialog__actions">
		<button type="button" class="mdl-button close">Cancel</button>
		<button type="submit" class="mdl-button add">Add</button>
	</div>
    {{ csrf_field() }}
    </form>
</dialog>