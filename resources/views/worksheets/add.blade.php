<dialog id="worksheets-dialog__add" class="mdl-dialog">
	<h4 class="mdl-dialog__title">Worksheet Add</h4>
    <form id="worksheet-form__add" action="{{ url('worksheets') }}" method="post">
        {{ csrf_field() }}
	   <div class="mdl-dialog__content">
			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
				<select name="worker_id" class="mdl-selectfield__select" required>
					<option value=""></option>
					@foreach ($workers as $worker)
					<option value="{{ $worker->id }}">{{ $worker->name }}</option>
					@endforeach
				</select>
				<label class="mdl-selectfield__label">Worker</label>
			</div>
			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
				<select name="project_id" class="mdl-selectfield__select" required>
					<option value=""></option>
					@foreach ($projects as $project)
					<option value="{{ $project->id }}"@if($project->id==Input::get('project_id')) selected="selected"@endif>{{ $project->name }}</option>
					@endforeach
				</select>
				<label class="mdl-selectfield__label">Project</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" name="task" value="" required>
				<label class="mdl-textfield__label">Task</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="date" name="start" value="" required>
				<label class="mdl-textfield__label">Start</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="date" name="end" value="" required>
				<label class="mdl-textfield__label">End</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="number" step="0.01" name="duration" value="" required>
				<label class="mdl-textfield__label">Duration</label>
			</div>
    	</div>
    	<div class="mdl-dialog__actions">
    		<button type="button" class="mdl-button close">Cancel</button>
    		<button type="submit" class="mdl-button add">Add</button>
    	</div>
    </form>
</dialog>
