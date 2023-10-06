<?php

// config for MrMusaev/EImzoJson
use MrMusaev\EImzo\EImzoJson;

return [
    // Interface implementation
    'implementation' => env('EIMZO_IMPLEMENTATION', 'json'),
    'implementation_class' => env('EIMZO_IMPLEMENTATION_CLASS', ''),

    // Connection parameters
    'base_url' => env('EIMZO_SERVER_URL', 'http://127.0.0.1:8080'),
    'operation_timeout' => env('EIMZO_OPERATION_TIMOUT', 30),
    'connection_timeout' => env('EIMZO_CONNECTION_TIMOUT', 5),
    'site_id' => env('EIMZO_SITE_ID', '123D'),
];
