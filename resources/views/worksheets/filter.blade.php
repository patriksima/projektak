<dialog id="worksheets-dialog__filter" class="mdl-dialog">
	<h4 class="mdl-dialog__title">Filters</h4>
	<div class="mdl-dialog__content">
		<form id="worksheets-form__filter" action="{{ url('worksheets') }}" method="get">
			{{ csrf_field() }}
			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
				<select name="worker_id" class="mdl-selectfield__select">
					<option value=""></option>
					@foreach ($workers as $worker)
					<option value="{{ $worker->id }}"@if($worker->id==Input::get('worker_id')) selected="selected"@endif>{{ $worker->name }}</option>
					@endforeach
				</select>
				<label class="mdl-selectfield__label">Worker</label>
			</div>
			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
				<select name="client_id" class="mdl-selectfield__select">
					<option value=""></option>
					@foreach ($clients as $client)
					<option value="{{ $client->id }}"@if($client->id==Input::get('client_id')) selected="selected"@endif>{{ $client->name }}</option>
					@endforeach
				</select>
				<label class="mdl-selectfield__label">Client</label>
			</div>
			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
				<select name="project_id" class="mdl-selectfield__select">
					<option value=""></option>
					@foreach ($projects as $project)
					<option value="{{ $project->id }}"@if($project->id==Input::get('project_id')) selected="selected"@endif>{{ $project->name }}</option>
					@endforeach
				</select>
				<label class="mdl-selectfield__label">Project</label>
			</div>
			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
				<select name="period" class="mdl-selectfield__select">
					<option value=""></option>
					<option value="lastweek" data-start="{{ \Carbon\Carbon::parse('Monday last week')->format('Y-m-d') }}" data-end="{{ \Carbon\Carbon::parse('Sunday last week')->format('Y-m-d') }}"@if('lastweek'==Input::get('period')) selected="selected"@endif>last week</option>
					<option value="lastmonth" data-start="{{ \Carbon\Carbon::parse('first day of last month')->format('Y-m-d') }}" data-end="{{ \Carbon\Carbon::parse('last day of last month')->format('Y-m-d') }}"@if('lastmonth'==Input::get('period')) selected="selected"@endif>last month</option>
					<option value="thisweek" data-start="{{ \Carbon\Carbon::parse('Monday this week')->format('Y-m-d') }}" data-end="{{ \Carbon\Carbon::parse('Sunday this week')->format('Y-m-d') }}"@if('thisweek'==Input::get('period')) selected="selected"@endif>this week</option>
					<option value="thismonth" data-start="{{ \Carbon\Carbon::parse('first day of this month')->format('Y-m-d') }}" data-end="{{ \Carbon\Carbon::parse('last day of this month')->format('Y-m-d') }}"@if('thismonth'==Input::get('period')) selected="selected"@endif>this month</option>
				</select>
				<label class="mdl-selectfield__label">Period</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="date" name="start" value="{{ Input::get('start') }}" />
				<label class="mdl-textfield__label">Start</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="date" name="end" value="{{ Input::get('end') }}" />
				<label class="mdl-textfield__label">End</label>
			</div>
			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
				<select name="round" class="mdl-selectfield__select">
					<option value=""></option>
					<option value="quarter"@if('quarter'==Input::get('round')) selected="selected"@endif>quarter up</option>
					<option value="half"@if('half'==Input::get('round')) selected="selected"@endif>half up</option>
					<option value="hour"@if('hour'==Input::get('round')) selected="selected"@endif>hour up</option>
				</select>
				<label class="mdl-selectfield__label">Round</label>
			</div>
			<div class="mdl-textfield">
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="detailed">
					<input name="detailed" value="1" type="checkbox" id="detailed" class="mdl-checkbox__input"@if(1==Input::get('detailed')) checked="checked"@endif>
					<span class="mdl-checkbox__label">Detailed</span>
				</label>
			</div>
		</form>
	</div>
	<div class="mdl-dialog__actions">
		<button type="button" class="mdl-button close">Cancel</button>
		<button type="button" class="mdl-button add">Filter</button>
	</div>                  
</dialog>