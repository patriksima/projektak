<?php

namespace App\Filters;

trait Searchable
{
    /**
     * Searches given columns.
     *
     * @param  string  $pattern
     * @return void
     */
    public function search($pattern)
    {
        foreach ($this->searchable as $column) {
            $this->builder->orWhere($column, 'regexp', $pattern);
        }
    }
}
