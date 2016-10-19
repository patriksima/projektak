<tr class="{{ Helper::getRowClass($task->deadline, $task->status) }}">
    <td class="mdl-data-table__cell--non-numeric">
        @if ($task->deadline)
            {{ $task->deadline->format('j.n.Y') }}
        @endif
    </td>
    <td class="mdl-data-table__cell--non-numeric wrappable">{{ $task->name }}</td>
    <td class="mdl-data-table__cell--non-numeric wrappable">{{ $task->project->client->name }}</td>
    <td class="mdl-data-table__cell--non-numeric wrappable">{{ $task->project->name }}</td>
    <td class="mdl-data-table__cell--non-numeric wrappable">
        @foreach ($task->workers as $worker)
            <i
                id="tooltip-{{ $task->id }}-{{ $worker->id }}"
                class="material-icons mdl-color-text--blue">
                account_circle
            </i>

            <div class="mdl-tooltip" for="tooltip-{{ $task->id }}-{{ $worker->id }}">{{ $worker->name }}</div>
        @endforeach
    </td>
    <td class="mdl-data-table__cell--non-numeric">{{ $task->status->name }}</td>
    <td class="mdl-data-table__cell--non-numeric">
        @if($task->source_int)
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

        @if($task->source_ext)
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

        <form
            action="/control/{{ $task->id }}/complete"
            class="complete-task-{{ $task->id }}"
            method="POST"
            style="display: inline;"
        >
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <a
                class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                onclick="
                    if (confirm('Are you sure?!'))
                        document.querySelector('.complete-task-{{ $task->id }}').submit();
                "
            >
                <i class="material-icons">delete</i>
            </a>
        </form>

        <a
            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
            href="{{ action('TaskController@edit', ['id' => $task->id]) }}"
        >
            <i class="material-icons">edit</i>
        </a>

        <form
            action="/control/{{ $task->id }}/check"
            class="check-task-{{ $task->id }}"
            method="POST"
            style="display: inline;"
        >
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <a
                class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                onclick="
                    if (confirm('Are you sure?!'))
                        document.querySelector('.check-task-{{ $task->id }}').submit();
                "
            >
                <i class="material-icons">check</i>
            </a>
        </form>
    </td>
</tr>
