
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('tasks', require('../components/Tasks.vue'));

const app = new Vue({
    el: 'div.demo-content',
    data: {
        columns: [
            {
                slug: 'deadline',
                name: 'Deadline',
                class: 'mdl-data-table__cell--non-numeric',
                orderby: 'deadline',
                orderdir: 'desc'
            },
            {
                slug: 'name',
                name: 'Task',
                class: 'mdl-data-table__cell--non-numeric',
                orderby: 'name',
                orderdir: 'desc'
            },
            {
                slug: 'client',
                name: 'Client',
                class: 'mdl-data-table__cell--non-numeric',
                orderby: 'client',
                orderdir: 'desc'
            },
            {
                slug: 'project',
                name: 'Project',
                class: 'mdl-data-table__cell--non-numeric',
                orderby: 'project',
                orderdir: 'desc'
            },
            {
                slug: 'estimate',
                name: 'Estimate',
                class: '',
                orderby: 'estimate',
                orderdir: 'desc'
            },
            {
                slug: 'duration',
                name: 'Duration',
                class: '',
                orderby: 'duration',
                orderdir: 'desc'
            },
            {
                slug: 'status',
                name: 'Status',
                class: 'mdl-data-table__cell--non-numeric',
                orderby: 'status',
                orderdir: 'desc'
            },
            {
                slug: 'action',
                name: 'Action',
                class: 'mdl-data-table__cell--non-numeric',
                orderby: '',
                orderdir: ''
            }
        ],
        data: []
    },
    events: {
        'timer-start': function(id) {
            let data = {
                task_id: id
            }
            this.$http.post('/user/api/task/start', data).then(
                function(response) {
                    this.getTasks(id);
                    this.active = true;
                },
                function(response) {
                    console.error(response);
                }
            );
        },
        'timer-stop': function(id) {
            let data = {
                task_id: id
            }
            this.$http.post('/user/api/task/stop', data).then(
                function(response) {
                    this.getTasks(id);
                    this.active = false;
                },
                function(response) {
                    console.error(response);
                }
            );
        }
    },
    methods: {
        getTasks: function(id) {
            let data = {
                task_id: id
            }
            this.$http.get('/user/api/tasks', data).then(
                function(response) {
                    this.data = response.json();
                },
                function(response) {
                    console.error(response);
                }
            );
        },
        mdlRendering: function() {
            setInterval(function() {
            	componentHandler.upgradeDom();
            	componentHandler.upgradeAllRegistered();
          	}, 100);
        }
    },
    ready: function() {
        this.getTasks();
        this.mdlRendering();
        let self = this;
        setInterval(function() {
            self.getTasks();
        }, 1000);
    }
});
