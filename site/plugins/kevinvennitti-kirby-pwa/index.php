<?php

use Kirby\Cms\App as Kirby;
use Kirby\Filesystem\F;
use Kirby\Http\Response;

@include_once __DIR__ . '/helpers.php';

Kirby::plugin('kevinvennitti/pwa', [
    'options' => [
        'enable' => false,
        'manifest' => [
            'name' => 'Kirby PWA',
            'short_name' => 'Kirby PWA',
            'scope' => '.',
            'start_url' => '.',
            'description' => null,
            'background_color' => '#ffffff',
            'theme_color' => '#ffffff',
            'display' => 'standalone',
            'orientation' => 'any',
            'status_bar' => 'black',
        ],
        'icons' => [],
        'splash' => [],
        'shortcuts' => [],
        'screenshots' => [],
        'custom' => [],
        'manifest.json' => null,
        'serviceworker.js' => null
    ],
    'snippets' => [
        'pwa' => __DIR__ . '/snippets/pwa.php'
    ],
    'routes' => [
        [
            'pattern' => 'manifest.json',
            'action' => function () {
                $localManifestJson = kirby()->root('index') . '/manifest.json';

                if (option('kevinvennitti.pwa.enable', false) === true) {
                    $manifestJson = option('kevinvennitti.pwa.manifest.json');

                    if ($manifestJson === null) {
                        if (F::exists($localManifestJson) === true) {
                            return Response::file($localManifestJson);
                        }

                        return Response::json(optionsKirbyPwa(), null, true);
                    }

                    if (is_a($manifestJson, 'Closure') === true) {
                        return $manifestJson();
                    }
                } else {
                    if (F::exists($localManifestJson) === true) {
                        return Response::file($localManifestJson);
                    }
                }
            }
        ],

        [
            'pattern' => 'sw.js',
            'action' => function () {
                //$localServiceWorker = __DIR__ . '/dist/sw.php';
                $localServiceWorker = include(__DIR__ . '/dist/sw.php');

                return Response::file($localServiceWorker);

                /*
                $localServiceWorker = kirby()->root('index') . '/serviceworker.js';

                if (option('kevinvennitti.pwa.enable', false) === true) {
                    $serviceworkerJs = option('kevinvennitti.pwa.serviceworker.js');

                    if ($serviceworkerJs === null) {
                        if (F::exists($localServiceWorker) === true) {
                            return Response::file($localServiceWorker);
                        }

                        return Response::file(__DIR__ . '/js/serviceworker.js');
                    }

                    if (is_a($serviceworkerJs, 'Closure') === true) {
                        return $serviceworkerJs();
                    }
                } else {
                    if (F::exists($localServiceWorker) === true) {
                        return Response::file($localServiceWorker);
                    }
                }
                */
            }
        ]
    ]
]);
