<?php
namespace Projektak;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InboxTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testLoad()
    {
        $this->visit('/inbox')
             ->see('Inbox');
    }

    public function testAddItem()
    {
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
