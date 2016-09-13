<?php

namespace Projektak;

use Auth;

class InboxTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testLoad()
    {
        Auth::loginUsingId(1);
        $this->visit('/inbox')
             ->see('Inbox');
    }

    public function testAddItem()
    {
        Auth::loginUsingId(1);
        $this->visit('/inbox')
             ->click('inbox__add')
             ->see('Inbox Add')
             ->type('Example description test', 'description')
             ->select(1, 'client_id')
             ->type('https://example.com/external', 'source_ext')
             ->type('https://example.com/internal', 'source_int')
             ->press('Add')
             ->see('Example description test');
    }
}
