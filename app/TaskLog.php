<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    protected $fillable = ['start', 'end', 'billable'];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
}
