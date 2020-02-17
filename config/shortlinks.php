<?php

return [

    'database_table_prefix' => env('SHORTLINKS_TABLE_PREFIX', 'shortlinks_'),

    'url_prefix' => env('SHORTLINKS_URL_PREFIX', 's'),

    'length' => env('SHORTLINKS_LENGTH', 8),

    'tracking' => [
        'track_clicks' => true,
        'track_ip' => false,
        'track_agent' => false,
    ],

];