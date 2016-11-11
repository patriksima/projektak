<?php

namespace App\Filters;

use Koch\Filters\Filter;

class WorksheetFilter extends Filter
{
    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = ['projects.name', 'workers.name', 'projects.clients.name'];

    /**
     * Orderable columns.
     *
     * @var array
     */
    protected $orderable = [
        'end' => 'end',
        'task' => 'task',
        'cost' => 'amount',
        'start' => 'start',
        'dration' => 'dration',
        'worker' => 'workers.name',
        'project' => 'projects.name',
        'client' => 'projects.clients.name',
    ];
}
