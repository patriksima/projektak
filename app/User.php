<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Filterable;

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
     * Specifies the has one relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function worker()
    {
        return $this->hasOne(Worker::class);
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

    public function isAllowed()
    {
        return $this->allowed;
    }

    public function getCurrentSocialProvider()
    {
        return $this->socials()->orderBy('updated_at', 'desc')->first();
    }

    public function loadWorker()
    {
        $this->setRelation('worker', $this->workers->first());
    }

    public function getWorkerAttribute()
    {
        if (! array_key_exists('worker', $this->relations)) {
            $this->loadWorker();
        }

        return $this->getRelation('worker');
    }
}
