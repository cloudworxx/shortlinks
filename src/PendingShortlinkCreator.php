<?php

namespace RyanChandler\Shortlinks;

class PendingShortlinkCreator
{
    /**
     * The URL that this shortlink represents.
     * 
     * @var string
     */
    protected $url;

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
     * Handle the object's destruction.
     *
     * @return void
     */
    public function __destruct()
    {
        
    }
}