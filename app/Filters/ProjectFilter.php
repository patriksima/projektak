<?php

namespace App\Filters;

use Koch\Filters\Filter;

class ProjectFilter extends Filter
{
    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = ['name', 'rate'];

    /**
     * Orderable columns.
     *
     * @var array
     */
    protected $orderable = [
        'name' => 'name',
        'type' => 'type',
        'deadline' => 'deadline',
        'client' => 'clients.name',
    ];
}
