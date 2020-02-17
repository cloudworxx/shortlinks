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
    public function route(string $route, array $parameters = [], bool $absolute = true): PendingShortlinkCreator
    {
        return new PendingShortlinkCreator(route($route, $parameters, $absolute));
    }
}