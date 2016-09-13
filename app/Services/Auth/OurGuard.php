<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Log;
use Illuminate\Auth\SessionGuard;

class OurGuard extends SessionGuard
{
    public function user()
    {
        Log::info('OurGuard::user()');
        if (! is_null($this->user)) {
            if (! $this->user->isAllowed()) {
                Log::info('OurGuard::validate(): User is not allowed.');
            }
        }

        return parent::user();
    }

    public function validate(array $credentials = [])
    {
        Log::info('OurGuard::validate()');

        return parent::validate($credentials);
    }
}
