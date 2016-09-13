<dialog class="mdl-dialog">
	<h4 class="mdl-dialog__title">Project Add</h4>
	<form id="project-form__add" action="{{ url('projects') }}" method="post">
	<div class="mdl-dialog__content">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="date" name="deadline" value="" />
			<label class="mdl-textfield__label">Deadline</label>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="name" value="" required/>
			<label class="mdl-textfield__label">Name</label>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="type" value="" />
			<label class="mdl-textfield__label">Type</label>
		</div>
		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
			<select name="client_id" class="mdl-selectfield__select" required>
			    <option value=""></option>
				@foreach ($clients as $client)
				<option value="{{ $client->id }}">{{ $client->name }}</option>
				@endforeach
			</select>
			<label class="mdl-selectfield__label">Client</label>
		</div>
		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
			<select name="status_id" class="mdl-selectfield__select" required>
				@foreach ($statuses as $status)
				<option value="{{ $status->id }}">{{ $status->name }}</option>
				@endforeach
			</select>
			<label class="mdl-selectfield__label">Status</label>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
			<textarea class="mdl-textfield__input" name="note"></textarea>
			<label class="mdl-textfield__label">Note</label>
		</div>
	</div>
	<div class="mdl-dialog__actions">
		<button type="button" class="mdl-button close">Cancel</button>
		<button type="button" class="mdl-button add">Add</button>
	</div>
    {{ csrf_field() }}
    </form>	
</dialog>