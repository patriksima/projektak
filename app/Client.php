<?php

namespace App;

use Koch\Filters\Behavior\Filterable;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use Filterable;

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['name', 'rate', 'currency', 'gdrive'];

    /**
     * Specifies the has many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inboxes()
    {
        return $this->hasMany(Inbox::class);
    }

    /**
     * Specifies the has many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
