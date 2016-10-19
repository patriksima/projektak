<dialog class="mdl-dialog">
    <form id="client-form__add" action="{{ url('clients') }}" method="post">
        {{ csrf_field() }}
    	<h4 class="mdl-dialog__title">Client Add</h4>
    	<div class="mdl-dialog__content">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" name="name" value="" required/>
				<label class="mdl-textfield__label">Name</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="number" name="rate" value="" required/>
				<label class="mdl-textfield__label">Rate</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" name="currency" value="CZK" size="3" required/>
				<label class="mdl-textfield__label">Currency (CZK, USD, EUR)</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" name="gdrive" value="" />
				<label class="mdl-textfield__label">Google Drive Link</label>
			</div>
    	</div>

    	<div class="mdl-dialog__actions">
    		<button type="button" class="mdl-button close">Cancel</button>
    		<button type="submit" class="mdl-button add">Add</button>
    	</div>
    </form>
</dialog>
