<nav class="mobile-d-none navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm osahan-header py-0">
    <div class="container-fluid" style="padding: 0 2rem 0 2rem;">
        <a class="navbar-brand" href="{{ route('index') }}">
                {{-- Desktop Logo Display --}}
            {{-- <img src="{{ asset('storage/backend/logos/' . getSetting('app_logo')) }}" alt="#"
                class="img-fluid d-none d-md-block"> --}}
                    {{-- Mobile Logo Display --}}
            {{-- <img src="{{ asset('storage/backend/logos/' . getSetting('app_logo')) }}" alt="#"
                class="d-block d-md-none d-lg-none img-fluid"> --}}
                <h5 class="mb-0"><span class="text-theme">Bazaar</span><strong>X</strong></h5>
                <div class="logo-sub-heading text-muted">Formerly Gofinx</div>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-3 top-link pb-1 pt-1">
                <li class="nav-item  mx-1">
                    <a class="nav-link" href="{{ route('index') }}" >Home
                    </a>
                </li>
                <li class="nav-item  mx-1">
                    <a class="nav-link" href="{{ route('about.index') }}" >About
                    </a>
                </li>

                <li class="nav-item mx-1 dropdown">
                    <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-expanded="false">
                        Services<i class="bi bi-chevron-down small ms-1"></i>
                    </a>
                    <ul class="dropdown-menu header-category">
                        @foreach (App\Models\Category::whereCategoryTypeId(15)->where('parent_id',null)->get() as $category)
                        <li><a class="dropdown-item" href="{{ route('search.index',['category_id' => $category->id]) }}">{{ ($category->name) }}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item mx-1 dropdown">
                    <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-expanded="false">
                        Resources<i class="bi bi-chevron-down small ms-1"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('article.index') }}">Blogs</a></li>
                        <li><a class="dropdown-item" href="{{ route('academy') }}">Academy</a></li>
                        <li><a class="dropdown-item" href="{{ route('resources.index') }}">Free Resources</a></li>
                    </ul>
                </li>
                
                
                <li class="nav-item mx-1">
                    <a class="nav-link" href="{{ route('job.index') }}" >Career
                    </a>
                </li>
                {{-- <li class="nav-item mx-1">
                    <a class="nav-link" href="{{ route('become-partner') }}" >Become Partner
                    </a>
                </li> --}}
                <li class="nav-item mx-1">
                    <a class="nav-link" href="{{ route('contact.index') }}" > Contact
                    </a>
                </li>

            </ul>
        </div>
        <div class="dashboard-icon">
            <div class="d-flex align-items-center auth-text">
                <span style="margin-right: 5px;"></span>
                
                <a class="no-text-decoration partner-btn"style="margin-right:1rem;" href="{{ route('become-partner') }}">Become BazaarX Partner</a>

                @if (auth()->check())
                    <a class="ms-1 text-decoration-none d-flex auth-btn"  href="{{ route('panel.dashboard') }}" role="button"><span>
                        <i class="bi bi-person-circle text-muted fs-18" style="color:#919191!important"></i></span><span class="ml-2">Dashboard</span></a>
                @else
                    <a class="ms-1 text-decoration-none d-flex auth-btn" data-bs-toggle="modal" href="#signInToggle" role="button"><span>
                    <i class="bi bi-person-circle text-muted fs-18" style="color:#919191!important"></i></span><span class="ml-2">Sign In</span></a>
                @endif
                
            </div>
        </div>
    </div>
</nav>
@include('frontend.modal.signin')
@include('frontend.modal.signin-with-otp')
@include('frontend.modal.register')
@include('frontend.modal.user-register')








