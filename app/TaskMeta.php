<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskMeta extends Model
{
    protected $fillable = ['meta_key', 'meta_value'];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
