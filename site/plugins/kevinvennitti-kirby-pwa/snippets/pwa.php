<?php if (option('kevinvennitti.pwa.enable', false) === true): ?>
    <?php $manifestOptions = $manifestOptions ?? optionsKirbyPwa(); ?>
    <!-- Start PWA Settings -->

    <!-- Web Application Manifest -->
    <link rel="manifest" href="<?= url('manifest.json') ?>">

    <!-- Chrome for Android theme color -->
    <meta name="theme-color" content="<?= $manifestOptions['theme_color'] ?>">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="<?= $manifestOptions['display'] === 'standalone' ? 'yes' : 'no' ?>">
    <meta name="application-name" content="<?= $manifestOptions['short_name'] ?>">
    <link rel="icon"
          sizes="<?= getArrayLastItem($manifestOptions['icons'], 'sizes') ?>"
          href="<?= getArrayLastItem($manifestOptions['icons'], 'src') ?>">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="<?= $manifestOptions['display'] === 'standalone' ? 'yes' : 'no' ?>">
    <meta name="apple-mobile-web-app-status-bar-style" content="<?= $manifestOptions['status_bar'] ?>">
    <meta name="apple-mobile-web-app-title" content="<?= $manifestOptions['short_name'] ?>">
    <link rel="apple-touch-icon" href="<?= getArrayLastItem($manifestOptions['icons'], 'src') ?>">

    <?php foreach ($manifestOptions['splash'] ?? [] as $splash): ?>
        <link href="<?= url($splash['src']) ?>"
            <?php if (empty($splash['media'])): ?>
                media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)"
            <?php endif; ?>
              rel="apple-touch-startup-image"/>
    <?php endforeach; ?>

    <!-- Tile for Win8 -->
    <meta name="msapplication-TileColor" content="<?= $manifestOptions['background_color'] ?>">
    <meta name="msapplication-TileImage" content="<?= getArrayLastItem($manifestOptions['icons'], 'src') ?>">

    <!-- Register service worker  -->
    <script type="text/javascript">
      // Initialize the service worker
      if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('<?= url('sw.js') ?>', {
          scope: '<?= $manifestOptions['scope'] ?>'
        }).then(function (registration) {
            <?php if(option('debug') === true): ?>
          // Registration was successful
          console.log('PWA: ServiceWorker registration successful with scope: ', registration.scope);
            <?php endif; ?>
        }, function (err) {
            <?php if(option('debug') === true): ?>
          // registration failed :(
          console.log('PWA: ServiceWorker registration failed: ', err);
            <?php endif; ?>
        });
      }

      window.addEventListener('load', function(event) {
        const callToA2HS = document.querySelectorAll('[A2HS]');

        if (callToA2HS !== null) {
          let deferredPrompt;

          window.addEventListener('beforeinstallprompt', function(e) {
            // Prevent Chrome 67 and earlier from automatically showing the prompt
            e.preventDefault();
            // Stash the event so it can be triggered later.
            deferredPrompt = e;
          });

          for (let i = 0; i < callToA2HS.length; i++) {
            callToA2HS[i].addEventListener('click', (e) => {
              // Show the prompt
              deferredPrompt.prompt();
              // Wait for the user to respond to the prompt
              deferredPrompt.userChoice
                .then((choiceResult) => {
                  if (choiceResult.outcome === 'accepted') {
                    console.log('User accepted the A2HS prompt');
                  } else {
                    console.log('User dismissed the A2HS prompt');
                  }
                  deferredPrompt = null;
                });
            });
          }
        }
      });

    </script>
    <!-- End PWA Settings -->
<?php endif; ?>
