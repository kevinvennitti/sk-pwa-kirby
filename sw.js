const DIR = ''; // If dir, starts with "/"

const BASE = location.protocol + "//" + location.host + DIR;
const PREFIX = "V1";

const OFFLINE_URL = `${BASE}/offline`;

// For static files
const CACHED_FILES = [
  `${BASE}/manifest.json`,

  `${BASE}/assets/js/jquery.js`,
  `${BASE}/assets/js/jquery-ui.js`,
  `${BASE}/assets/js/main.js`,
  `${BASE}/assets/css/normalize.css`,
  `${BASE}/assets/css/main.css`,

  `${BASE}/assets/images/pwa/icon-192x192.png`,
  `${BASE}/assets/images/pwa/icon-256x256.png`,
  `${BASE}/assets/images/pwa/icon-384x384.png`,
  `${BASE}/assets/images/pwa/icon-512x512.png`,
  `${BASE}/assets/images/pwa/splash-640x1136.png`,
  `${BASE}/assets/images/pwa/splash-750x1334.png`,
  `${BASE}/assets/images/pwa/splash-828x1792.png`,
  `${BASE}/assets/images/pwa/splash-1125x2436.png`,
  `${BASE}/assets/images/pwa/splash-1242x2208.png`,
  `${BASE}/assets/images/pwa/splash-1242x2688.png`,
  `${BASE}/assets/images/pwa/splash-1536x2048.png`,
  `${BASE}/assets/images/pwa/splash-1668x2224.png`,
  `${BASE}/assets/images/pwa/splash-1668x2388.png`,
  `${BASE}/assets/images/pwa/splash-2048x2732.png`,

  `https://fonts.sandbox.google.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0`,

  OFFLINE_URL,
];

// For dynamic content
const LAZY_CACHE = [
//  `${BASE}/posts.json`,
  `${BASE}/`,
];

self.addEventListener("install", (event) => {
  self.skipWaiting();
  event.waitUntil(
    (async () => {
      const cache = await caches.open(PREFIX);
      await Promise.all(
        [...CACHED_FILES].map((path) => {
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
        try {
          const cache = await caches.open(PREFIX);

          const preloadResponse = await event.preloadResponse;
          if (preloadResponse) {
            return preloadResponse;
          }

          // Fetch online version if available
          const networkResponse = await fetch(event.request);

          // Update latest online version in cache
          cache.put(event.request, networkResponse.clone());

          // Return online page
          return networkResponse;
        } catch(e) {
          const cache = await caches.open(PREFIX);

          // If not available, return cache version
          const pageInCache = await cache.match(event.request);
          if (pageInCache) {
            return pageInCache;
          }

          // If no cache version, return offline page
          return await cache.match(OFFLINE_URL);
        }
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
    || /fonts.(sandbox.google|googleapis|gstatic).com/.test(event.request.url)
  ) {
    event.respondWith(
      (async () => {
        try {
          const cache = await caches.open(PREFIX);
          const preloadResponse = await event.preloadResponse;

          if (preloadResponse) {
            cache.put(event.request, preloadResponse.clone());

            console.log(
              `Fetching : ${event.request.url} (${event.request.mode}) [online version + cache updated]`
            );
            return preloadResponse;
          }

          const networkResponse = await fetch(event.request);
          cache.put(event.request, networkResponse.clone());

          console.log(
            `Fetching : ${event.request.url} (${event.request.mode}) [online version + cache updated]`
          );
          return networkResponse;
        } catch(e) {
          console.log(
            `Fetching : ${event.request.url} (${event.request.mode}) [cache version]`
          );
          return await caches.match(event.request);
        }
      })()
    );
  }
});
