<tr class="@if($worker->status=='inactive')mdl-color-text--grey-500 @endif">
    <td class="mdl-data-table__cell--non-numeric">{{ $worker->name }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $worker->type }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $worker->job }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $worker->birthday->format('j.n.Y') }}</td>
    <td>{{ $worker->rate }}</td>
    <td class="mdl-data-table__cell--non-numeric wrappable">{{ $worker->note }}</td>
    <td class="mdl-data-table__cell--non-numeric">
        @if ($worker->gdrive)
            <a
                class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                href="{{ $worker->gdrive }}"
                target="_new"
            >
                <i class="material-icons">bookmark</i>
            </a>
        @endif

        <form
            action="/workers/{{ $worker->id }}"
            class="delete-worker"
            method="POST"
            style="display: inline;"
        >
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <a
                class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                onclick="if (confirm('Are you sure?!')) document.querySelector('.delete-worker').submit();"
            >
                <i class="material-icons">delete</i>
            </a>
        </form>

        <a
            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
            href="/workers/{{ $worker->id }}/edit"
        >
            <i class="material-icons">edit</i>
        </a>
    </td>
</tr>
