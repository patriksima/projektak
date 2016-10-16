<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $fillable = ['name', 'order'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
