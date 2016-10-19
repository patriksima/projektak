<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    use Searchable, Orderable;

    /**
     * Default searchable columns.
     *
     * @var array
     */
    protected $searchable = ['name'];

    /**
     * Default orderable columns.
     *
     * @var array
     */
    protected $orderable = ['name' => 'name'];

    /**
     * Request data.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Builder instance.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Applies all available filters.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        // We need to select all columns from the original
        // table, since many joins can mess up the selected fields
        $this->builder->select("{$this->getTableName()}.*");

        foreach ($this->filters() as $name => $value) {
            $this->callFilterMethod($name, $value);
        }

        return $this->builder;
    }

    /**
     * Returns all filters from the request.
     *
     * @return array
     */
    public function filters()
    {
        return $this->request->all();
    }

    /**
     * Helper function to call each filter method.
     *
     * @param  string  $name
     * @param  string  $value
     */
    protected function callFilterMethod($name, $value)
    {
        call_user_func_array([$this, $name], array_filter([$value]));
    }

    /**
     * Returns the associated table name.
     *
     * @return string
     */
    protected function getTableName()
    {
        return $this->builder->getModel()->getTable();
    }
}
