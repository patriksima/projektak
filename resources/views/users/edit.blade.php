@extends('layouts.app')

@section('title', 'User Edit')

@section('content')
<div class="mdl-cell mdl-cell--12-col">
	<form id="user-form__edit" action="/users/{{ $user->id }}" method="post">
		{{ csrf_field() }}
        {!! method_field('PATCH') !!}

        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
            <select name="worker" class="mdl-selectfield__select">
                <option selected disabled>Select Worker</option>
                @foreach ($workers as $worker)
                    <option
                        {{ $user->worker && $user->worker->id === $worker->id ? 'selected' : '' }}
                        value="{{ $worker->id }}"
                    >
                        {{ $worker->name }}
                    </option>
                @endforeach
            </select>
            <label class="mdl-selectfield__label">Worker</label>
        </div>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" name="email" value="{{ $user->email }}" required/>
            <label class="mdl-textfield__label">E-mail</label>
        </div>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
            <select name="roles[]" class="mdl-selectfield__select" multiple>
                @foreach ($roles as $role)
                    <option
                        {{ $user->roles->contains($role) ? 'selected' : '' }}
                        value="{{ $role->id }}"
                    >
                        {{ $role->display_name }}
                    </option>
                @endforeach
            </select>
            <label class="mdl-selectfield__label">Roles</label>
        </div>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-textfield">
            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="allowed">
                <input
                    name="allowed"
                    value="1"
                    type="checkbox"
                    id="allowed"
                    class="mdl-checkbox__input"
                    {{ $user->allowed ? 'checked' : '' }}
                >
                <span class="mdl-checkbox__label">Allowed</span>
            </label>
        </div>
		<div class="mdl-layout-spacer"></div>
		<div>
			<a class="mdl-button mdl-js-button" href="{{ url()->previous() }}">Cancel</a>
			<input value="Save" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" />
		</div>
	</form>
</div>
@endsection
