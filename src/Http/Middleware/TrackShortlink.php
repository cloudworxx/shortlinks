<?php

namespace RyanChandler\Shortlinks\Http\Middleware;

use Illuminate\Config\Repository;
use Illuminate\Http\Request;

class TrackShortlink
{
    /**
     * The shortlink config.
     * 
     * @var array
     */
    protected $config;

    /**
     * Create a new TrackShortlink instance.
     * 
     * @return void
     */
    public function __construct(Repository $config)
    {
        $this->config = $config->get('shortlinks');
    }

    /**
     * Handle the incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        $request->merge([
            'track_clicks' => $this->config['tracking']['track_clicks'] || $this->config['tracking'] === true,
            'track_ip' => $this->config['tracking']['track_ip'] || $this->config['tracking'] === true,
            'track_agent' => $this->config['tracking']['track_agent'] || $this->config['tracking'] === true,
        ]);

        return $next($request);
    }
}