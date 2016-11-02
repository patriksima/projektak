<dialog class="mdl-dialog">
	<h4 class="mdl-dialog__title">User Add</h4>
	<form id="user-form__add" action="{{ url('users') }}" method="post">
        {{ csrf_field() }}

    	<div class="mdl-dialog__content">
    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    			<input class="mdl-textfield__input" type="text" name="name" value="" required/>
    			<label class="mdl-textfield__label">Name</label>
    		</div>
    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    			<input class="mdl-textfield__input" type="text" name="email" value="" required/>
    			<label class="mdl-textfield__label">E-mail</label>
    		</div>
            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                <select name="worker" class="mdl-selectfield__select">
                    <option selected disabled>Select Worker</option>
                    @foreach ($workers as $worker)
                        <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                    @endforeach
                </select>
                <label class="mdl-selectfield__label">Worker</label>
            </div>
            <div class="mdl-layout-spacer"></div>
    		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
    			<select name="roles[]" class="mdl-selectfield__select" multiple>
                    @foreach ($roles as $role)
        				<option value="{{ $role->id }}">{{ $role->display_name }}</option>
                    @endforeach
    			</select>
    			<label class="mdl-selectfield__label">Roles</label>
    		</div>
			<div class="mdl-textfield">
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="allowed">
					<input name="allowed" value="1" type="checkbox" id="allowed" class="mdl-checkbox__input">
					<span class="mdl-checkbox__label">Allowed</span>
				</label>
			</div>
    	</div>

    	<div class="mdl-dialog__actions">
    		<button type="button" class="mdl-button close">Cancel</button>
    		<button type="submit" class="mdl-button add">Add</button>
    	</div>
    </form>
</dialog>
