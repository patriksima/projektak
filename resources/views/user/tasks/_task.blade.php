<tr class="{{ Helper::getRowClass($task->deadline, $task->status) }}">
    <td class="mdl-data-table__cell--non-numeric">{{ $task->deadline->format('j.n.Y') }}</td>
    <td class="mdl-data-table__cell--non-numeric wrappable">{{ $task->name }}</td>
    <td class="mdl-data-table__cell--non-numeric wrappable">{{ $task->project->client->name }}</td>
    <td class="mdl-data-table__cell--non-numeric wrappable">{{ $task->project->name }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $task->status->name }}</td>
    <td class="mdl-data-table__cell--non-numeric">
        @if ($task->source_int)
            <a
                class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                href="{{ $task->source_int }}"
                target="_new"
            >
                <i
                    class="material-icons{{ $task->source_int ? ' mdl-badge mdl-badge--overlap' : '' }}"
                >
                    bookmark
                </i>
            </a>
        @endif

        @if ($task->source_ext)
            <a
                class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                href="{{ $task->source_ext }}"
                target="_new"
            >
                <i
                    class="material-icons{{ $task->source_ext ? ' mdl-badge mdl-badge--overlap' : '' }}"
                >
                    bookmark_border
                </i>
            </a>
        @endif

        <a
            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
            href="/tasks/{{ $task->id }}"
        >
            <i class="material-icons">help</i>
        </a>
    </td>
</tr>
