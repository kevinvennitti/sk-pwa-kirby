<?php

return [
    'clicktonext.pwa' => [
        'enable' => true,
        'manifest' => [
            'name' => 'Kirby PWA',
            'short_name' => 'PWA',
            'description' => 'Progressive web app starterkit',
            'background_color' => '#1649CC',
            'theme_color' => '#1649CC',
            'start_url' => './',
            'scope' => '/',
            'display' => 'fullscreen',
            'orientation' => 'any',
            'status_bar' => 'white',
        ],
        'icons' => [
            '192x192' => 'assets/images/pwa/icon-192x192.png',
            '256x256' => 'assets/images/pwa/icon-384x384.png',
            '384x384' => 'assets/images/pwa/icon-384x384.png',
            '512x512' => 'assets/images/pwa/icon-512x512.png',
        ],
        // Splash screen only works in iOS
        // Android uses:
        // - 512x512 icon
        // - manifest.name
        // - manifest.background_color
        'splash' => [
            '640x1136' => 'assets/images/pwa/splash-640x1136.png',
            '750x1334' => 'assets/images/pwa/splash-750x1334.png',
            '828x1792' => 'assets/images/pwa/splash-828x1792.png',
            '1125x2436' => 'assets/images/pwa/splash-1125x2436.png',
            '1242x2208' => 'assets/images/pwa/splash-1242x2208.png',
            '1242x2688' => 'assets/images/pwa/splash-1242x2688.png',
            '1536x2048' => 'assets/images/pwa/splash-1536x2048.png',
            '1668x2224' => 'assets/images/pwa/splash-1668x2224.png',
            '1668x2388' => 'assets/images/pwa/splash-1668x2388.png',
            '2048x2732' => 'assets/images/pwa/splash-2048x2732.png',
        ],
        //'serviceworker.js' => './assets/js/serviceworker.js',
    ]
];
