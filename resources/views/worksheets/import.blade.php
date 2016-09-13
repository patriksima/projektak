<dialog id="worksheets-dialog__import" class="mdl-dialog import-dlg" style="min-width:840px;">
	<h4 class="mdl-dialog__title">Import Worksheet</h4>
	<div class="mdl-dialog__content">
		<ul class="mdl-stepper mdl-stepper--horizontal">
			<li class="mdl-step">
				<span class="mdl-step__label">
				    <span class="mdl-step__title">
						<span class="mdl-step__title-text">Import</span>
						<span class="mdl-step__title-message">Import data</span>
				    </span>
				</span>			
				<div class="mdl-step__content">
					<form id="worksheet-form__import" action="{{ action('WorksheetController@import') }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
							<input class="mdl-textfield__input" placeholder="CSV File" type="text" id="uploadFile" readonly required/>
							<div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
								<i class="material-icons">attach_file</i><input type="file" id="uploadBtn" name="worksheet">
							</div>
						</div>
						<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
							<select name="type" class="mdl-selectfield__select">
								<option value="toggl">Toggl</option>
							</select>
							<label class="mdl-selectfield__label">Type</label>
						</div>
					</form>
				</div>
				<div class="mdl-step__actions">
				    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised" data-stepper-next>
				      Continue
				    </button>
					<button class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-cancel>
					Cancel
					</button>
				    <button class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-back>
				      Back
				    </button>
				</div>				
			</li>
			<li class="mdl-step">
				<span class="mdl-step__label" @click="this.getAssignments()">
					<span class="mdl-step__title">
						<span class="mdl-step__title-text">Assignment</span>
						<span class="mdl-step__title-message">Assign data</span>
					</span>
				</span>
				<div class="mdl-step__content">
					<form id="worksheet-form__assign" action="{{ action('WorksheetController@assign') }}" method="post">
						{{ csrf_field() }}
						<table class="mdl-data-table mdl-js-data-table">
							<tr v-for="item in unassigned">
								<td class="mdl-data-table__cell--non-numeric">
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" value="@{{ item.client_project }}">
										<label class="mdl-textfield__label">Imported Project</label>
									</div>
								</td>
								<td class="mdl-data-table__cell--non-numeric">
									<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
										<select name="project_ids[@{{ item.client_project_hash }}]" class="mdl-selectfield__select" required="required">
											<option value=""></option>
											<option value="@{{ project.id }}" v-for="project in projects">@{{ project.client_project }}</option>
										</select>
										<label class="mdl-selectfield__label">Our Project</label>
									</div>
								</td>
							</tr>
						</table>
					</form>
				</div>
				<div class="mdl-step__actions">
				    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised" data-stepper-next>
				      Finish
				    </button>
					<button class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-cancel>
					Cancel
					</button>
				    <button class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-back>
				      Back
				    </button>
				</div>				
			</li>
		</ul>
	</div>
</dialog>
