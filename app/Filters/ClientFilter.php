<?php

namespace App\Filters;

use Koch\Filters\Filter;

class ClientFilter extends Filter
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
        'rate' => 'rate',
    ];
}
