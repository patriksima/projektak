var sortable = document.querySelectorAll('th.sortable');
sortable.forEach(function(entry) {
	var asc  = entry.outerHTML.indexOf('sorted-asc');
	var desc = entry.outerHTML.indexOf('sorted-desc');

	entry.addEventListener('click', function() {
		location.href = '/control?orderBy=' + this.getAttribute('data-orderby') + '&orderDir=' + this.getAttribute('data-orderdir');
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
