<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser, $provider)
    {
        $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            $account->name = $providerUser->getName();
            $account->avatar = $providerUser->getAvatar();
            $account->save();

            return $account->user;
        } else {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $provider,
                'name' => $providerUser->getName(),
                'avatar' => $providerUser->getAvatar(),
            ]);

            $user = User::whereEmail($providerUser->getEmail())
                ->first();

            if (! $user) {
                // create user, but disable him
                $user = User::create([
                    'email'   => $providerUser->getEmail(),
                    'name'    => $providerUser->getName(),
                    'allowed' => 0,
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}
