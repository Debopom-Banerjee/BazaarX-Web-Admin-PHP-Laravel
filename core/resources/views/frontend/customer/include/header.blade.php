  <!-- Navbar Start -->
  <header id="topnav" class="defaultscroll sticky">
    <div class="container">
        <!-- Logo container-->
        <a class="logo" href="{{ url('/') }}">
            <span class="logo-light-mode">
                <img src="{{ getBackendLogo(getSetting('app_white_logo'))}}" class="l-dark" height="24" alt="">
                <img src="{{ getBackendLogo(getSetting('app_white_logo'))}}" class="l-light" height="24" alt="">
            </span>
            <img src="{{ getBackendLogo(getSetting('app_white_logo'))}}" height="24" class="logo-dark-mode" alt="">
        </a>

        {{-- <!-- End Logo container-->
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div> --}}

        <!--Login button Start-->
        <ul class="buy-button list-inline mb-0 navigation-menu">
            <li class="has-submenu parent-parent-menu-item mb-0">
                <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" class="pl-0">
                    <div class="login-btn-primary"><span class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="user" class="fea icon-sm"></i></span></div>
                </a>
                <ul class="submenu">
                    @auth
                        @if (AuthRole() == 'Admin')
                        <li><a href="{{ url('panel/dashboard') }}" class="sub-menu-item"><i class="uil uil-user"></i> Profile</a></li>
                        @else
                        <li><a href="{{ route('customer.profile') }}" class="sub-menu-item"><i class="uil uil-user me-1"></i>Profile</a></li>
                            @if(auth()->user() && session()->has("admin_user_id") && session()->has("temp_user_id"))
                               <li> <a class="sub-menu-item" href="{{ route("panel.auth.logout-as") }}"><i class="uil uil-sign-in-alt align-middle me-1"></i>Re-Login as {{ NameById(session()->get("admin_user_id")) }}</a></li>
                            @endif
                        @endif
                        <li><a href="{{url('/logout')}}" class="sub-menu-item"><i class="uil uil-sign-out-alt align-middle me-1"></i> Logout</a></li>
                    @else
                        <li><a href="{{url('/login')}}" class="sub-menu-item">Login</a></li>
                    @endif    
                </ul>
            </li>
    
            {{-- <li class="list-inline-item ps-0 pe-0 mb-0 m-0">
                <a href="#" target="_blank">
                    <div class="login-btn-primary"><span class="btn btn-icon btn-pills btn-primary"><i data-feather="shopping-cart" class="fea icon-sm"></i></span></div>
                    <div class="login-btn-light"><span class="btn btn-icon btn-pills btn-light"><i data-feather="shopping-cart" class="fea icon-sm"></i></span></div>
                </a>
            </li> --}}
        </ul>
        <!--Login button End-->
    </div><!--end container-->
</header><!--end header-->
<!-- Navbar End -->