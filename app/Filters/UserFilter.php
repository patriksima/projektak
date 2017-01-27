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
    protected $searchable = ['email'];

    /**
     * Orderable columns.
     *
     * @var array
     */
    protected $orderable = [
        'email' => 'email',
    ];
}
