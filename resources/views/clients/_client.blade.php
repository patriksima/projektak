<tr class="">
    <td class="mdl-data-table__cell--non-numeric">{{ $client->name }}</td>
    <td>{{ $client->rate }} {{ $client->currency }}</td>
    <td class="mdl-data-table__cell--non-numeric">
        @if ($client->gdrive)
            <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ $client->gdrive }}">
                <i class="material-icons">bookmark</i>
            </a>
        @endif
    </td>
    <td class="mdl-data-table__cell--non-numeric">
        <form
            action="/clients/{{ $client->id }}"
            class="delete-client"
            method="POST"
            style="display: inline;"
        >
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <a
                class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                onclick="if (confirm('Are you sure?!')) document.querySelector('.delete-client').submit();"
            >
                <i class="material-icons">delete</i>
            </a>
        </form>

        <a
            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
            href="/clients/{{ $client->id }}/edit"
        >
            <i class="material-icons">edit</i>
        </a>

        <a
            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
            href="{{ action('ProjectController@index', ['client_id' => $client->id]) }}"
        >
            <i class="material-icons">assignment</i>
        </a>
    </td>
</tr>
