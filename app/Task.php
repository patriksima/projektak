<?php

namespace App;

use DB;
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

    public function scopeWithActivity($query)
    {
        return $query->leftJoin('task_logs as tl1', function ($join) {
            $join->on('tl1.task_id', '=', 'tasks.id')
                    ->whereNull('tl1.end');
        })
        ->addSelect(DB::raw('IF(tl1.id is not null and tl1.end is null, 1, 0) as active'));
    }

    /**
     * Return real task duration.
     */
    public function scopeWithDuration($query)
    {
        return $query->leftJoin('task_logs as tl2', 'tl2.task_id', '=', 'tasks.id')
            ->addSelect(DB::raw('ROUND(SUM(TIMESTAMPDIFF(MINUTE, tl2.`start`, IFNULL(tl2.`end`, CURRENT_TIMESTAMP)))/60, 2) as duration'))
            ->groupBy('tasks.id');
    }

    public function scopeWithStatus($query)
    {
        return $query->leftJoin('task_statuses', 'task_statuses.id', '=', 'tasks.status_id')
             ->addSelect('task_statuses.name as status')
             ->where('task_statuses.order', '<>', 99);
    }

    public function scopeWithProject($query)
    {
        return $query->leftJoin('projects', 'projects.id', '=', 'tasks.project_id')
             ->addSelect('projects.name as project');
    }

    public function scopeWithClient($query)
    {
        return $query->leftJoin('clients', 'clients.id', '=', 'projects.client_id')
             ->addSelect('clients.name as client');
    }

    public function scopeWithWorker($query)
    {
        return $query->join('task_worker', 'task_worker.task_id', '=', 'tasks.id');
    }
}
