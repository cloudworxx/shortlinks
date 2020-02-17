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
        $this->config = $config->get('shortlinks.tracking');
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
            'track_clicks' => $this->config['track_clicks'],
            'track_ip' => $this->config['track_ip'],
            'track_agent' => $this->config['track_agent'],
        ]);

        return $next($request);
    }
}