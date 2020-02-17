<?php

namespace RyanChandler\Shortlinks\Http\Controllers;

use Illuminate\Http\Request;
use RyanChandler\Shortlinks\Models\Shortlink;

class ShortlinkController
{
    public function __invoke(Request $request, Shortlink $shortlink)
    {
        if ($request->input('track_clicks') || $shortlink->track_clicks) {
            $shortlink->increment('clicks');
        }

        $tracking = [];

        if ($request->input('track_ip') || $shortlink->track_ip) {
            $tracking['ip_address'] = $request->ip();
        }

        if ($request->input('track_agent') || $shortlink->track_agent) {
            $tracking['agent'] = $request->userAgent();
        }

        if (!empty($tracking)) {
            $shortlink->tracking()->create($tracking);
        }
        
        return redirect()->to($shortlink->destination);
    }
}