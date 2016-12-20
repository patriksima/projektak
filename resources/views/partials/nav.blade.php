<nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
  @can('manager-access')
    <a class="mdl-navigation__link" href="{{ url('/inbox') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        inbox
      </i>

      Inbox
    </a>

    <a class="mdl-navigation__link" href="{{ url('/control') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        rss_feed
      </i>

      Control
    </a>

    <a class="mdl-navigation__link" href="{{ url('/tasks') }}" id="tasks">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        list
      </i>

      Tasks
    </a>

    <a class="mdl-navigation__link" href="{{ url('/clients') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        group
      </i>

      Clients
    </a>

    <a class="mdl-navigation__link" href="{{ url('/projects') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        assignment
      </i>

      Projects
    </a>

    <a class="mdl-navigation__link" href="{{ url('/workers') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        wc
      </i>

      Workers
    </a>

    <a class="mdl-navigation__link" href="{{ url('/worksheets') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        date_range
      </i>

      Worksheets
    </a>

    <a class="mdl-navigation__link" href="{{ url('/task-requests') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        trending_up
      </i>

      Task Requests
    </a>

{{--     <a class="mdl-navigation__link" href="{{ url('/finance') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        euro_symbol
      </i>

      Finance
    </a>
    <a class="mdl-navigation__link" href="{{ url('/banks') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        account_balance
      </i>

      Banks
    </a>

    <a class="mdl-navigation__link" href="{{ url('/labels') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        account_balance
      </i>

      Labels
    </a>

    <a class="mdl-navigation__link" href="{{ url('/leads') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        euro_symbol
      </i>

      Leads
    </a>

    <a class="mdl-navigation__link" href="{{ url('/settings') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        settings
      </i>

      Settings
    </a> --}}

  @endcan

  @can('admin-access')
      <a class="mdl-navigation__link{{ Request::is('users') ? ' current' : '' }}" href="{{ action  ('UserController@index') }}">
        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
          people
        </i>

        Users
      </a>
  @endcan


  @can('worker-access')
    <hr>

    <a class="mdl-navigation__link{{ Request::is('user') ? ' current' : '' }}" href="{{ action  ('User\DashboardController@index') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        dashboard
      </i>

      Dashboard
    </a>

    <a class="mdl-navigation__link{{ Request::is('user/tasks*') ? ' current' : '' }}" href="{{ action ('User\TaskController@index') }}">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
        list
      </i>

      Tasks
    </a>
  @endcan

  <div class="mdl-layout-spacer"></div>

  <a class="mdl-navigation__link" href="">
    <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">
      help_outline
    </i>

    <span class="visuallyhidden">Help</span>
  </a>
</nav>
