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
        'name' => 'name',
        'type' => 'type',
        'job' => 'job',
        'birthday' => 'type',
        'rate' => 'rate',
    ];
}
