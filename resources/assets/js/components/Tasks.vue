<template>
    <div class="mdl-cell mdl-cell--12-col">
        <table class="mdl-data-table mdl-js-data-table" v-show="running">
            <tbody>
                <tr v-for="task in running">
                    <td class="mdl-data-table__cell--non-numeric wrappable">{{ elapsed }}</td>
                    <td class="mdl-data-table__cell--non-numeric wrappable">{{ task.name }}</td>
                    <td class="mdl-data-table__cell--non-numeric wrappable">{{ task.project.client.name }}</td>
                    <td class="mdl-data-table__cell--non-numeric wrappable">{{ task.project.name }}</td>
                    <td class="mdl-data-table__cell--non-numeric">
                        <a
                            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                            :href="task.source_int"
                            target="_new"
                            v-show="task.source_int"
                        >
                            <i
                                class="material-icons mdl-badge mdl-badge--overlap"
                            >
                                bookmark
                            </i>
                        </a>


                        <a
                            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                            :href="task.source_ext"
                            target="_new"
                            v-show="task.source_ext"
                        >
                            <i
                                class="material-icons mdl-badge mdl-badge--overlap"
                            >
                                bookmark_border
                            </i>
                        </a>

                        <a
                            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                            :href="link(task)"
                        >
                            <i class="material-icons">help</i>
                        </a>

                        <a
                            class="mdl-button mdl-js-button mdl-button--icon mdl-button--accent"
                            @click="stopTimer(task)"
                        >
                            <i class="material-icons">pause</i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <br v-show="running">

        <table class="mdl-data-table mdl-js-data-table" v-if="tasks">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric sortable">
                        Deadline
                    </th>

                    <th class="mdl-data-table__cell--non-numeric sortable">
                        Task
                    </th>

                    <th class="mdl-data-table__cell--non-numeric sortable">
                        Client
                    </th>

                    <th class="mdl-data-table__cell--non-numeric sortable">
                        Project
                    </th>

                    <th class="mdl-data-table__cell--non-numeric sortable">
                        Status
                    </th>

                    <th class="mdl-data-table__cell--non-numeric">Actions</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="task in tasks">
                    <td class="mdl-data-table__cell--non-numeric">{{ parseDate(task.deadline) }}</td>
                    <td class="mdl-data-table__cell--non-numeric wrappable">{{ task.name }}</td>
                    <td class="mdl-data-table__cell--non-numeric wrappable">{{ task.project.client.name }}</td>
                    <td class="mdl-data-table__cell--non-numeric wrappable">{{ task.project.name }}</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ task.status.name }}</td>
                    <td class="mdl-data-table__cell--non-numeric">
                        <a
                            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                            :href="task.source_int"
                            target="_new"
                            v-show="task.source_int"
                        >
                            <i
                                class="material-icons mdl-badge mdl-badge--overlap"
                            >
                                bookmark
                            </i>
                        </a>


                        <a
                            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                            :href="task.source_ext"
                            target="_new"
                            v-show="task.source_ext"
                        >
                            <i
                                class="material-icons mdl-badge mdl-badge--overlap"
                            >
                                bookmark_border
                            </i>
                        </a>

                        <a
                            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                            :href="link(task)"
                        >
                            <i class="material-icons">help</i>
                        </a>

                        <a
                            class="mdl-button mdl-js-button mdl-button--icon mdl-button--accent"
                            v-show="! running"
                            @click="startTimer(task)"
                        >
                            <i class="material-icons">play_arrow</i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <a
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
            @click.once="requestTask()"
            v-else
        >
            Request a task
        </a>
    </div>
</template>

<script>
import Crud from '../mixins/Crud';
import UserActions from '../mixins/UserActions';
import dateFormat from 'dateformat';

export default {

    mixins: [Crud, UserActions],

    data() {
        return {
            tasks: false,
            user: {},
            running: false,
            start: 0,
            elapsed: 0,
        };
    },

    mounted() {
        this.loadTasksForUser();

        this.loadLoggedUser();

        window.setInterval(() => this.time(), 1000);
    },

    methods: {
        loadTasksForUser() {
            this.$http.get('/api/tasks/forUser')
                .then(({ body }) => {
                    this.tasks = body;

                    this.loadRunningTasks();
                });
        },

        loadRunningTasks() {
            this.$http.get('/api/tasks/running')
                .then(({ body }) => {
                    this.running = [body.task];
                    this.start = Date.parse(body.start);

                    this.tasks = this.tasks.filter(item => item.id !== body.task.id);
                });
        },

        parseDate(date) {
            return dateFormat(
                Date.parse(date), 'mmmm dS, yyyy'
            );
        },

        link(task) {
            return `tasks/${task.id}`;
        },

        requestTask() {
            this.$http.post('/api/tasks/request');
        },

        startTimer(task) {
            this.running = [task];
            this.start = Date.now();

            this.tasks = this.tasks.filter(item => item.id !== task.id);

            this.$http.put(`/api/tasks/${task.id}/start`);
        },

        stopTimer(task) {
            this.running = false;

            this.tasks.push(task);

            this.$http.put(`/api/tasks/${task.id}/stop`);
        },

        time() {
            this.elapsed = this.getTimeDiff(this.start, Date.now());
        },

        getTimeDiff(datetime, now) {
            let diff = now - datetime;

            return `${Math.floor(diff/1000/3600)}:${dateFormat(new Date(diff), 'MM:ss')}`;
        }
    }
};
</script>
