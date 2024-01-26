<div class="col-lg-4 col-md-6 col-12 toggle-area mb-3">
    <div class="sidebar sticky-bar p-4 rounded shadow">
        <div class="widget mt-4 pt-2">
            <h5 class="widget-title">Projects :</h5>
            <div class="progress-box mt-4">
                <h6 class="title text-muted">Progress</h6>
                <div class="progress">
                    <div class="progress-bar position-relative bg-primary" style="width:50%;">
                        <div class="progress-value d-block text-muted h6">24 / 48</div>
                    </div>
                </div>
            </div><!--end process box-->
        </div>
        
        <div class="widget mt-4">
            <ul class="list-unstyled sidebar-nav mb-0" id="navmenu-nav">
                <li class="navbar-item account-menu px-0">
                    <a href="{{ route('customer.profile') }}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                        <span class="h4 mb-0"><i class="uil uil-dashboard"></i></span>
                        <h6 class="mb-0 ms-2">Profile</h6>
                    </a>
                </li>
                
                <li class="navbar-item account-menu px-0 mt-2">
                    <a href="{{ route('customer.wallet') }}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                        <span class="h4 mb-0"><i class="uil uil-wallet"></i></span>
                        <h6 class="mb-0 ms-2">Wallet</h6>
                    </a>
                </li>
                <li class="navbar-item account-menu px-0 mt-2">
                    <a href="{{ route('customer.payout.request.index') }}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                        <span class="h4 mb-0"><i class="uil uil-transaction"></i></span>
                        <h6 class="mb-0 ms-2">Payouts</h6>
                    </a>
                </li>
                <li class="navbar-item account-menu px-0 mt-2">
                    <a href="{{ route('customer.order.index') }}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                        <span class="h4 mb-0"><i class="uil uil-shopping-cart-alt"></i></span>
                        <h6 class="mb-0 ms-2">Orders</h6>
                    </a>
                </li>
                
                {{-- <li class="navbar-item account-menu px-0 mt-2">
                    <a href="{{ route('customer.address') }}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                        <span class="h4 mb-0"><i class="uil uil-location-point"></i></span>
                        <h6 class="mb-0 ms-2">Addresses</h6>
                    </a>
                </li> --}}
                
               
                
                {{-- <li class="navbar-item account-menu px-0 mt-2">
                    <a href="{{ route('customer.setting') }}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                        <span class="h4 mb-0"><i class="uil uil-setting"></i></span>
                        <h6 class="mb-0 ms-2">Settings</h6>
                    </a>
                </li> --}}
                
                <li class="navbar-item account-menu px-0 mt-2">
                    <a href="{{url('logout')}}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                        <span class="h4 mb-0"><i class="uil uil-dashboard"></i></span>
                        <h6 class="mb-0 ms-2">Logout</h6>
                    </a>
                </li>
            </ul>
        </div>

        <div class="widget mt-4 pt-2">
            <h5 class="widget-title">Follow me :</h5>
            <p class="text-muted">© <script>document.write(new Date().getFullYear())</script> {{getSetting('app_name')}}</p>  
        </div>
    </div>
</div><!--end col-->