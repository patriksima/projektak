<?php

namespace App\Filters;

use Koch\Filters\Filter;

class UserFilter extends Filter
{
    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = ['name', 'email'];

    /**
     * Orderable columns.
     *
     * @var array
     */
    protected $orderable = [
        'name' => 'name',
        'email' => 'email',
    ];
}
