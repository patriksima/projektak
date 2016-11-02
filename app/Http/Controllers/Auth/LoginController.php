<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Shows the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.login');
    }
}
