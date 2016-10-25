<?php

if (! function_exists('filter')) {
    /**
     * The filters helper function.
     *
     * @return \App\Helpers\Filter
     */
    function filter()
    {
        return app('filter');
    }
}
