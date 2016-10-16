<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['status_id', 'name', 'type', 'note', 'deadline'];

    protected $appends = ['duration', 'costs'];

    protected $hidden = ['durationSum', 'costsSum'];

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('projects.name', 'like', $search)
                      ->orWhere('projects.note', 'like', $search)
                      ->orWhere('clients.name', 'like', $search);
            });
        }
    }

    public function scopeJoinClients($query)
    {
        return $query->leftJoin('clients', 'clients.id', '=', 'projects.client_id')
                     ->addSelect('clients.name as client_name');
    }

    public function scopeJoinWorksheets($query)
    {
        return $query->leftJoin('worksheets', 'worksheets.project_id', '=', 'projects.id')
                     ->addSelect(DB::raw('sum(worksheets.duration) as duration'), DB::raw('sum(worksheets.amount) as costs'));
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function status()
    {
        return $this->belongsTo(ProjectStatus::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function worksheets()
    {
        return $this->hasMany(Worksheet::class);
    }

    public function durationSum()
    {
        return $this->hasOne(Worksheet::class)
            ->selectRaw('SUM(duration) as duration, project_id')
            ->groupBy('project_id');
    }

    public function costsSum()
    {
        return $this->hasOne(Worksheet::class)
            ->selectRaw('SUM(amount) as costs, project_id')
            ->groupBy('project_id');
    }

    public function getDurationAttribute()
    {
        if (! array_key_exists('durationSum', $this->relations)) {
            $this->load('durationSum');
        }

        $relation = $this->getRelation('durationSum');

        return ($relation) ? $relation->duration : null;
    }

    public function getCostsAttribute()
    {
        if (! array_key_exists('costsSum', $this->relations)) {
            $this->load('costsSum');
        }

        $relation = $this->getRelation('costsSum');

        return ($relation) ? $relation->costs : null;
    }
}
