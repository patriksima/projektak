<?php

namespace App\Helpers;

class FilterHelper
{
    /**
     * @var array
     */
    protected $orderClasses = [
        'asc' => 'mdl-data-table__header--sorted-ascending',
        'desc' => 'mdl-data-table__header--sorted-descending',
    ];

    /**
     * Returns corresponding order class.
     *
     * @param  string  $column
     * @return string
     */
    public function orderClass($column)
    {
        if (request($column)) {
            return $this->orderClasses[
                strtolower(request($column))
            ];
        }

        return '';
    }

    /**
     * Returns corresponding order direction.
     *
     * @param  string  $column
     * @return string
     */
    public function getCurrentDirection($column)
    {
        return request($column);
    }

    /**
     * Inverts order direction.
     *
     * @param  string  $name
     * @return string
     */
    public function invertOrderDirection($name)
    {
        return $this->getCurrentDirection($name) == 'asc' ? 'desc' : 'asc';
    }
}
