<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['status_id', 'name', 'description', 'source_int', 'source_ext', 'deadline', 'estimate', 'checked'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function status()
    {
        return $this->belongsTo('App\TaskStatus');
    }

    public function metas()
    {
        return $this->hasMany('App\TaskMeta');
    }

    public function workers()
    {
        return $this->belongsToMany('App\Worker');
    }

    public function tasklogs()
    {
        return $this->hasMany('App\TaskLog');
    }


    public function durations()
    {
        return $this->hasMany('App\TaskLog')
            ->selectRaw('ROUND(SUM(TIMESTAMPDIFF(MINUTE, `end`, `start`))/60, 2) as aggregate, task_id')
            ->whereNotNull('end')
            ->groupBy('task_id');
    }
}
