<?php

return [

    'database_table_prefix' => env('SHORTLINKS_TABLE_PREFIX', 'shortlinks_'),

    'shortlink_length' => env('SHORTLINK_LENGTH', 8),

    'tracking' => [
        'track_clicks' => true,
        'track_ip' => false,
        'track_agent' => false,
    ],

];