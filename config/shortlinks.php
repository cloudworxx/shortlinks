<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Table Prefix
    |--------------------------------------------------------------------------
    |
    | This will be used to prefix all of the tables created by shortlinks.
    |
    | You should only change this if you already have table named similar
    | to the ones generated here, but the chances of that are very slim.
    |
    */

    'database_table_prefix' => env('SHORTLINKS_TABLE_PREFIX', 'shortlinks_'),

    /*
    |--------------------------------------------------------------------------
    | URL Prefix
    |--------------------------------------------------------------------------
    |
    | This will be used to prefix all generated shortlinks, so that it can be
    | distinguished from regular routes in your application.
    |
    | e.g. /s/shortlink
    |
    */

    'url_prefix' => env('SHORTLINKS_URL_PREFIX', 's'),

    /*
    |--------------------------------------------------------------------------
    | Length
    |--------------------------------------------------------------------------
    |
    | This determines the length of the shortlink string generated. Obviously,
    | it's a shortlink so I wouldn't recommend going above 7 or 8.
    |
    | e.g. /s/12345678
    |
    */

    'length' => env('SHORTLINKS_LENGTH', 8),

    /*
    |--------------------------------------------------------------------------
    | Tracking
    |--------------------------------------------------------------------------
    |
    | This package provides some very basic tracking features so you can
    | gather stats from your shortlinks.
    |
    | Supported: true (enables all tracking stats), or default array provides
    |            more fine grained control over tracking.
    |
    */

    'tracking' => [
        'track_clicks' => true,
        'track_ip' => false,
        'track_agent' => false,
    ],

];