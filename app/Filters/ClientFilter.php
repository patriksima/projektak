<?php

namespace App\Filters;

class ClientFilter extends Filter
{
    use Searchable;

    /**
     * Searchable columns
     *
     * @var array
     */
    protected $searchable = ['name', 'rate'];

    /**
     * Order clients by their name.
     *
     * @param  string  $order
     * @return void
     */
    public function name($order)
    {
        $this->builder->orderBy('name', $order);
    }

    /**
     * Order clients by their name.
     *
     * @param  string  $order
     * @return void
     */
    public function rate($order)
    {
        $this->builder->orderBy('rate', $order);
    }
}
