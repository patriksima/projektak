<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name'];

    public function metas()
    {
        return $this->hasMany('App\ClientMeta');
    }

    public function inboxes()
    {
        return $this->hasMany('App\Inbox');
    }

    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
