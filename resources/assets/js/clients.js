var dialog = document.querySelector('dialog');
var button = document.querySelector('#client__add');

if (! dialog.showModal) {
	dialogPolyfill.registerDialog(dialog);
}

button.addEventListener('click', function() {
	dialog.showModal();
});

dialog.querySelector('.close').addEventListener('click', function() {
	dialog.close();
});

document.querySelectorAll('th.sortable').forEach(function(entry) {
	var asc  = entry.outerHTML.indexOf('sorted-asc');
	var desc = entry.outerHTML.indexOf('sorted-desc');

	entry.addEventListener('click', function() {
		location.href = '/clients?' + this.getAttribute('data-orderby') + '=' + this.getAttribute('data-orderdir');
	});
});
