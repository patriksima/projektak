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

if (! function_exists('socialite')) {
    /**
     * Socialite helper function.
     *
     * @param  string  $provider
     * @return \Laravel\Socialite\Contracts\Factory
     */
    function socialite($provider = null)
    {
        if (! $provider) {
            return app('Laravel\Socialite\Contracts\Factory');
        }

        return app('Laravel\Socialite\Contracts\Factory')->driver($provider);
    }
}
