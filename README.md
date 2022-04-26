# sk-pwa-kirby
PWA with Kirby 3, service worker, offline mode, mobile-ready

### Set your manifest.json in `config.php`
*Note: The file `manifest.json` is not rendered but automatically rendered on the server: `/manifest.json` is routing to a virtual page with `config.js` data (route is done by PWA Kirby's plugin)*
- You can set `display` mode with `standalone` (with mobile UI) or `fullscreen` (without any mobile UI)
- If your project is not at your server's root, specify the appropriate base URL in `sw.js` ; otherwise caching won't work.

### Generate icons and splash screens
1. [use this read-to-export Figma template](https://www.figma.com/file/HlusyUZh1con2oBd0fSvnN/sk-pwa-kirby?node-id=0%3A1)
2. Compress all assets with your favorite compression tool (like (https://compresspng.com/fr/)[Compress PNG])
3. Export all optimized assets in `assets/images/pwa/`

### Adjust which files will be cached
Lists of cached files and lazy-cache files are stored in `sw.js`.
