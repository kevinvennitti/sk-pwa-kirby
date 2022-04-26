<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?= $site->title(); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="mobile-web-app-capable" content="yes">

  <link rel="stylesheet" href="./assets/css/normalize.css">
  <link rel="stylesheet" href="./assets/css/main.css">

  <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <style>
    .material-symbols-rounded {
      font-variation-settings:
      'FILL' 0,
      'wght' 400,
      'GRAD' 0,
      'opsz' 48;
    }
  </style>

  <?= snippet('pwa'); ?>
</head>

<body>
  <div id="app">
    <div id="app-scrollable-area">
      <div id="app-main">
