# Progressive Web App (PWA) with Kirby 3

✅ Offline use with auto-caching and service worker

✅ Mobile-ready with a nav toolbar and normalized style for app-like behavior

✅ Kirby 3 is in the house (pages are automatically cached for offline use)

✅ Ready-to-use Figma template to create all icons and splash screens

✅ Material Symbols icons' variants ready-to-use

-----

- [Configure your web app manifest](#configure-your-web-app-manifest)
- [Configure your service worker](#configure-your-service-worker)
- [Generate icons and splash screens](#generate-icons-and-splash-screens)
- [Use Google Fonts symbols](#use-google-fonts-symbols)

-----

# Configure your web app manifest

> The web app manifest provides information about a web application in a JSON text file, necessary for the web app to be downloaded and be presented to the user similarly to a native app (e.g., be installed on the homescreen of a device, providing users with quicker access and a richer experience).<br>
— [Web app manifests on MDN web docs](https://developer.mozilla.org/en-US/docs/Web/Manifest)

The `manifest.json` file is rendered by the server (with a Kirby route) and uses `manifest` parameters from `config.js`.

### manifest.json parameters

| Parameter | Values | Default |
| --- | --- | --- |
| [`name`](https://developer.mozilla.org/en-US/docs/Web/Manifest/name)* | App fullname. *Mandatory* |  |
| [`short_name`](https://developer.mozilla.org/en-US/docs/Web/Manifest/short_name) | Short app name, used as a label for an icon on the phone home screen | `name` |
| [`description`](https://developer.mozilla.org/en-US/docs/Web/Manifest/description) | App description, used in the PWA modal | `name` |
| [`scope`](https://developer.mozilla.org/en-US/docs/Web/Manifest/scope) | Scope of the manifest, relative (`/app/`) or absolute (`https://example.com/`) | *.* |
| [`start_url`](https://developer.mozilla.org/en-US/docs/Web/Manifest/start_url) | Start URL of the application, like `/login` | *.* |
| [`display`](https://developer.mozilla.org/en-US/docs/Web/Manifest/display) | Display mode:<br>`fullscreen`: whole display area is used (no mobile UI elements)<br>`standalone`: feel like a real app, with status bar and mobile UI elements<br>`minimal-ui`: same as standalone, but with browser UI elements for controlling navigation<br>`browser`: like a conventional browser tab | *standalone* |
| [`theme_color`](https://developer.mozilla.org/en-US/docs/Web/Manifest/theme_color) | Default theme color for the application | *#000000* |
| [`background_color`](https://developer.mozilla.org/en-US/docs/Web/Manifest/background_color) | Placeholder background color for the application and Android splash screen | *#ffffff* |
| [`orientation`](https://developer.mozilla.org/en-US/docs/Web/Manifest/orientation) | Default orientation: `any`, `natural`, `landscape`, `landscape-primary`, `landscape-secondary`, `portrait`, `portrait-primary`, `portrait-secondary` | *any* |
| `status_bar` | *(iOS only)* Style of the status bar:<br>`default`: normal appearance<br>`black`: the status bar has a black background<br>`black-translucent`: the web content is displayed under the status bar | *black* |

<br>

# Configure your service worker

> Using a Service worker you can easily set an app up to use cached assets first, thus providing a default experience even when offline, before then getting more data from the network. This is already available with native apps, which is one of the main reasons native apps are often chosen over web apps.<br>
— [Service Workers on MDN web docs](https://developer.mozilla.org/en-US/docs/Web/API/Service_Worker_API/Using_Service_Workers)

### Service Worker (SW) parameters

| Parameter | Values | Default |
| --- | --- | --- |
| `cached_files` | List of cached files, added and updated each time SW is installed. The cache version (if exists) is prefered.<br>*For assets, CSS/JS/images files* | [] |
| `lazy_cache` | List of lazy-cached files. The cache version (if exists) is prefered, and the live version is systematically cached in background<br>*For data caching and web pages* | [] |
| `offline_url` | URL to redirect when the app is offline and the current screen has no cache version | / |
| `dir` | Path on the server, same as RewriteBase value if exists *(don't forget to specify `RewriteBase` into `.htaccess` for Kirby!)* | |
| `cache_google_fonts` | Automatically cache Google Fonts resources for offline use | *false* |

<br>

# Generate icons and splash screens

You have to generate icons, and you can generate splash screens, shortcuts icons and app screenshots:

1. [Use this read-to-export Figma template](https://www.figma.com/file/HlusyUZh1con2oBd0fSvnN/sk-pwa-kirby?node-id=0%3A1)
2. Export and compress all these assets with your favorite compression tool (like [Compress PNG](https://compresspng.com/fr/))
3. Export all optimized assets in `assets/images/pwa/`

*Note: only iOS uses splash screens. Android uses the 512x512 icon + name + background_color (stored in `config.js`). You may want to add a border around all icons to avoid a poor icon integration on the background color for Android splash screens.*

<br>

# Use Google Fonts symbols
This starterkit is ready to use Material Symbols as font variants:

1. [Go to Material Symbols library](https://fonts.google.com/icons?icon.style=Rounded&icon.set=Material+Symbols)
2. Pick your style (`outlined`, `rounded`, `sharp`)
3. Customize fill, weight, grade and optical size
4. Pick an icon and update the HTML link tag and the `<style>` tag in `/site/snippets/header.php`:

```html
<!-- Example with rounded style -->
<link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<style>
.material-symbols-rounded {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 48
}
</style>
```
5. Now, use your icon's code point (`&#x` + *code point*) into `<span>` tags with the appropriate CSS class like this:
```html
<!-- Example with rounded style -->
<span class="material-symbols-rounded">
  &#xE88a;
</span>
```
*Note: you can use icon's name like `home` and `account_circle`, but there will be [a FOUT](https://css-tricks.com/fout-foit-foft/) flickering your icon's name*


-----


# To do

- [ ] Move `status_bar` outside manifest (it's not in the manifest but in meta tags only)
- [ ] Check is `dir` is still necessary
