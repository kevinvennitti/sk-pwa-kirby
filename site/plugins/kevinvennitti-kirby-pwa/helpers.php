<?php

use Kirby\Toolkit\A;
use Kirby\Toolkit\I18n;

/**
 * @param array $array
 * @param string $key
 * @param null $default
 * @return array|mixed
 */
function getArrayLastItem(array $array = [], string $key, $default = null)
{
    return A::get(end($array), $key, $default = null);
}

/**
 * @param array $data
 * @param false $return
 * @return string
 */
function snippetKirbyPwa(array $data = [], bool $return = false): string
{
    return snippet('pwa', $data, $return);
}

/**
 * @return array
 */
function optionsKirbyPwa(): array
{
    // get options
    $manifest = option('kevinvennitti.pwa.manifest');
    $icons = option('kevinvennitti.pwa.manifest.icons', []);
    $splash = option('kevinvennitti.pwa.manifest.splash', []);
    $shortcuts = option('kevinvennitti.pwa.manifest.shortcuts', []);
    $screenshots = option('kevinvennitti.pwa.manifest.screenshots', []);
    $custom = option('kevinvennitti.pwa.manifest.custom', []);

    $data = [
        'name' => $manifest['name'],
        'short_name' => $manifest['short_name'] ?? $manifest['name'],
        'description' => $manifest['description'] ?? $manifest['name'],
        'scope' => $manifest['scope'] ?? '.',
        'start_url' => $manifest['start_url'] ?? '.',
        'display' => $manifest['display'] ?? 'standalone',
        'theme_color' => $manifest['theme_color'] ?? '#000000',
        'background_color' => $manifest['background_color'] ?? '#ffffff',
        'orientation' => $manifest['orientation'] ?? 'any',
        'status_bar' => $manifest['status_bar'] ?? 'black'
    ];

    // prepare icons
    $data['icons'] = [];
    foreach ($icons as $file) {
        if (is_string($file) === true) {
            $path = $file;
            $fileInfo = pathinfo($path);
        } else {
            $path = $file['src'];
            $fileInfo = pathinfo($path);
        }

        $data['icons'][] = [
            'src' => url($path),
            'type' => 'image/' . $fileInfo['extension'],
            'sizes' => $file['sizes'],
            'purpose' => $file['purpose'] ?? 'any'
        ];
    }

    // prepare splash
    $data['splash'] = [];
    foreach ($splash as $size => $file) {
        $path = $file['path'] ?? $file;

        $data['splash'][] = [
            'src' => url($path),
            'sizes' => $size,
            'media' => $file['media'] ?? null
        ];
    }

    // prepare screenshots
    $data['screenshots'] = [];
    foreach ($screenshots as $file) {
        if (is_string($file) === true) {
            $path = $file;
            $fileInfo = pathinfo($path);
        } else {
            $path = $file['src'];
            $fileInfo = pathinfo($path);
        }

        $data['screenshots'][] = [
            'src' => url($path),
            'type' => 'image/' . $fileInfo['extension'],
            'sizes' => $file['sizes'] ?? '',
            'label' => $file['label'] ?? '',
            'platform' => $file['platform'] ?? 'narrow',
        ];
    }

    // prepare shortcuts
    $data['shortcuts'] = [];
    foreach ($shortcuts as $shortcut) {
        if (array_key_exists('icons', $shortcut) === true) {
            $fileInfo = pathinfo($shortcut['icons']['src']);

            $shortcutIcons = [
                'src' => url($shortcut['icons']['src']),
                'sizes' => $shortcut['icons']['sizes'] ?? '',
                'type' => 'image/' . $fileInfo['extension'],
                'purpose' => $shortcut['icons']['purpose'] ?? 'any',
            ];
        } else {
            $shortcutIcons = [];
        }

        $data['shortcuts'][] = [
            'name' => I18n::translate($shortcut['name'], $shortcut['name']),
            'short_name' => I18n::translate($shortcut['short_name'], $shortcut['short_name']),
            'description' => I18n::translate($shortcut['description'], $shortcut['description']),
            'url' => url($shortcut['url']),
            'icons' => [
                $shortcutIcons
            ]
        ];
    }

    // custom options
    foreach ($custom as $tag => $value) {
        $data[$tag] = $value;
    }

    return $data;
}
