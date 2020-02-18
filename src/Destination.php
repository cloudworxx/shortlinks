<?php

namespace RyanChandler\Shortlinks;

use Illuminate\Support\Str;

class Destination
{
    /**
     * The destination URL.
     * 
     * @var string
     */
    protected $url;

    /**
     * Create a new Destination instance.
     * 
     * @param  string  $url
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Get the scheme for the destination URL.
     * 
     * @return string
     */
    public function scheme(): string
    {
        return Str::before($this->url, '://');
    }

    /**
     * Check if the destination URL is secure.
     * 
     * @return bool
     */
    public function isSecure(): bool
    {
        return $this->scheme() === 'https';
    }

    /**
     * Get the string representation of the Destination object.
     * 
     * @return string
     */
    public function __toString(): string
    {
        return $this->url;
    }
}