<?php

return [
    'name' => 'SIS PONCIL',
    'manifest' => [
        'name' => env('SIS PONCIL'),
        'short_name' => 'SIS PONCIL',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => '/img/log.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/img/log.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/img/log.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/img/log.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/img/log.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/img/log.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/img/log.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/img/log.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/img/log.png',
            '750x1334' => '/img/log.png',
            '828x1792' => '/img/log.png',
            '1125x2436' => '/img/log.png',
            '1242x2208' => '/img/log.png',
            '1242x2688' => '/img/log.png',
            '1536x2048' => '/img/log.png',
            '1668x2224' => '/img/log.png',
            '1668x2388' => '/img/log.png',
            '2048x2732' => '/img/log.png',
        ],
        'shortcuts' => [
            [
                'name' => 'SIS PONCIL',
                'description' => 'SIS PONCIL',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => '/img/log.png',
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'SIS PONCIL',
                'description' => 'SIS PONCIL',
                'url' => '/shortcutlink2'
            ]
        ],
        'custom' => []
    ]
];
