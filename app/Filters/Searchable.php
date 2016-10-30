<?php

namespace App\Filters;

trait Searchable
{
    /**
     * Already loaded relations.
     *
     * @var array
     */
    protected $loaded = [];

    /**
     * Searches given columns.
     *
     * @param  string  $pattern
     * @return void
     */
    public function search($pattern)
    {
        foreach ($this->searchable as $column) {
            $this->resolveSearch($column, $pattern, $this->getTableName());
        }
    }

    /**
     * Recursively build up the search query.
     *
     * @param  string  $column
     * @param  string  $key
     * @param  string  $last
     * @return void
     */
    protected function resolveSearch($column, $key, $last = '')
    {
        if (strpos($column, '.')) {
            $scope = strstr($column, '.', true);
            $singular = str_singular($scope);
            $next = substr(strstr($column, '.'), 1, strlen(strstr($column, '.')) - 1);

            if (! in_array($scope, $this->loaded)) {
                $this->loaded[] = $scope;

                $this->builder->leftJoin($scope, "{$last}.{$singular}_id", "{$scope}.id");
            }

            return $this->resolveSearch($next, $key, $scope);
        }

        $this->builder->orWhere("{$last}.{$column}", 'regexp', $key);
    }
}
