<form
    action="/user/tasks/request"
    class="task-request"
    method="POST"
>
    {{ csrf_field() }}

    <a
        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
        onclick="
            document.querySelector('.task-request').submit();
        "
    >
        Request a task
    </a>
</form>
