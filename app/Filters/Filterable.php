<?php

namespace App\Filters;

trait Filterable
{
    /**
     * Assings the filter scope to a given model.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \App\Filters\Filter $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, Filter $filter)
    {
        return $filter->apply($query);
    }
}
