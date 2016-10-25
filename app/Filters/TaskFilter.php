<?php

namespace App\Filters;

class TaskFilter extends Filter
{
    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = ['name', 'projects.clients.name'];

    /**
     * Orderable columns.
     *
     * @var array
     */
    protected $orderable = [
        'task' => 'name',
        'status' => 'status_id',
        'deadline' => 'deadline',
        'project' => 'projects.name',
        'client' => 'projects.clients.name',
    ];
}
