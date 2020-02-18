<?php

namespace RyanChandler\Shortlinks;

use RyanChandler\Shortlinks\Models\Shortlink;

class PendingShortlink
{
    /**
     * The URL that this shortlink represents.
     * 
     * @var string
     */
    protected $url;

    /**
     * Whether clicks should be tracked.
     * 
     * @var bool
     */
    protected $trackClicks;

    /**
     * Whether the IP should be tracked.
     * 
     * @var bool
     */
    protected $trackIp;

    /**
     * Whether the user agent should be tracked.
     * 
     * @var bool
     */
    protected $trackAgent;

    /**
     * The prefix of the shortlink.
     * 
     * @var bool
     */
    protected $prefix;

    /**
     * Create a new PendingShortlinkCreator instance.
     * 
     * @param  string  $url
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Whether clicks should be tracked.
     * 
     * @param  bool  $track
     * @return \RyanChandler\Shortlinks\PendingShortlink
     */
    public function trackClicks(bool $track = true): PendingShortlink
    {
        $this->trackClicks = $track;

        return $this;
    }

    /**
     * Whether the IP should be tracked.
     * 
     * @param  bool  $track
     * @return \RyanChandler\Shortlinks\PendingShortlink
     */
    public function trackIp(bool $track = true): PendingShortlink
    {
        $this->trackIp = $track;

        return $this;
    }

    /**
     * Whether the user agent should be tracked.
     * 
     * @param  bool  $track
     * @return \RyanChandler\Shortlinks\PendingShortlink
     */
    public function trackAgent(bool $track = true): PendingShortlink
    {
        $this->trackAgent = $track;

        return $this;
    }

    /**
     * Change the prefix for this shortlink.
     * 
     * @param  string  $prefix
     * @return \RyanChandler\Shortlinks\PendingShortlink
     */
    public function withPrefix(string $prefix): PendingShortlink
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Generate the shortlink.
     * 
     * @return \RyanChandler\Shortlinks\Models\Shortlink
     */
    public function generate(): Shortlink
    {
        return Shortlink::create([
            'destination' => $this->url,
            'track_clicks' => $this->trackClicks,
            'track_ip' => $this->trackIp,
            'track_agent' => $this->trackAgent,
            'prefix' => $this->prefix,
        ]);
    }
}