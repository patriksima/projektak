<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="api-token" content="{{ auth()->user() ? auth()->user()->api_token : '' }}" />

    <title>@yield('title') - Projekťák</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="/images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="@yield('title') - Projekťák">
    <link rel="apple-touch-icon-precomposed" href="/images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="/images/favicon.png">

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="//code.getmdl.io/1.2.0/material.indigo-pink.min.css">
    <link rel="stylesheet" href="/css/mdl-selectfield.min.css">
    <link rel="stylesheet" href="/css/mdl-stepper.min.css">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
        <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
            <div class="mdl-layout__header-row">
              <span class="mdl-layout-title">@yield('title')</span>
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
                <form>
                <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
                  <i class="material-icons">search</i>
                </label>
                <div class="mdl-textfield__expandable-holder">
                  <input class="mdl-textfield__input" type="text" id="search" name="search" value="{{ request('search') }}">
                  <label class="mdl-textfield__label" for="search">Enter your query...</label>
                </div>
                </form>
              </div>
              <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
                <i class="material-icons">more_vert</i>
              </button>
              <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
                <li class="mdl-menu__item">About</li>
                <li class="mdl-menu__item" onclick="location.href='{{ url('/ideas') }}'">Ideas</li>
                <li class="mdl-menu__item">Legal information</li>
              </ul>
            </div>
        </header>

        <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
            <header class="demo-drawer-header">
              <img src="{{ auth()->user()->social->avatar }}" class="demo-avatar">
              <div class="demo-avatar-dropdown">
                <span>{{ auth()->user()->social->name }}</span>
                <div class="mdl-layout-spacer"></div>
                <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                  <i class="material-icons" role="presentation">arrow_drop_down</i>
                  <span class="visuallyhidden">Accounts</span>
                </button>
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
                  <li class="mdl-menu__item"><i class="material-icons">add</i>Add another account...</li>
                </ul>
              </div>
            </header>

            @include('partials.nav')
        </div>

        <main class="mdl-layout__content mdl-color--grey-100">
            <div id="app-status-bar" class="mdl-js-snackbar mdl-snackbar mdl-color--orange-400">
                <div class="mdl-snackbar__text mdl-color-text--grey-900"></div>
                <button class="mdl-snackbar__action" type="button"></button>
            </div>

            <div class="mdl-grid demo-content">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="//code.getmdl.io/1.2.0/material.min.js"></script>
    <script src="/js/mdl-selectfield.min.js"></script>
    <script src="/js/mdl-stepper.min.js"></script>

    @if (Session::has('status'))
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
