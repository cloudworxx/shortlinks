<?php

namespace RyanChandler\Shortlinks;

use Illuminate\Config\Repository;

class Shortlinks
{
    /**
     * The shortlinks configurations.
     * 
     * @var array
     */
    protected $config;
    
    /**
     * Create a new Shortlinks instance.
     * 
     * @param  \Illuminate\Config\Repository  $config
     * @return void
     */
    public function __construct(Repository $config)
    {
        $this->config = $config->get('shortlinks');
    }

    /**
     * Create a shortlink for a route.
     * 
     * @param  string  $route
     * @param  array  $parameters
     * @param  bool  $absolute
     * @return \RyanChandler\Shortlinks\PendingShortlinkCreator
     */
    public function route(string $route, array $parameters = [], bool $absolute = true): PendingShortlink
    {
        return $this->url(route($route, $parameters, $absolute));
    }

    /**
     * Create a shortlink for a URL.
     * 
     * @param  string  $url
     * @return \RyanChandler\Shortlinks\PendingShortlinkCreator
     */
    public function url(string $url): PendingShortlink
    {
        return new PendingShortlink($url);
    }
}