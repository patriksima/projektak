<?php

namespace App\Http\Controllers;

use Socialite;
use App\SocialAccountService;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(SocialAccountService $service, $provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect("auth/$provider");
        }
        $authUser = $service->createOrGetUser($user, $provider);

        if ($authUser->isAllowed()) {
            Auth::login($authUser);
        }

        return redirect()->intended('/');
    }
}
