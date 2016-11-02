<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Worker;
use App\Filters\UserFilter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserFilter $filter)
    {
        $users = User::filter($filter)->with('socials', 'roles')->get();
        $roles = Role::all();
        $workers = Worker::all();

        return view('users.index', compact('users', 'roles', 'workers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'roles.*' => 'required|exists:roles,id',
        ]);

        $user = User::create(request()->all());
        $user->roles()->attach(request('roles'));

        $user->worker()->delete();
        $user->worker()->save(Worker::find(request('worker')));

        return back()->with('success', 'User successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $workers = Worker::all();

        return view('users.edit', compact('user', 'roles', 'workers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $this->validate(request(), [
            'name' => 'required|min:5',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'roles.*' => 'required|exists:roles,id',
        ]);

        $user->update(request()->all());
        $user->roles()->detach();
        $user->roles()->attach(request('roles'));

        $user->worker()->delete();
        $user->worker()->save(Worker::find(request('worker')));

        return redirect('/users')->with('success', 'User successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('danger', 'You cannot delete yourself.');
        }

        $user->delete();

        return back()->with('success', 'User successfully deleted.');
    }
}
