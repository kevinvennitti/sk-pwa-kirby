# Progressive Web App (PWA) with Kirby 3

✅ Offline use with auto-caching and service worker

✅ Mobile-ready with a nav toolbar and normalized style for app-like behavior

✅ Kirby 3 is in the house (pages are automatically cached for offline use)

✅ Ready-to-use Figma template to create all icons and splash screens

✅ Material Symbols icons' variants ready-to-use

-----

# Get started
- [Set your manifest.json](#set-your-manifestjson)
- [Generate icons and splash screens](#generate-icons-and-splash-screens)
- [Customize files caching](#customize-files-caching)
- [Use Google Fonts symbols](#use-google-fonts-symbols)


-----

## Set your manifest.json
*Note: The file `manifest.json` does not exist in the root folder because it is automatically rendered on the server: `/manifest.json` is routing to a virtual JSON page using `config.js` data (routing is done by PWA Kirby's plugin)*
- You can set `display` mode with `standalone` (with mobile UI) or `fullscreen` (without any mobile UI)
- If your project is not at your server's root, specify the appropriate base URL (aka `DIR`) in `sw.js` *(and don't forget to add `RewriteBase` to `.htaccess` for Kirby!)* ; otherwise caching won't work.



## Generate icons and splash screens

You have to generate 4 icons and 10 splash screens:

1. [Use this read-to-export Figma template](https://www.figma.com/file/HlusyUZh1con2oBd0fSvnN/sk-pwa-kirby?node-id=0%3A1)
2. Export and compress all these assets with your favorite compression tool (like [Compress PNG](https://compresspng.com/fr/))
3. Export all optimized assets in `assets/images/pwa/`

*Note: only iOS uses these images for splash screens. Android uses the 512x512 icon + name + background_color (stored in `config.js`). You may want to add a border around all icons to avoid a poor icon integration on the background color for Android splash screens.*



## Customize files caching
- Lists of cached files and lazy-cache files are stored in `sw.js`
- Google Fonts files are automatically detected and cached for offline use (online version + offline cache)



## Use Google Fonts symbols
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
