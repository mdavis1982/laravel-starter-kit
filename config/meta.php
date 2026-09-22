<?php

declare(strict_types=1);

return [
    'default' => [
        'title' => env('APP_NAME', 'Laravel'),
        'title-suffix' => ' - ' . env('APP_NAME', 'LARAVEL'),
        'description' => 'A default meta description.',

        'opengraph' => [
            'title' => env('APP_NAME', 'Laravel'),
            'description' => 'A default opengraph description.',
            'type' => 'website',
            'image' => '',
            'image-alt' => '',
            'site-name' => env('APP_NAME', 'Laravel'),
        ],
    ],
];
