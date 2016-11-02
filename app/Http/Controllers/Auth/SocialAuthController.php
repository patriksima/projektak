<?php

namespace App\Http\Controllers\Auth;

use App\SocialAccount;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Creates the auth request on given auth provider.
     *
     * @param  string  $provider
     * @return \Illuminate\Http\Response
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handles the social auth callback.
     *
     * @param  string  $provider
     * @return \Illuminate\Http\Response
     */
    public function callback($provider)
    {
        $rawUser = Socialite::driver($provider)->user();

        // We need to check whether the returned user already has this
        // type of social auth active. If yes, update it and return the
        // user. If not, create the account and further check
        // for existence of the user himself.
        if ($account = SocialAccount::existsFor($rawUser, $provider)->first()) {
            $user = $account->yield($rawUser);
        } else {
            $user = SocialAccount::createWithUser($rawUser, $provider);
        }

        // Finally we need to check whether the user is
        // allowed to enter our application.
        if ($user->isAllowed()) {
            auth()->login($user);
        }

        return redirect()->intended('/');
    }
}
