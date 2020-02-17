<?php

namespace RyanChandler\Shortlinks\Tests;

use RyanChandler\Shortlinks\Facades\Shortlinks;
use RyanChandler\Shortlinks\Models\Shortlink;

class ShortlinkTest extends TestCase
{
    /** @test */
    public function it_can_be_created_from_route()
    {
        $shortlink = Shortlinks::route('shortlink', ['shortlink' => 'example'])->generate();

        $this->assertInstanceOf(Shortlink::class, $shortlink);
        $this->assertDatabaseHas($this->tableName('shortlinks'), [
            'destination' => 'http://localhost/s/example',
        ]);
    }

    /** @test */
    public function it_can_be_created_from_url()
    {
        $shortlink = Shortlinks::url('google.co.uk')->generate();

        $this->assertInstanceOf(Shortlink::class, $shortlink);
        $this->assertDatabaseHas($this->tableName('shortlinks'), [
            'destination' => 'google.co.uk',
        ]);
    }
}