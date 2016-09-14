<template>
    <table v-if="active" class="mdl-data-table mdl-js-data-table" transition="fade">
        <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric" colspan="8">Active task</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="entry in data" v-if="entry.active" track-by="id">
                <td class="mdl-data-table__cell--non-numeric">{{ entry.deadline }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ entry.name }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ entry.client }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ entry.project }}</td>
                <td>{{ entry.estimate }}</td>
                <td>{{ entry.duration }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ entry.status }}</td>
                <td class="mdl-data-table__cell--non-numeric">
                    <mdl-button @click="timerStop(entry.id)" icon="stop"></mdl-button>
                </td>
            </tr>
        </tbody>
    </table><br>

    <table class="mdl-data-table mdl-js-data-table">
        <thead>
            <tr>
                <th v-for="key in columns" @click="sort(key)" :class="[key.class, key.orderby ? ' sortable' : '']" data-orderby="{{ key.orderby }}" data-orderdir="{{ key.orderdir }}">{{ key.name }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="entry in data" track-by="id" v-if="!entry.active">
                <td class="mdl-data-table__cell--non-numeric">{{ entry.deadline }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ entry.name }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ entry.client }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ entry.project }}</td>
                <td>{{ entry.estimate }}</td>
                <td>{{ entry.duration }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ entry.status }}</td>
                <td class="mdl-data-table__cell--non-numeric">
                    <mdl-button v-if="entry.ratio <= 100" @click="timerStart(entry.id)" icon="play_arrow"></mdl-button>
                    <mdl-button v-if="entry.ratio > 75" @click="requestDialog(entry.id)" icon="restore"></mdl-button>
                </td>
            </tr>
        </tbody>
    </table>
    <mdl-dialog id="request" v-ref:request :task="request.task"><mdl-dialog>
</template>

<script>
Vue.component('mdl-dialog', require('../components/Dialog.vue'));
Vue.component('mdl-button', require('../components/Button.vue'));

export default {
    data: function() {
        return {
            active: 0,
            request: {
                task: ''
            },
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
            data: [
            ]
        }
    },
    methods: {
        requestDialog(id) {
            this.request.task = 'Example task name';
            this.$refs.request.open()
        },
        timerStart: function(id) {
            let data = {
                task_id: id
            }
            this.$http.post('/user/api/task/start', data).then(
                function(response) {
                    this.getTasks(id);
                },
                function(response) {
                    console.error(response);
                }
            );
        },
        timerStop: function(id) {
            let data = {
                task_id: id
            }
            this.$http.post('/user/api/task/stop', data).then(
                function(response) {
                    this.getTasks(id);
                },
                function(response) {
                    console.error(response);
                }
            );
        },
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
    watch: {
        data: function (newVal, oldVal) {
            // watch active task
            for (let i=0; i<newVal.length; i++) {
                if (newVal[i].active) {
                    this.active = true;
                    return;
                }
            }
            this.active = false;
        }
    },
    ready: function() {
        this.getTasks();
        this.mdlRendering();
        let self = this;
        setInterval(function() {
            self.getTasks();
        }, 5000);
    }
};
</script>
