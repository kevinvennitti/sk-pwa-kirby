# sk-pwa-kirby
PWA with Kirby 3, service worker, offline mode, mobile-ready

In `config.php`, you can update manifest.json data.
If your project is not at your server's root, specify the appropriate base URL in `sw.js` ; otherwise caching won't work.
Lists of cached files and lazy-cache files are stored in `sw.js`.

To generate icons and splash screens, (link: https://www.figma.com/file/HlusyUZh1con2oBd0fSvnN/sk-pwa-kirby?node-id=0%3A1 text: use this read-to-export Figma template) and export all assets in `assets/images/pwa/`.
