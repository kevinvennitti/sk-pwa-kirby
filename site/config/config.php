<?php

return [
  'debug' => true,
  'kevinvennitti.pwa' => [
    'enable' => true,

    'manifest' => [
        'name' => 'Kirby PWA',
        'short_name' => 'PWA',
        'description' => 'Progressive web app starterkit',
        'background_color' => '#1649CC',
        'theme_color' => '#E0E7FF',
        'start_url' => './',
        'scope' => '/',
        'display' => 'standalone', // fullscreen, standalone (with status bar)
        'orientation' => 'any',
        // iOS only
        'status_bar' => 'black-translucent', // black, white, black-translucent
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

    'screenshots' => [
      [
        'src' => 'assets/images/pwa/screenshot1-720x1280.png',
        'sizes' => '720x1280',
        'label' => '',
        'platform' => 'narrow'
      ],
      [
        'src' => 'assets/images/pwa/screenshot1-720x1280.png',
        'sizes' => '720x1280',
        'label' => '',
        'platform' => 'narrow'
      ],
    ],

    'shortcuts' => [
      [
        'name' => 'Shortcut 1',
        'short_name' => 'Shortcut 1',
        'description' => 'Description for shortcut 1',
        'url' => './',
        'icons' => [
          'src' => 'assets/images/pwa/shortcut1-192x192.png',
          'sizes' => '192x192'
        ],
      ],
      [
        'name' => 'Shortcut 2',
        'short_name' => 'Shortcut 2',
        'description' => 'Description for shortcut 2',
        'url' => './about',
        'icons' => [
          'src' => 'assets/images/pwa/shortcut2-192x192.png',
          'sizes' => '192x192'
        ],
      ]
    ],

  ]
];
