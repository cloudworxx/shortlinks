<?php

namespace RyanChandler\Shortlinks\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use RyanChandler\Shortlinks\Facades\Shortlinks;
use RyanChandler\Shortlinks\Models\Shortlink;

class ShortlinkTest extends TestCase
{
    use RefreshDatabase;
    
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
            'destination' => 'http://google.co.uk',
        ]);
    }

    /** @test */
    public function it_can_be_created_with_click_tracking()
    {
        $shortlink = Shortlinks::url('google.co.uk')
            ->trackClicks()
            ->generate();

        $this->assertInstanceOf(Shortlink::class, $shortlink);
        $this->assertDatabaseHas($this->tableName('shortlinks'), [
            'destination' => 'http://google.co.uk',
            'track_clicks' => true,
        ]);
    }

    /** @test */
    public function it_can_be_created_with_ip_tracking()
    {
        $shortlink = Shortlinks::url('google.co.uk')
            ->trackIp()
            ->generate();

        $this->assertInstanceOf(Shortlink::class, $shortlink);
        $this->assertDatabaseHas($this->tableName('shortlinks'), [
            'destination' => 'http://google.co.uk',
            'track_ip' => true,
        ]);
    }

    /** @test */
    public function it_can_be_created_with_agent_tracking()
    {
        $shortlink = Shortlinks::url('google.co.uk')
            ->trackAgent()
            ->generate();

        $this->assertInstanceOf(Shortlink::class, $shortlink);
        $this->assertDatabaseHas($this->tableName('shortlinks'), [
            'destination' => 'http://google.co.uk',
            'track_agent' => true,
        ]);
    }

    /** @test */
    public function it_can_be_created_with_custom_prefix()
    {
        $shortlink = Shortlinks::url('google.co.uk')
            ->withPrefix('u')
            ->generate();

        $this->assertInstanceOf(Shortlink::class, $shortlink);
        $this->assertDatabaseHas($this->tableName('shortlinks'), [
            'destination' => 'http://google.co.uk',
            'prefix' => 'u',
        ]);
    }

    /** @test */
    public function it_can_be_visited_and_will_redirect_to_destination()
    {
        $shortlink = Shortlinks::url('http://google.co.uk')
            ->generate();

        $response = $this->get($shortlink->fullUrl());

        $response->assertStatus(302)
            ->assertRedirect('http://google.co.uk');
    }

    /** @test */
    public function it_can_be_created_and_visited_with_click_tracking()
    {
        config(['shortlinks.tracking.track_clicks' => false]);

        $shortlink = Shortlinks::url('http://google.co.uk')
            ->trackClicks()
            ->generate();

        $this->assertDatabaseHas($this->tableName('shortlinks'), [
            'destination' => 'http://google.co.uk',
            'track_clicks' => true,
            'clicks' => 0
        ]);

        $this->get($shortlink->fullUrl());

        $this->assertDatabaseHas($this->tableName('shortlinks'), [
            'id' => $shortlink->id,
            'clicks' => 1,
        ]);

        $this->get($shortlink->fullUrl());

        $this->assertDatabaseHas($this->tableName('shortlinks'), [
            'id' => $shortlink->id,
            'clicks' => 2,
        ]);
    }

    /** @test */
    public function it_can_be_created_and_visited_with_ip_tracking()
    {
        $shortlink = Shortlinks::url('http://google.co.uk')
            ->trackIp()
            ->generate();

        $this->assertDatabaseHas($this->tableName('shortlinks'), [
            'destination' => 'http://google.co.uk',
            'track_ip' => true,
        ]);

        $this->get($shortlink->fullUrl(), [
            'REMOTE_ADDR' => '127.1.1.1',
        ]);

        $this->assertDatabaseHas($this->tableName('tracking'), [
            'shortlink_id' => $shortlink->id,
            'ip_address' => '127.1.1.1',
        ]);
    }

    /** @test */
    public function it_can_be_created_and_visited_with_agent_tracking()
    {
        $shortlink = Shortlinks::url('http://google.co.uk')
            ->trackAgent()
            ->generate();

        $this->assertDatabaseHas($this->tableName('shortlinks'), [
            'destination' => 'http://google.co.uk',
            'track_agent' => true,
        ]);

        $this->get($shortlink->fullUrl(), [
            'User-Agent' => 'Shortlinks PHPUnit Test Suite',
        ]);

        $this->assertDatabaseHas($this->tableName('tracking'), [
            'shortlink_id' => $shortlink->id,
            'agent' => 'Shortlinks PHPUnit Test Suite',
        ]);
    }

    /** @test */
    public function it_can_be_deleted_and_will_delete_all_tracking_data()
    {
        $shortlink = Shortlinks::url('http://google.co.uk')
            ->trackAgent()
            ->generate();

        $this->assertDatabaseHas($this->tableName('shortlinks'), [
            'destination' => 'http://google.co.uk',
            'track_agent' => true,
        ]);

        $this->get($shortlink->fullUrl(), [
            'User-Agent' => 'Shortlinks PHPUnit Test Suite',
        ]);

        $this->assertDatabaseHas($this->tableName('tracking'), [
            'shortlink_id' => $shortlinkId = $shortlink->id,
            'agent' => 'Shortlinks PHPUnit Test Suite',
        ]);

        $shortlink->delete();

        $this->assertDatabaseMissing($this->tableName('shortlinks'), [
            'destination' => 'http://google.co.uk',
            'track_agent' => true,
        ]);

        $this->assertDatabaseMissing($this->tableName('tracking'), [
            'shortlink_id' => $shortlinkId,
        ]);
    }
}
