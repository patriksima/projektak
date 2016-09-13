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

    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' };</script>
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
                  <input class="mdl-textfield__input" type="text" id="search" name="s" value="{{ Input::get('s') }}">
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
              <img src="{{ Auth::user()->getCurrentSocialProvider()->avatar }}" class="demo-avatar">
              <div class="demo-avatar-dropdown">
                <span>{{ Auth::user()->getCurrentSocialProvider()->name }}</span>
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
            {{-- TODO: Composer nav class --}}
            <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
              @can('manager-access')
              <a class="mdl-navigation__link" href="{{ url('/inbox') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Inbox</a>
              <a class="mdl-navigation__link" href="{{ url('/control') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">rss_feed</i>Control</a>
              <a class="mdl-navigation__link" href="{{ url('/tasks') }}" id="tasks"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">list</i>Tasks</a>
              <a class="mdl-navigation__link" href="{{ url('/clients') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">group</i>Clients</a>
              <a class="mdl-navigation__link" href="{{ url('/projects') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assignment</i>Projects</a>
              <a class="mdl-navigation__link" href="{{ url('/workers') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">wc</i>Workers</a>
              <a class="mdl-navigation__link" href="{{ url('/worksheets') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">date_range</i>Worksheets</a>
              {{--
              <a class="mdl-navigation__link" href="{{ url('/finance') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">euro_symbol</i>Finance</a>
              <a class="mdl-navigation__link" href="{{ url('/banks') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">account_balance</i>Banks</a>
              <a class="mdl-navigation__link" href="{{ url('/labels') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">account_balance</i>Labels</a>
              <a class="mdl-navigation__link" href="{{ url('/leads') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">euro_symbol</i>Leads</a>
              <a class="mdl-navigation__link" href="{{ url('/settings') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings</i>Settings</a>
              --}}
              @endcan
              @can('worker-access')
                  <a class="mdl-navigation__link{{ Request::is('user') ? ' current' : '' }}" href="{{ action('User\DashboardController@index') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">dashboard</i>Dashboard</a>
                  <a class="mdl-navigation__link{{ Request::is('user/tasks*') ? ' current' : '' }}" href="{{ action('User\TaskController@index') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">list</i>Tasks</a>
              @endcan
              <div class="mdl-layout-spacer"></div>
              <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
            </nav>
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
    <script src="{{ elixir('js/mdl-selectfield.min.js') }}"></script>
    <script src="{{ elixir('js/mdl-stepper.min.js') }}"></script>
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
