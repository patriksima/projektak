<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskRequest extends Model
{
    protected $fillable = ['estimate', 'reason'];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
}
