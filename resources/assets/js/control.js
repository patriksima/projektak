document.querySelectorAll('th.sortable').forEach(function(entry) {
    entry.addEventListener('click', function() {
        location.href = '/control?' + this.getAttribute('data-orderby') + '=' + this.getAttribute('data-orderdir');
    });
});
