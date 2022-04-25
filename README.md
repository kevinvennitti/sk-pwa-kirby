# sk-pwa-kirby
PWA with Kirby 3, service worker, offline mode, mobile-ready

In `config.php`, you can update manifest.json data.
If your project is not at your server's root, specify the appropriate base URL in `sw.js` ; otherwise caching won't work.
Lists of cached files and lazy-cache files are in `sw.js`.
