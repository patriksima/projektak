<tr class="{{ $user->allowed ? '' : ' mdl-color-text--grey-500' }}">
    <td class="mdl-data-table__cell--non-numeric">{{ $user->name }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $user->email }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $user->roles->implode('display_name', ', ') }}</td>
    <td class="mdl-data-table__cell--non-numeric">
        {{ $user->socials->first() !== null ? ucfirst($user->socials->first()->provider) : 'None' }}
    </td>
    <td class="mdl-data-table__cell--non-numeric">
        @if (auth()->id() !== $user->id)
            <form
                action="/users/{{ $user->id }}"
                class="delete-user-{{ $user->id }}"
                method="POST"
                style="display: inline;"
            >
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <a
                    class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                    onclick="
                        if (confirm('Are you sure?!'))
                            document.querySelector('.delete-user-{{ $user->id }}').submit();
                    "
                >
                    <i class="material-icons">delete</i>
                </a>
            </form>
        @endif

        <a
            class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
            href="/users/{{ $user->id }}/edit"
        >
            <i class="material-icons">edit</i>
        </a>
    </td>
</tr>
