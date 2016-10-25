<?php

namespace App\Filters;

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
