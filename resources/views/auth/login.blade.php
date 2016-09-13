<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>@yield('title') - Projekťák</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="{{ elixir('images/android-desktop.png') }}">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="@yield('title') - Projekťák">
    <link rel="apple-touch-icon-precomposed" href="{{ elixir('images/ios-desktop.png') }}">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="{{ elixir('images/favicon.png') }}">

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="//code.getmdl.io/1.2.0/material.indigo-pink.min.css">
    <link rel="stylesheet" href="{{ elixir('css/mdl-selectfield.min.css') }}">
    <link rel="stylesheet" href="{{ elixir('css/mdl-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>
<body>
    <div class="mdl-layout mdl-js-layout has-drawer is-upgraded">
        <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
            <div class="mdl-layout__header-row">
              <span class="mdl-layout-title">Projekťák</span>
            </div>
        </header>
        <main class="mdl-layout__content">
          <div id="app-status-bar" class="mdl-js-snackbar mdl-snackbar mdl-color--orange-400">
            <div class="mdl-snackbar__text mdl-color-text--grey-900"></div>
            <button class="mdl-snackbar__action" type="button"></button>
          </div>
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col"></div>
            <div class="mdl-cell mdl-cell--4-col">
              <div class="mdl-card mdl-shadow--6dp">
                <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Login</h2>
                </div>
                <div class="mdl-card__supporting-text">
                  <form action="#">
                    <div class="mdl-textfield mdl-js-textfield">
                      <input class="mdl-textfield__input" type="text" id="username" />
                      <label class="mdl-textfield__label" for="username">Username</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield">
                      <input class="mdl-textfield__input" type="password" id="userpass" />
                      <label class="mdl-textfield__label" for="userpass">Password</label>
                    </div>
                  </form>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                  <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Log in</button>
                  <a href="/auth/facebook" class="mdl-button mdl-button--colored mdl-color--light-blue-900 mdl-color-text--white mdl-js-button mdl-js-ripple-effect">Facebook</a>
                  <a href="/auth/github" class="mdl-button mdl-button--colored mdl-color--light-blue-900 mdl-color-text--white mdl-js-button mdl-js-ripple-effect">GitHub</a>
                </div>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--4-col"></div>
          </div>
        </main>
    </div>

    <script src="//code.getmdl.io/1.2.0/material.min.js"></script>
    @if(Session::has('status'))
    <script>
    r(function(){
      'use strict';
      var snackbarContainer = document.querySelector('#app-status-bar');
      var data = {
        message: '{{ Session::get('status') }}',
        timeout: 5000,
      };
      snackbarContainer.MaterialSnackbar.showSnackbar(data);
    });
    function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
    </script>
    @endif
    @stack('scripts')
</body>
</html>
