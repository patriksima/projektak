var dialog = document.querySelector('#worksheets-dialog__add');
var button = document.querySelector('#worksheet__add');

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
	dialog.querySelector('#worksheet-form__add').submit();
});

document.querySelectorAll('th.sortable').forEach(function(entry) {
    var asc  = entry.outerHTML.indexOf('sorted-asc');
    var desc = entry.outerHTML.indexOf('sorted-desc');

    entry.addEventListener('click', function() {
        location.href = '/worksheets?' + this.getAttribute('data-orderby') + '=' + this.getAttribute('data-orderdir');
    });
});

var button3 = document.querySelector('#worksheet__import');
var dialog3 = document.querySelector('#worksheets-dialog__import');
var stepperElement = dialog3.querySelector('ul.mdl-stepper');
var Stepper;

if (! dialog3.showModal) {
	dialogPolyfill.registerDialog(dialog3);
}

button3.addEventListener('click', function() {
	dialog3.showModal();

	Stepper = stepperElement.MaterialStepper;

	stepperElement.querySelector('.mdl-step:nth-child(1)').addEventListener('onstepnext', function (event) {
		var form  = document.querySelector('#worksheet-form__import');
        var data  = new FormData(form);
            data.append('worksheet', form.querySelector('input[type="file"]').files[0]);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
            	json = JSON.parse(xhttp.responseText);
                if (json.response == 'fail') {
                	alert(json.error);
                }
                Stepper.next();
            }
        };
        xhttp.open("POST", form.getAttribute('action'), true);
        xhttp.send(data);
	});

	stepperElement.querySelector('.mdl-step:nth-child(1)').addEventListener('onstepcancel', function (event) {
		dialog3.close();
	});

	stepperElement.querySelector('.mdl-step:nth-child(2)').addEventListener('onstepnext', function (event) {
		var form = dialog3.querySelector('#worksheet-form__assign');
		var requiredFields = form.querySelectorAll(
	    	"input[required]:not(:disabled):not([readonly]):not([type=hidden])" +
	    	",select[required]:not(:disabled):not([readonly])"+
	    	",textarea[required]:not(:disabled):not([readonly])");

		for (var i=0; i<requiredFields.length; i++){
			if (requiredFields[i].checkValidity() == false) {
				return;
			}
		}
		form.submit();
	});

	stepperElement.querySelector('.mdl-step:nth-child(2)').addEventListener('onstepback', function (event) {
		Stepper.back();
	});

	stepperElement.querySelector('.mdl-step:nth-child(2)').addEventListener('onstepcancel', function (event) {
		dialog3.close();
	});
});

document.querySelector('#worksheets-form__filter  select[name="period"]').addEventListener('change', function() {
	document.querySelector('#worksheets-form__filter input[name="start"]').value = this.options.item(this.selectedIndex).dataset.start;
	document.querySelector('#worksheets-form__filter input[name="end"]').value = this.options.item(this.selectedIndex).dataset.end;
});

new Vue({
    el: '#worksheets-dialog__import',
    data: {
        unassigned: [],
        projects: []
    },
    methods: {
        getUnassigned: function() {
            this.$http.get('/api/worksheets/unassigned').then(
                function(response) {
                    this.$set('unassigned', response.body);
                },
                function(response) {
                }
            );
        },
        getProjects: function() {
            this.$http.get('/api/projects').then(
                function(response) {
                    this.$set('projects', response.body);
                },
                function(response) {
                }
            );
        },
        getAssignments: function() {
        	this.getUnassigned();
        	this.getProjects();
        }
    },
    ready: function() {
    	var vue = this;

    	stepperElement.querySelector('.mdl-step:nth-child(1)').addEventListener('onstepnext', function (event) {
        	vue.getAssignments();
        });
        // TODO: nextTick na template component, vue-mdl?
		setInterval(function() {
        	componentHandler.upgradeDom();
        	componentHandler.upgradeAllRegistered();
      	}, 100);
    }
});



