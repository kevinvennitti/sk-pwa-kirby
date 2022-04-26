<?php
// Files to cache
$cached_files = option('kevinvennitti.pwa.cached_files') ?? [];

// Lazy-cache
$lazy_cache = option('kevinvennitti.pwa.lazy_cache') ?? [];

$offline_url = option('kevinvennitti.pwa.offline_url') ?? '/';
$dir = option('kevinvennitti.pwa.dir') ?? '';

header('Content-Type: application/javascript');
?>
const DIR = '<?= $dir; ?>'; // If dir, starts with "/"

const BASE = location.protocol + "//" + location.host + DIR;
const PREFIX = "V2";

const OFFLINE_URL = '<?= $offline_url; ?>';

// For static files
const CACHED_FILES = [
  <?php foreach ($cached_files as $file) : ?>
  '<?= $file ?>',
  <?php endforeach; ?>

  OFFLINE_URL,
];

// For dynamic content
const LAZY_CACHE = [
  <?php foreach ($lazy_cache as $file) : ?>
  '<?= $file ?>',
  <?php endforeach; ?>
];

self.addEventListener("install", (event) => {
  self.skipWaiting();
  event.waitUntil(
    (async () => {
      const cache = await caches.open(PREFIX);
      await Promise.all(
        CACHED_FILES.map((path) => {
          return cache.add(new Request(path));
        })
      );
    })()
  );

  console.log(`${PREFIX} Install`);
});


self.addEventListener('activate', (event) => {
  clients.claim();
  event.waitUntil(
    (async () => {
      const keys = await caches.keys();
      await Promise.all(
        keys.map((key) => {
          if (!key.includes(PREFIX)) {
            return caches.delete(key);
          }
        })
      );
    })()
  );

  console.log(`${PREFIX} Active`);
});


self.addEventListener('fetch', (event) => {

  // For pages (not files)
  if (event.request.mode == "navigate") {
    console.log(
      `Fetching : ${event.request.url} (${event.request.mode})`
    );
    event.respondWith(
      (async () => {

        const cache = await caches.open(PREFIX);

        // Use the preloaded response, if it's there
        const preloadResponse = await event.preloadResponse;
        if (preloadResponse) {
          console.log(
            `Fetching : ${event.request.url} (${event.request.mode}) [preload version + cache updated]`
          );
          cache.put(event.request, preloadResponse.clone());
          return preloadResponse;
        }

        // Else try the network.
        const networkResponse = await fetch(event.request);
        console.log(
          `Fetching : ${event.request.url} (${event.request.mode}) [online version + cache updated]`
        );
        cache.put(event.request, networkResponse.clone());
        return networkResponse;


        // Else respond from the cache if we can
        const cachedResponse = await caches.match(event.request);
        if (cachedResponse) {
          console.log(
            `Fetching : ${event.request.url} (${event.request.mode}) [cache version]`
          );
          return cachedResponse;
        }

        // Else if no cache version, return offline page
        return await cache.match(OFFLINE_URL);
      })()
    );
  }

  // For files we want to cache
  else if (CACHED_FILES.includes(event.request.url)){
    console.log(
      `Fetching : ${event.request.url} (${event.request.mode}) [cache version]`
    );
    event.respondWith(caches.match(event.request));
  }

  // For files we want online first and saving cache version for offline
  // and font files from Google Fonts
  else if (
    LAZY_CACHE.includes(event.request.url)
  ) {
    event.respondWith(
      (async () => {
        const cache = await caches.open(PREFIX);

        // Use the preloaded response, if it's there
        const preloadResponse = await event.preloadResponse;
        if (preloadResponse) {
          console.log(
            `Fetching : ${event.request.url} (${event.request.mode}) [preload version + cache updated]`
          );
          cache.put(event.request, preloadResponse.clone());
          return preloadResponse;
        }

        // Else try the network.
        const networkResponse = await fetch(event.request);
        console.log(
          `Fetching : ${event.request.url} (${event.request.mode}) [online version + cache updated]`
        );
        cache.put(event.request, networkResponse.clone());
        return networkResponse;


        // Else respond from the cache if we can
        const cachedResponse = await caches.match(event.request);
        if (cachedResponse) {
          console.log(
            `Fetching : ${event.request.url} (${event.request.mode}) [cache version]`
          );
          return cachedResponse;
        }
      })()
    );
  }

  // For font files from Google Fonts
  else if (
    /fonts.(sandbox.google|googleapis|gstatic).com/.test(event.request.url)
  ) {
    event.respondWith(
      (async () => {
        const cache = await caches.open(PREFIX);

        // Respond from the cache if we can
        const cachedResponse = await caches.match(event.request);
        if (cachedResponse) {
          console.log(
            `Fetching : ${event.request.url} (${event.request.mode}) [cache version]`
          );
          return cachedResponse;
        }

        // Else, use the preloaded response, if it's there
        const preloadResponse = await event.preloadResponse;
        if (preloadResponse) {
          console.log(
            `Fetching : ${event.request.url} (${event.request.mode}) [preload version + cache updated]`
          );
          cache.put(event.request, preloadResponse.clone());
          return preloadResponse;
        }

        // Else try the network.
        const networkResponse = await fetch(event.request);
        console.log(
          `Fetching : ${event.request.url} (${event.request.mode}) [online version + cache updated]`
        );
        cache.put(event.request, networkResponse.clone());
        return networkResponse;
      })()
    );
  }
});
