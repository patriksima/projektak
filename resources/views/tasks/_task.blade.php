<tr class="{{ Helper::getRowClass($task->deadline, $task->status) }}">
    <td class="mdl-data-table__cell--non-numeric">
        @if ($task->deadline)
            {{ Carbon\Carbon::parse($task->deadline)->format('j.n.Y') }}
        @endif
    </td>
    <td class="mdl-data-table__cell--non-numeric wrappable">{{ $task->name }}</td>
    <td class="mdl-data-table__cell--non-numeric wrappable">{{ $task->client }}</td>
    <td class="mdl-data-table__cell--non-numeric wrappable">{{ $task->project }}</td>
    <td class="mdl-data-table__cell--non-numeric wrappable">
        @if ($task->workers)
            @foreach (explode('|',$task->workers) as $j=>$worker)
                <i id="tt{{ $loop->index }}-{{ $j }}" class="material-icons mdl-color-text--blue">account_circle</i>
                <div class="mdl-tooltip" for="tt{{ $loop->index }}-{{ $j }}">{{ $worker }}</div>
            @endforeach
        @endif
    </td>
    <td class="mdl-data-table__cell--non-numeric">{{ $task->status }}</td>
    <td class="mdl-data-table__cell--non-numeric">
        @if($task->source_int)
            <a
                class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                href="{{ $task->source_int }}"
                target="_new"
            >
                <i
                    class="material-icons @if($task->source_int_c) mdl-badge mdl-badge--overlap @endif"
                    data-badge="{{ $task->source_int_c }}"
                >
                    bookmark
                </i>
            </a>
        @endif

        @if($task->source_int)
        <a
            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
            href="{{ $task->source_ext }}"
            target="_new"
        >
            <i
                class="material-icons @if($task->source_ext_c) mdl-badge mdl-badge--overlap @endif"
                data-badge="{{ $task->source_ext_c }}"
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

        <a
            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
            href="{{ action('TaskController@destroy', ['id' => $task->id]) }}"
            onclick="return confirm('Are u sure?!');"
        >
            <i class="material-icons">delete</i>
        </a>

        <a
            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
            href="{{ action('TaskController@edit', ['id' => $task->id]) }}"
        >
            <i class="material-icons">edit</i>
        </a>
    </td>
</tr>
