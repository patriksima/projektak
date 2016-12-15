<?php

namespace App;

use Koch\Filters\Behavior\Filterable;
use Illuminate\Notifications\Notifiable;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'allowed',
    ];

    /**
     * Specifies hidden fields.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Specifies the belongs to many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Specifies the has many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socials()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * Specifies the belongs to rlationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    /**
     * Checks whether the user has any of given roles.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasRole($name)
    {
        $name = is_array($name) ? $name : [$name];

        return (bool) array_filter($name, function ($element) {
            return $this->roles->contains('name', $element);
        });
    }

    /**
     * Determines whether the user is allowed to enter the application.
     *
     * @return bool
     */
    public function isAllowed()
    {
        return $this->allowed;
    }

    /**
     * Returns the most recently used social auth provider.
     *
     * @return \App\SocialAccount
     */
    public function getSocialAttribute()
    {
        return $this->socials()->orderBy('updated_at', 'desc')->first();
    }

    /**
     * Creates a user based on provided info.
     *
     * @param  \Laravel\Socialite\Contracts\User  $user
     * @return \App\User
     */
    protected function craftFromSocialite(SocialiteUser $user)
    {
        return self::create([
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'api_token' => str_random(60),
        ]);
    }
}
