<?php
namespace Projektak;

use Auth;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
