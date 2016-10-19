<?php

namespace App\Filters;

class WorkerFilter extends Filter
{
    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = ['name', 'type'];

    /**
     * Orderable columns.
     *
     * @var array
     */
    protected $orderable = [
        'job' => 'job',
        'name' => 'name',
        'rate' => 'rate',
        'type' => 'type',
        'birthday' => 'type',
    ];
}
