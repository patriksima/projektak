<tr class="{{ Helper::getProjectRowClass($project->deadline, $project->status->slug) }}">
    <td class="mdl-data-table__cell--non-numeric">
        @if ($project->deadline)
            {{ $project->deadline->format('j.n.Y') }}
        @endif
    </td>
    <td class="mdl-data-table__cell--non-numeric">{{ $project->client->name }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $project->name }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $project->type }}</td>
    <td>{{ $project->duration() }}</td>
    <td>{{ $project->totalCost() }}</td>
    <td class="mdl-data-table__cell--non-numeric wrappable">{{ $project->note }}</td>
    <td class="mdl-data-table__cell--non-numeric">
        <form
            action="/projects/{{ $project->id }}"
            class="delete-project-{{ $project->id }}"
            method="POST"
            style="display: inline;"
        >
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <a
                class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                onclick="
                    if (confirm('Are you sure?!'))
                        document.querySelector('.delete-project-{{ $project->id }}').submit();
                "
            >
                <i class="material-icons">delete</i>
            </a>
        </form>

        <a
            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
            href="{{ action('ProjectController@edit', ['id' => $project->id]) }}"
        >
            <i class="material-icons">edit</i>
        </a>

        <a
            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
            href="{{ action('TaskController@index', ['project_id' => $project->id]) }}"
        >
            <i class="material-icons">assignment</i>
        </a>
    </td>
</tr>
