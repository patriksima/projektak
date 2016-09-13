<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{
    protected $fillable = ['client', 'project', 'task', 'description', 'start', 'end', 'duration', 'tags', 'amount', 'currency', 'billable'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('description', 'like', $search)
                      ->orWhere('client', 'like', $search)
                      ->orWhere('project', 'like', $search)
                      ->orWhere('task', 'like', $search)
                      ->orWhere('workers.name', 'like', $search);
            });
        }
    }

    public function scopeJoinWorkers($query)
    {
        return $query->leftJoin('workers', 'worksheets.worker_id', '=', 'workers.id')
                     ->addSelect('workers.name as worker');
    }

    public function scopeJoinProjects($query)
    {
        return $query->leftJoin('projects', 'worksheets.project_id', '=', 'projects.id')
                     ->addSelect('projects.name as project');
    }

    public function scopeJoinClients($query)
    {
        return $query->leftJoin('clients', 'projects.client_id', '=', 'clients.id')
                     ->addSelect('clients.name as client');
    }
}
