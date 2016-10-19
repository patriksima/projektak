<?php

namespace App\Filters;

trait Orderable
{
    /**
     * Magic method to build up order queries.
     *
     * @param  string  $method
     * @param  array  $args
     * @return void
     */
    public function __call($method, $args)
    {
        if (! array_key_exists($method, $this->orderable)) {
            return;
        }

        $this->resolveOrder($this->orderable[$method], $args[0], $this->getTableName());
    }

    /**
     * Recursively build up the order query.
     *
     * @param  string  $column
     * @param  string  $key
     * @param  string  $last
     * @return void
     */
    protected function resolveOrder($column, $key, $last = '')
    {
        if (strpos($column, '.')) {
            $scope = strstr($column, '.', true);
            $singular = str_singular($scope);
            $next = substr(strstr($column, '.'), 1, strlen(strstr($column, '.')) - 1);

            $this->builder->join($scope, "{$last}.{$singular}_id", "{$scope}.id");

            return $this->resolveOrder($next, $key, $scope);
        }

        $this->builder->orderBy("{$last}.{$column}", $key);
    }
}
