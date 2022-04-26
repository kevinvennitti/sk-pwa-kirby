<?php

return [
  'debug' => true,

  'kevinvennitti.pwa' => [
    'enable' => true,

    'manifest' => [
        'name' => 'PWA for Kirby',
        'short_name' => 'PWA',
        'description' => 'Progressive web app starterkit',

        // Same color recommended for both background_color and theme_color
        'background_color' => '#E0E7FF',
        'theme_color' => '#E0E7FF',

        'start_url' => './',
        'scope' => '/',
        'display' => 'standalone', // fullscreen, standalone (with status bar)
        'orientation' => 'portrait',

        // iOS only
        'status_bar' => 'black-translucent', // black, white, black-translucent

        'icons' => [
          [
            'src' => 'assets/images/pwa/icon-192x192.png',
            'sizes' => '192x192',
          ],
          [
            'src' => 'assets/images/pwa/icon-256x256.png',
            'sizes' => '256x256',
          ],
          [
            'src' => 'assets/images/pwa/icon-384x384.png',
            'sizes' => '384x384',
          ],
          [
            'src' => 'assets/images/pwa/icon-512x512.png',
            'sizes' => '512x512',
          ],
          [
            'src' => 'assets/images/pwa/icon-maskable-512x512.png',
            'sizes' => '512x512',
            'purpose' => 'maskable',
          ],
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

    ],

    'serviceworker' => [

      // Cached each time SW is installed
      'cached_files' => [
        '/manifest.json',

        '/assets/js/jquery.js',
        '/assets/js/main.js',
        '/assets/css/normalize.css',
        '/assets/css/main.css',

        '/assets/images/pwa/icon-192x192.png',
        '/assets/images/pwa/icon-256x256.png',
        '/assets/images/pwa/icon-384x384.png',
        '/assets/images/pwa/icon-512x512.png',
        '/assets/images/pwa/splash-640x1136.png',
        '/assets/images/pwa/splash-750x1334.png',
        '/assets/images/pwa/splash-828x1792.png',
        '/assets/images/pwa/splash-1125x2436.png',
        '/assets/images/pwa/splash-1242x2208.png',
        '/assets/images/pwa/splash-1242x2688.png',
        '/assets/images/pwa/splash-1536x2048.png',
        '/assets/images/pwa/splash-1668x2224.png',
        '/assets/images/pwa/splash-1668x2388.png',
        '/assets/images/pwa/splash-2048x2732.png',

        'https://fonts.sandbox.google.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0',
      ],

      'lazy_cache' => [
        '/', // each current page
      ],

      'offline_url' => '/offline',
      'dir' => '', // If dir, starts with "/"
      'cache_google_fonts' => true,
    ],
  ]
];
