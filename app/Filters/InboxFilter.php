<?php

namespace App\Filters;

use Koch\Filters\Filter;

class InboxFilter extends Filter
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
        'created' => 'created_at',
        'client' => 'clients.name',
    ];
}
