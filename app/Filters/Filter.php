<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
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
     * Helper function to apply all the filters.
     *
     * @param  string  $name
     * @param  string  $value
     */
    protected function callFilterMethod($name, $value)
    {
        if (method_exists($this, $name)) {
            call_user_func_array([$this, $name], array_filter([$value]));
        }
    }
}
