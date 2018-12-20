<!-- START X-NAVIGATION VERTICAL -->
<ul class="x-navigation x-navigation-horizontal x-navigation-panel" id="app">
    <!-- POWER OFF -->
    <li class="xn-icon-button last">
        <a href="#"><span class="fa fa-power-off"></span></a>
        <ul class="animated zoomIn">
            {{-- <li><a href="pages-lock-screen.html">Lock Screen <span class="fa fa-lock"></span></a></li> --}}
            <li><a href="#" class="mb-control" data-box="#mb-signout"> تسجيل الخروج <span class="fa fa-sign-out"></span></a></li>

        </ul>
    </li>
    <!-- END POWER OFF -->
    <!-- SEARCH -->
    {{-- <li class="xn-search">
        <form role="form">
            <input type="text" name="search" placeholder="Search..."/>
        </form>
    </li> --}}
    <!-- END SEARCH -->
    <!-- TOGGLE NAVIGATION -->
    {{-- <li class="xn-icon-button pull-right">
        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
    </li> --}}
    <!-- END TOGGLE NAVIGATION -->
    <!-- MESSAGES -->

    <!-- END MESSAGES -->
    <!-- TASKS -->

    <!-- END TASKS -->
    <!-- LANG BAR -->
    <li class="xn-icon-button pull-right"> {{app()->getLocale()??'no'}}
        <a href="#">
          <span class="flag {{app()->getLocale()=='en'?'flag-gb':'flag-de'}}"></span>
        </a>
        <ul class="xn-drop-left xn-drop-white animated zoomIn">
            <li><a href="{{url('setLang/en')}}"> @lang('page.English') <span class="flag flag-gb"></span></a></li>
            <li><a href="{{url('setLang/ar')}}"> @lang('page.Arabic') <span class="flag flag-de"></span></a></li>
        </ul>
    </li>
  <!-- END LANG BAR -->

    <!-- Start Notifications -->
    <div id="app">
      @if (auth('Company')->check())
          <notification unreaded="{{auth('Company')->user()->unreadNotifications->take(50)}}" :base_url="'{{url('')}}'">
          </notification>
      @endif
    </div>



    <!-- END Notifications -->

</ul>
<!-- END X-NAVIGATION VERTICAL -->
