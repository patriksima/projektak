<template>
    <div>
        <h3>Task Logs</h3>

        <table class="mdl-data-table mdl-js-data-table is-fullwidth" v-if="logs">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric sortable">
                        Total Last Month
                    </th>

                    <th class="mdl-data-table__cell--non-numeric sortable">
                        Total Last Week
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">
                        {{ total.month }}
                    </td>

                    <td class="mdl-data-table__cell--non-numeric">
                        {{ total.week }}
                    </td>
                </tr>
            </tbody>
        </table>

        <br>

        <table class="mdl-data-table mdl-js-data-table is-fullwidth" v-if="logs">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric sortable">
                        Start
                    </th>

                    <th class="mdl-data-table__cell--non-numeric sortable">
                        End
                    </th>

                    <th class="mdl-data-table__cell--non-numeric sortable">
                        Duration
                    </th>

                    <th class="mdl-data-table__cell--non-numeric sortable">
                        Task
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="log in logs">
                    <td class="mdl-data-table__cell--non-numeric">
                        {{ parseDate(log.start, 'd. m. yyyy, H:MM:ss') }}
                    </td>

                    <td class="mdl-data-table__cell--non-numeric">
                        {{ parseDate(log.end, 'd. m. yyyy, H:MM:ss') }}
                    </td>

                    <td class="mdl-data-table__cell--non-numeric">
                        {{ log.duration }}
                    </td>

                    <td class="mdl-data-table__cell--non-numeric">{{ log.task.name }}</td>
                </tr>
            </tbody>
        </table>

        <h4 v-else>No Task Logs Available</h4>
    </div>
</template>

<script>
import Crud from '../mixins/Crud';
import Time from '../mixins/DateTime';

export default {

    mixins: [Crud, Time],

    data() {
        return {
            logs: false,
            elapsed: 0,
            total: { month: 0, week: 0 },
        };
    },

    mounted() {
        this.loadTaskLogsForUser();

        this.getTotal('month');
        this.getTotal('week');
    },

    methods: {
        loadTaskLogsForUser() {
            this.$http.get('/api/tasks/logs')
                .then(({ body }) => this.modifyLogs(body));
        },

        modifyLogs(logs) {
            this.logs = logs.map(item => {
                return _.assignIn(
                    item,
                    { duration: this.getLogDuration(item) }
                );
            });
        },

        getLogDuration(log) {
            return this.getTimeDiff(Date.parse(log.start), Date.parse(log.end));
        },

        getTotal(period) {
            this.$http.get(`/api/tasks/total/${period}`)
                .then(({ body }) => this.total[period] = this.getTimeDiff(0, body * 1000));
        }
    }
};
</script>
