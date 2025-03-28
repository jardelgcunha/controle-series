<?php

return [
    'dev' => [
        'host' => 'localhost',
        'port' => 5173,
        'https' => false,
    ],
    'build' => [
        'manifest' => public_path('vite/manifest.json'),
        'build_path' => public_path('vite'),
    ],
];
