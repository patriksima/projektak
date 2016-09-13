<?php

namespace Projektak;

use Auth;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        Auth::loginUsingId(1);
        $this->visit('/')
             ->see('Homepage');
    }
}
