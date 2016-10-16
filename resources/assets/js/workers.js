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

document.querySelectorAll('th.sortable').forEach(function(entry) {
    var asc  = entry.outerHTML.indexOf('sorted-asc');
    var desc = entry.outerHTML.indexOf('sorted-desc');

    entry.addEventListener('click', function() {
        location.href = '/workers?' + this.getAttribute('data-orderby') + '=' + this.getAttribute('data-orderdir');
    });
});
