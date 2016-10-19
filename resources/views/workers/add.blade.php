<dialog class="mdl-dialog">
	<h4 class="mdl-dialog__title">Worker Add</h4>
	<form id="worker-form__add" action="{{ url('workers') }}" method="post">
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
    			<select name="type" class="mdl-selectfield__select">
    				<option value=""></option>
    				<option value="fulltime">full-time zaměstnanec</option>
    				<option value="parttime">part-time zaměstnanec</option>
    				<option value="dohodar">dohodář</option>
    				<option value="externista">externista</option>
    				<option value="majitel">majitel</option>
    			</select>
    			<label class="mdl-selectfield__label">Type</label>
    		</div>
    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    			<input class="mdl-textfield__input" type="text" name="job" value="" />
    			<label class="mdl-textfield__label">Job</label>
    		</div>
    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    			<input class="mdl-textfield__input" type="number" step="0.01" name="rate" value="" />
    			<label class="mdl-textfield__label">Rate</label>
    		</div>
    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    			<input class="mdl-textfield__input" type="date" name="birthday" value="" />
    			<label class="mdl-textfield__label">Birthday</label>
    		</div>
    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    			<input class="mdl-textfield__input" type="text" name="bank" value="" />
    			<label class="mdl-textfield__label">Bank account</label>
    		</div>
    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    			<textarea class="mdl-textfield__input" name="address"></textarea>
    			<label class="mdl-textfield__label">Address</label>
    		</div>
    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    			<textarea class="mdl-textfield__input" name="note"></textarea>
    			<label class="mdl-textfield__label">Note</label>
    		</div>
    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    			<input class="mdl-textfield__input" type="text" name="gdrive" value="" />
    			<label class="mdl-textfield__label">Google Drive</label>
    		</div>
    		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
    			<select name="status" class="mdl-selectfield__select">
    				<option value="active">Active</option>
    				<option value="inactive">Inactive</option>
    			</select>
    			<label class="mdl-selectfield__label">Status</label>
    		</div>
    	</div>

    	<div class="mdl-dialog__actions">
    		<button type="button" class="mdl-button close">Cancel</button>
    		<button type="submit" class="mdl-button add">Add</button>
    	</div>
    </form>
</dialog>
