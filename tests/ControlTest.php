<?php

namespace Projektak;

use Auth;

class ControlTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoad()
    {
        Auth::loginUsingId(1);
        $this->visit('/control')
             ->see('Control');
    }
}
