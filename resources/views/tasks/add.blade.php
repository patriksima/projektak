<dialog class="mdl-dialog">
	<h4 class="mdl-dialog__title">Task Add</h4>
    <form id="task-form__add" action="{{ url('tasks') }}" method="post">
        {{ csrf_field() }}

    	<div class="mdl-dialog__content">
    			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
    				<select name="project_id" class="mdl-selectfield__select" required>
    					<option value=""></option>
    					@foreach ($projects as $project)
    					<option value="{{ $project->id }}">{{ $project->name }}</option>
    					@endforeach
    				</select>
    				<label class="mdl-selectfield__label">Project</label>
    			</div>
    			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    				<input class="mdl-textfield__input" type="text" name="name" value="" required/>
    				<label class="mdl-textfield__label">Name</label>
    			</div>
    			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
    				<select name="status_id" class="mdl-selectfield__select" required>
    					<option value=""></option>
    					@foreach ($statuses as $status)
    					   <option value="{{ $status->id }}"@if($status->order==2) selected @endif>{{ $status->name }}</option>
    					@endforeach
    				</select>
    				<label class="mdl-selectfield__label">Status</label>
    			</div>
    			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    				<textarea class="mdl-textfield__input" name="description"></textarea>
    				<label class="mdl-textfield__label">Description</label>
    			</div>
    			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    				<input class="mdl-textfield__input" type="text" name="source_int" value="" />
    				<label class="mdl-textfield__label">Internal Source</label>
    			</div>
    			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    				<input class="mdl-textfield__input" type="text" name="source_ext" value="" />
    				<label class="mdl-textfield__label">External Source</label>
    			</div>
    			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    				<input class="mdl-textfield__input" type="date" name="deadline" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" />
    				<label class="mdl-textfield__label">Deadline</label>
    			</div>
    			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    				<input class="mdl-textfield__input" type="text" name="estimate" value="1.0" />
    				<label class="mdl-textfield__label">Estimate</label>
    			</div>
    			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
    				<select name="worker_ids[]" multiple="multiple" size="10" class="mdl-selectfield__select" required>
    					@foreach ($workers as $worker)
    					<option value="{{ $worker->id }}">{{ $worker->name }}</option>
    					@endforeach
    				</select>
    				<label class="mdl-selectfield__label">Workers</label>
    			</div>
    	</div>

    	<div class="mdl-dialog__actions">
    		<button type="button" class="mdl-button close">Cancel</button>
    		<button type="submit" class="mdl-button add">Add</button>
    	</div>
    </form>
</dialog>
