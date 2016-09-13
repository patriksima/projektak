<template>
    <table class="mdl-data-table mdl-js-data-table">
        <thead>
            <tr>
                <th v-for="key in columns" @click="sort(key)" :class="[key.class, key.orderby ? ' sortable' : '']" data-orderby="{{ key.orderby }}" data-orderdir="{{ key.orderdir }}">{{ key.name }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="entry in data" track-by="id">
                <td class="mdl-data-table__cell--non-numeric">{{ entry['deadline'] }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ entry['name'] }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ entry['project'].client.name }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ entry['project'].name }}</td>
                <td>{{ entry['estimate'] }}</td>
                <td>{{ entry['durations'][0].aggregate }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ entry['status'].name }}</td>
                <td class="mdl-data-table__cell--non-numeric">
                    <a v-if="entry.tasklogs[0]" class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" @click="timerStop(entry.id)" href="#id={{ entry.id }}&amp;stop"><i class="material-icons">stop</i></a>
                    <a v-else class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" @click="timerStart(entry.id)" href="#id={{ entry.id }}&amp;start"><i class="material-icons">play_arrow</i></a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: [
        'columns',
        'data'
    ],
    methods: {
        sort: function (key) {
            this.$dispatch('sort', key);
        },
        timerStop: function (id) {
            this.$dispatch('timer-stop', id);
        },
        timerStart: function (id) {
            this.$dispatch('timer-start', id);
        }
    }
};
</script>
