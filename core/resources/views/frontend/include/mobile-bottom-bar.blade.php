<div class="bottom-navbar">
    <div class="container-fluid">
        <ul class="top-link d-flex list-unstyled mb-0 mobile-bottom-items">
            <li class="">
                <a class="nav-link toggler-navbar" href="javascript:void(0)" >
                   <div class="hamburger-menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="14" viewBox="0 0 25.567 18"><g transform="translate(-776 -462)"><rect data-name="Rectangle 941" width="12.749" height="2.499" rx="1.25" transform="translate(776 462)" fill="currentColor"></rect><rect data-name="Rectangle 942" width="25.567" height="2.499" rx="1.25" transform="translate(776 469.75)" fill="currentColor"></rect><rect data-name="Rectangle 943" width="17.972" height="2.499" rx="1.25" transform="translate(776 477.501)" fill="currentColor"></rect></g></svg>
                </div>
                </a>
            </li>
            <li class="">
                <a class="nav-link" href="{{url('/')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="20px" viewBox="0 0 17.996 20.442"><path d="M48.187,7.823,39.851.182A.7.7,0,0,0,38.9.2L31.03,7.841a.7.7,0,0,0-.211.5V19.311a.694.694,0,0,0,.694.694H37.3A.694.694,0,0,0,38,19.311V14.217h3.242v5.095a.694.694,0,0,0,.694.694h5.789a.694.694,0,0,0,.694-.694V8.335a.7.7,0,0,0-.228-.512ZM47.023,18.617h-4.4V13.522a.694.694,0,0,0-.694-.694H37.3a.694.694,0,0,0-.694.694v5.095H32.2V8.63l7.192-6.98L47.02,8.642v9.975Z" transform="translate(-30.619 0.236)" fill="currentColor" stroke="currentColor" stroke-width="0.4"></path></svg>
                </a>
            </li>
            <li class="">
                <a class="nav-link" id="search-btn" role="button">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M19.0144 17.9256L13.759 12.6703C14.777 11.4129 15.3899 9.81507 15.3899 8.07486C15.3899 4.04156 12.1081 0.759766 8.07483 0.759766C4.04152 0.759766 0.759766 4.04152 0.759766 8.07483C0.759766 12.1081 4.04156 15.3899 8.07486 15.3899C9.81507 15.3899 11.4129 14.777 12.6703 13.759L17.9256 19.0144C18.0757 19.1645 18.2728 19.24 18.47 19.24C18.6671 19.24 18.8642 19.1645 19.0144 19.0144C19.3155 18.7133 19.3155 18.2266 19.0144 17.9256ZM8.07486 13.8499C4.89009 13.8499 2.2998 11.2596 2.2998 8.07483C2.2998 4.89006 4.89009 2.29976 8.07486 2.29976C11.2596 2.29976 13.8499 4.89006 13.8499 8.07483C13.8499 11.2596 11.2596 13.8499 8.07486 13.8499Z" fill="currentColor"></path></svg>
                </a>
            </li>
      
            {{-- <li class="">
                <a class="nav-link" href="{{route('article.index')}}">
                    <i class="bi bi-newspaper text-muted  ms-1 icon-lg"></i>
                </a>
            </li> --}}
            <li class="">
                @if (auth()->check())
                    <a class="nav-link" href="{{ route('panel.dashboard') }}" role="button"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.9001 11C20.9001 5.52836 16.4723 1.09998 11.0001 1.09998C5.52848 1.09998 1.1001 5.52775 1.1001 11C1.1001 16.4231 5.49087 20.9 11.0001 20.9C16.4867 20.9 20.9001 16.448 20.9001 11ZM11.0001 2.26013C15.8193 2.26013 19.7399 6.1808 19.7399 11C19.7399 12.7629 19.2156 14.4573 18.2432 15.8926C14.3386 11.6924 7.66873 11.6849 3.75698 15.8926C2.78459 14.4573 2.26025 12.7629 2.26025 11C2.26025 6.1808 6.18092 2.26013 11.0001 2.26013ZM4.48056 16.8201C7.95227 12.926 14.0488 12.9269 17.5195 16.8201C14.0361 20.7172 7.96541 20.7184 4.48056 16.8201Z" fill="currentColor" stroke="currentColor" stroke-width="0.2"></path><path d="M11 11.5801C12.9191 11.5801 14.4805 10.0187 14.4805 8.09961V6.93945C14.4805 5.02036 12.9191 3.45898 11 3.45898C9.08091 3.45898 7.51953 5.02036 7.51953 6.93945V8.09961C7.51953 10.0187 9.08091 11.5801 11 11.5801ZM8.67969 6.93945C8.67969 5.65996 9.7205 4.61914 11 4.61914C12.2795 4.61914 13.3203 5.65996 13.3203 6.93945V8.09961C13.3203 9.3791 12.2795 10.4199 11 10.4199C9.7205 10.4199 8.67969 9.3791 8.67969 8.09961V6.93945Z" fill="currentColor" stroke="currentColor" stroke-width="0.2"></path></svg></a>
                @else
                    <a class="nav-link" data-bs-toggle="modal" href="#signInToggle" role="button"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.9001 11C20.9001 5.52836 16.4723 1.09998 11.0001 1.09998C5.52848 1.09998 1.1001 5.52775 1.1001 11C1.1001 16.4231 5.49087 20.9 11.0001 20.9C16.4867 20.9 20.9001 16.448 20.9001 11ZM11.0001 2.26013C15.8193 2.26013 19.7399 6.1808 19.7399 11C19.7399 12.7629 19.2156 14.4573 18.2432 15.8926C14.3386 11.6924 7.66873 11.6849 3.75698 15.8926C2.78459 14.4573 2.26025 12.7629 2.26025 11C2.26025 6.1808 6.18092 2.26013 11.0001 2.26013ZM4.48056 16.8201C7.95227 12.926 14.0488 12.9269 17.5195 16.8201C14.0361 20.7172 7.96541 20.7184 4.48056 16.8201Z" fill="currentColor" stroke="currentColor" stroke-width="0.2"></path><path d="M11 11.5801C12.9191 11.5801 14.4805 10.0187 14.4805 8.09961V6.93945C14.4805 5.02036 12.9191 3.45898 11 3.45898C9.08091 3.45898 7.51953 5.02036 7.51953 6.93945V8.09961C7.51953 10.0187 9.08091 11.5801 11 11.5801ZM8.67969 6.93945C8.67969 5.65996 9.7205 4.61914 11 4.61914C12.2795 4.61914 13.3203 5.65996 13.3203 6.93945V8.09961C13.3203 9.3791 12.2795 10.4199 11 10.4199C9.7205 10.4199 8.67969 9.3791 8.67969 8.09961V6.93945Z" fill="currentColor" stroke="currentColor" stroke-width="0.2"></path></svg></a>
                @endif
            </li>

        </ul>
    </div>
</div>
<div class="mobile-nav-sidebar">
    <div class="px-auto py-auto">
        <div class="d-flex justify-content-between side-border-bottom">
            <div style="padding: 25px 0 0 20px;">
                <a class="navbar-brand" href="{{ route('index') }}">
                    {{-- <img src="{{ asset('storage/backend/logos/' . getSetting('app_logo')) }}" alt="#"
                    class="logo-size-mobile"> --}}
                   <h5 class="mb-0"><span class="text-theme">Bazaar</span><strong>X</strong></h5>
                    <div class="logo-sub-heading text-muted">Formerly Gofinx</div>
            </a>
            </div>
            <div>
                <button class="cross-btn mobile-menu-close">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="mt-0.5" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M289.94 256l95-95A24 24 0 00351 127l-95 95-95-95a24 24 0 00-34 34l95 95-95 95a24 24 0 1034 34l95-95 95 95a24 24 0 0034-34z"></path></svg>
                </button>
            </div>

        </div>
        <div>
            <div class="py-6 px-0">
                <ul class="mobile-side-text px-1rem">
                    <li class="nav-item nav-style ">
                        <a class="nav-link" href="{{ route('about.index') }}" >About
                        </a>
                    </li>
        
                    <li class="nav-item">
                        <div class="arrow-rotate">
                            <a class="nav-link d-flex justify-content-between" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>
                                    Services
                                </span>
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="transition duration-200 ease-in-out transform rotate-0 w-17" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M256 294.1L383 167c9.4-9.4 24.6-9.4 33.9 0s9.3 24.6 0 34L273 345c-9.1 9.1-23.7 9.3-33.1.7L95 201.1c-4.7-4.7-7-10.9-7-17s2.3-12.3 7-17c9.4-9.4 24.6-9.4 33.9 0l127.1 127z"></path></svg>
                            </a>
                            
                            <ul class="dropdown-menu mobile-dropdown-border dashed" style="height: 200px;overflow-x: auto;">
                                @foreach (App\Models\Category::whereCategoryTypeId(15)->get() as $category)
                                <li class="nav-item">
                                    <div class="li-dash">
                                    <a class="dropdown-item text-muted" href="{{ route('search.index',['category_id' => $category->id]) }}">{{ ($category->name) }}</a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
        
                    <li class="nav-item">
                        <div class="arrow-rotate">
                            <a class="nav-link d-flex justify-content-between" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                               <span> Resources</span>
                               <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="transition duration-200 ease-in-out transform rotate-0 w-17" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M256 294.1L383 167c9.4-9.4 24.6-9.4 33.9 0s9.3 24.6 0 34L273 345c-9.1 9.1-23.7 9.3-33.1.7L95 201.1c-4.7-4.7-7-10.9-7-17s2.3-12.3 7-17c9.4-9.4 24.6-9.4 33.9 0l127.1 127z"></path></svg>
                            </a>
                            <ul class="dropdown-menu mobile-dropdown-border dashed">
                                <li class="nav-item"><a class="dropdown-item text-muted" href="{{ route('article.index') }}">Blogs</a></li>
                                <li class="nav-item"><a class="dropdown-item text-muted" href="{{ route('academy') }}">Academy</a></li>
                                <li class="nav-item"><a class="dropdown-item text-muted" href="{{ route('resources.index') }}">Free Resources</a></li>
                            </ul>
                        </div>
                    </li>
                    
                    
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('job.index') }}" >Career
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('become-partner') }}" >Become Partner
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('contact.index') }}" > Contact
                        </a>
                    </li>
        
                </ul>
            </div>
        </div>
        <div class="social-sticky-card">
            <div class="social-border-top">

                <a href="{{getSetting('facebook_link')}}"class="icon-color">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M480 257.35c0-123.7-100.3-224-224-224s-224 100.3-224 224c0 111.8 81.9 204.47 189 221.29V322.12h-56.89v-64.77H221V208c0-56.13 33.45-87.16 84.61-87.16 24.51 0 50.15 4.38 50.15 4.38v55.13H327.5c-27.81 0-36.51 17.26-36.51 35v42h62.12l-9.92 64.77H291v156.54c107.1-16.81 189-109.48 189-221.31z"></path></svg>
                </a>
                <a href="{{getSetting('twitter_link')}}"class="icon-color">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M496 109.5a201.8 201.8 0 01-56.55 15.3 97.51 97.51 0 0043.33-53.6 197.74 197.74 0 01-62.56 23.5A99.14 99.14 0 00348.31 64c-54.42 0-98.46 43.4-98.46 96.9a93.21 93.21 0 002.54 22.1 280.7 280.7 0 01-203-101.3A95.69 95.69 0 0036 130.4c0 33.6 17.53 63.3 44 80.7A97.5 97.5 0 0135.22 199v1.2c0 47 34 86.1 79 95a100.76 100.76 0 01-25.94 3.4 94.38 94.38 0 01-18.51-1.8c12.51 38.5 48.92 66.5 92.05 67.3A199.59 199.59 0 0139.5 405.6a203 203 0 01-23.5-1.4A278.68 278.68 0 00166.74 448c181.36 0 280.44-147.7 280.44-275.8 0-4.2-.11-8.4-.31-12.5A198.48 198.48 0 00496 109.5z"></path></svg>
                </a>

                
                <a href="{{getSetting('instagram_link')}}"class="icon-color">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M349.33 69.33a93.62 93.62 0 0193.34 93.34v186.66a93.62 93.62 0 01-93.34 93.34H162.67a93.62 93.62 0 01-93.34-93.34V162.67a93.62 93.62 0 0193.34-93.34h186.66m0-37.33H162.67C90.8 32 32 90.8 32 162.67v186.66C32 421.2 90.8 480 162.67 480h186.66C421.2 480 480 421.2 480 349.33V162.67C480 90.8 421.2 32 349.33 32z"></path><path d="M377.33 162.67a28 28 0 1128-28 27.94 27.94 0 01-28 28zM256 181.33A74.67 74.67 0 11181.33 256 74.75 74.75 0 01256 181.33m0-37.33a112 112 0 10112 112 112 112 0 00-112-112z"></path></svg>
                </a>


                <a href="{{getSetting('youtube_link')}}"class="icon-color">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M508.64 148.79c0-45-33.1-81.2-74-81.2C379.24 65 322.74 64 265 64h-18c-57.6 0-114.2 1-169.6 3.6C36.6 67.6 3.5 104 3.5 149 1 184.59-.06 220.19 0 255.79q-.15 53.4 3.4 106.9c0 45 33.1 81.5 73.9 81.5 58.2 2.7 117.9 3.9 178.6 3.8q91.2.3 178.6-3.8c40.9 0 74-36.5 74-81.5 2.4-35.7 3.5-71.3 3.4-107q.34-53.4-3.26-106.9zM207 353.89v-196.5l145 98.2z"></path></svg>
                </a>
            </div>
        </div>
    </div>
</div>
@include('frontend.modal.signin')
@include('frontend.modal.register')
@include('frontend.modal.search-item')

