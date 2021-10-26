 <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row shadow-none">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo p-4" href="{{route('dashboard')}}"><img src="{{ asset('assets/images/assets/Dashboard/Group1030.png') }}" class="img-fluid h-auto" alt="logo"/></a>
    <a class="navbar-brand brand-logo-mini" href="{{route('dashboard')}}"><img src="{{ asset('assets/images/assets/Dashboard/Group1030.png') }}" alt="logo"/></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-end justify-content-end justify-content-md-between">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>

    <div class="ml-4 d-none d-md-block">
      <h2 class="text-warning font-weight-bold">@yield('page_title','Dashboard')</h2>
      <p class="text-white">Hi, Andy welcome back to Defix Finance Dashboard.</p>
    </div>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown align-self-md-end">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
          <img src="{{ asset('assets/images/assets/Dashboard/Group853.png') }}" alt="">
        </a>
        <div class="ml-2">
          <h4 class="text-warning font-weight-bold mb-0">Andy John</h4>
          <span>Active</span>
        </div>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item">
            <i class="ti-settings text-primary"></i>
            Settings
          </a>
          <a class="dropdown-item">
            <i class="ti-power-off text-primary"></i>
            Logout
          </a>
        </div>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </li>
    </ul>
  </div>
</nav>