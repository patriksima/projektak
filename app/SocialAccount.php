<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class SocialAccount extends Model
{
    /**
     * Fields that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'provider_user_id', 'provider', 'name', 'avatar'];

    /**
     * Specifies the belongs to relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check whether given user is already registered with given provider.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Laravel\Socialite\Contracts\User  $user
     * @param  string  $provider
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExistsFor($query, SocialiteUser $user, $provider)
    {
        return $query
            ->whereProvider($provider)
            ->whereProviderUserId($user->getId());
    }

    /**
     * Updates the social acount and returns associated user.
     *
     * @param  \Laravel\Socialite\Contracts\User  $user
     * @return \App\User
     */
    public function yield(SocialiteUser $user)
    {
        $this->name = $user->getName();
        $this->avatar = $user->getAvatar();
        $this->save();

        return $this->user;
    }

    /**
     * Creates a new social acount and also checks whether is has a user to
     * be assigned to
     *
     * @param  \Laravel\Socialite\Contracts\User  $user
     * @param  string  $provider
     * @return \App\User
     */
    public static function createWithUser(SocialiteUser $socialiteUser, $provider)
    {
        $account = SocialAccount::create([
            'provider_user_id' => $socialiteUser->getId(),
            'provider' => $provider,
            'name' => $socialiteUser->getName(),
            'avatar' => $socialiteUser->getAvatar(),
        ]);

        // Checking whether user has already been registered to the system
        // if not, creating a new instance and assigning the social account
        // to it. The allowed status is also set to 0.
        if (! $user = User::whereEmail($socialiteUser->getEmail())->first()) {
            $user = User::craftFromSocialite($socialiteUser);

            $account->user()->associate($user)->save();
        }

        return $user;
    }
}
