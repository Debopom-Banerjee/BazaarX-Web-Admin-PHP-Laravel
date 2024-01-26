<nav class="d-md-none d-lg-none mobile-d-block navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm osahan-header py-0">
    <div class="">
        <div class="d-flex justify-content-between align-items-center"style="max-height: 75px;">
            <div class="mt-30" style="padding: 12px 0 0 20px;">
                <a class="navbar-brand" href="{{ route('index') }}">
                    {{-- <img src="{{ asset('storage/backend/logos/' . getSetting('app_logo')) }}" alt="#"
                    class="d-block d-md-none d-lg-none img-fluid"> --}}
                    <h5 class="mb-0"><span class="text-theme">Bazaar</span><strong>X</strong></h5>
                    <div class="logo-sub-heading text-muted">Formerly Gofinx</div>
                </a>
            </div>
            <div class="dashboard-icon">
                <div class="d-flex align-items-center">
                    <a class="no-text-decoration partner-btn" style="margin-right:1rem; @if(request()->routeIs('service.show')) margin-top:0px !important; @endif" href="{{ route('become-partner') }}">Become BazaarX Partner</a>
                    {{-- @if (auth()->check())
                    <a class="ms-1 text-decoration-none d-flex pr-2" style="color: #000;" href="{{ route('panel.dashboard') }}" role="button"><span>
                        <i class="bi bi-person-circle text-muted fs-18" style="color:#919191!important"></i></span><span class="ml-2">Dashboard</span></a>
                    @else
                        <a class="ms-1 text-decoration-none d-flex pr-2" data-bs-toggle="modal" style="color: #000;line-height:19px;" href="#signInToggle" role="button"><span>
                            <i class="bi bi-person-circle text-muted fs-18" style="color:#919191!important"></i></span><span class="ml-2">Sign In</span></a>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</nav>


