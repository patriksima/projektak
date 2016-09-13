var dialog = document.querySelector('dialog');
var button = document.querySelector('#worker__add');

if (! dialog.showModal) {
	dialogPolyfill.registerDialog(dialog);
}

button.addEventListener('click', function() {
	dialog.showModal();
});

dialog.querySelector('.close').addEventListener('click', function() {
	dialog.close();
});

dialog.querySelector('.add').addEventListener('click', function() {
	var requiredFields = dialog.querySelectorAll(
    	"input[required]:not(:disabled):not([readonly]):not([type=hidden])" +  
    	",select[required]:not(:disabled):not([readonly])"+
    	",textarea[required]:not(:disabled):not([readonly])");

	for (var i=0; i<requiredFields.length; i++){
		if (requiredFields[i].checkValidity() == false) {
			return;
		}
	}
	dialog.querySelector('#worker-form__add').submit();
});

var sortable = document.querySelectorAll('th.sortable');
sortable.forEach(function(entry) {
	var asc  = entry.outerHTML.indexOf('sorted-asc');
	var desc = entry.outerHTML.indexOf('sorted-desc');

	entry.addEventListener('click', function() {
		location.href = '/workers?orderBy=' + this.getAttribute('data-orderby') + '&orderDir=' + this.getAttribute('data-orderdir');
	});

	entry.addEventListener('mouseover', function() {
		if ( asc == -1 && desc == -1 ) {
			this.className = this.className.replace(' mdl-data-table__header--sorted-descending', '' );
			this.className += ' mdl-data-table__header--sorted-descending';
		}
		if ( asc == -1 && desc != -1 ) {
			this.className = this.className.replace(' mdl-data-table__header--sorted-descending', '' );
			this.className += ' mdl-data-table__header--sorted-ascending';
		}
		if ( asc != -1 && desc == -1 ) {
			this.className = this.className.replace(' mdl-data-table__header--sorted-ascending', '' );
			this.className += ' mdl-data-table__header--sorted-descending';
		}
	});

	entry.addEventListener('mouseout', function() {
		if ( asc == -1 && desc == -1 ) {
			this.className = this.className.replace(' mdl-data-table__header--sorted-descending', '' );
		}
		if ( asc == -1 && desc != -1 ) {
			this.className = this.className.replace(' mdl-data-table__header--sorted-ascending', '' );
			this.className += ' mdl-data-table__header--sorted-descending';
		}
		if ( asc != -1 && desc == -1 ) {
			this.className = this.className.replace(' mdl-data-table__header--sorted-descending', '' );
			this.className += ' mdl-data-table__header--sorted-ascending';
		}
	});
});
