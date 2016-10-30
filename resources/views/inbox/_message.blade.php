<tr class="{{ Helper::getInboxRowClass($message->created_at) }}">
    <td class="mdl-data-table__cell--non-numeric">{{ $message->created_at->format('j. n. Y') }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $message->client->name }}</td>
    <td class="mdl-data-table__cell--non-numeric wrappable">{{ $message->description }}</td>
    <td class="mdl-data-table__cell--non-numeric">
        @if($message->source_int)
            <a
                class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                href="{{ $message->source_int }}"
                target="_new"
            >
                <i class="material-icons">bookmark</i>
            </a>
        @endif

        @if($message->source_ext)
            <a
                class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                href="{{ $message->source_ext }}"
                target="_new"
            >
                <i class="material-icons">bookmark_border</i>
            </a>
        @endif

        <form
            action="/inbox/{{ $message->id }}"
            class="delete-message-{{ $message->id }}"
            method="POST"
            style="display: inline;"
        >
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <a
                class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                onclick="
                    if (confirm('Are you sure?!'))
                        document.querySelector('.delete-message-{{ $message->id }}').submit();
                "
            >
                <i class="material-icons">delete</i>
            </a>
        </form>

        <a
            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
            href="/inbox/{{ $message->id }}"
        >
            <i class="material-icons">help</i>
        </a>

        <form
            action="/inbox/{{ $message->id }}/complete"
            class="complete-message-{{ $message->id }}"
            method="POST"
            style="display: inline;"
        >
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <a
                class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                onclick="
                    if (confirm('Are you sure?!'))
                        document.querySelector('.complete-message-{{ $message->id }}').submit();
                "
            >
                <i class="material-icons">check</i>
            </a>
        </form>
</tr>
