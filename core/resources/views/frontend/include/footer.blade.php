   @php
       $pages = App\Models\WebsitePage::where('status',1)->get();
   @endphp
   <footer class="py-1 footer-1 mobile-mb-45">
        @if(!isset($disableFooter))
        <div class="container-fluid px-4 pb-50">
            <div class="row mt-5 d-grid grid-md-cols-7 grid-xl-cols-12 sm-gap-9">
                {{-- <div class="">
                    <div>
                        <img src="{{ getBackendLogo(getSetting('app_white_logo'))}}" alt
                            class="img-fluid footer-logo">
                    </div>
                </div> --}}
                <div class="col-md-span-3 col-sm-span-3 mobile-col-span-first">
                   <div class="logo mb-3">
                        <h5 class="mb-0"><span class="text-theme">Bazaar</span><strong>X</strong></h5>
                        <div class="logo-sub-heading text-muted">Formerly Gofinx</div>
                   </div>
                        <p class="text-muted fs-15">{{ getSetting('frontend_footer_description') }}</p>
                        <div class="social-icons social-icons-color mt-4">
                            <a href="{{getSetting('facebook_link')}}" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="bi bi-facebook" style="color: #3b5998;"></i></a>
                            <a href="{{getSetting('twitter_link')}}" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="bi bi-twitter"style="color: #55acee;"></i></a>
                            <a href="{{getSetting('instagram_link')}}" class="social-icon social-instagram instagram" title="Instagram" target="_blank"><i class="bi bi-instagram"style="color: #ac2bac;"></i></a>
                            <a href="{{getSetting('youtube_link')}}" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="bi bi-youtube" style="color: #ed302f;"></i></a>
                            <a href="{{getSetting('linkedin_link')}}" class="social-icon social-linkedin" title="linkedin" target="_blank"><i class="bi bi-linkedin" style="color: #0b65c2;"></i></a>
                            {{-- <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a> --}}
                        </div><!-- End .soial-icons -->
                </div>
                <div class="default-text col-md-span-2">
                    <h6 class="">About Us</h6>
                    <ul class="list-unstyled d-grid gap-1 text-decoration-none">
                        <li>
                                <a class="text-decoration-none"href="{{ route('about.index') }}">About us</a>
                            </li>
                        <li>
                                <a class="text-decoration-none" href="{{ route('job.index') }}">Career</a>
                            </li>
                        <li>
                                <a class="text-decoration-none" href="{{ route('contact.index') }}">Contact Us</a>
                            </li>
                    </ul>
                </div>
                <div class="default-text col-md-span-2">
                    <h6 class="">Resources</h6>
                    <ul class="list-unstyled d-grid gap-1">
                        <li><a class="text-decoration-none" href="{{ route('article.index') }}">Blogs</a></li>
                        <li><a class="text-decoration-none" href="{{ route('academy') }}">Academy</a></li>
                        <li><a class="text-decoration-none" href="{{ route('resources.index') }}">Free Resources</a></li>
                        <li><a class="text-decoration-none" href="{{ url('sitemap.xml') }}">Sitemap</a></li>
                    </ul>
                </div>
                <div class="default-text col-md-span-2 mobile-grid-column-span-2  mobile-useful-link">
                    <h6 class="">Useful Links</h6>
                    <ul class="list-unstyled d-grid gap-1">
                            @foreach ($pages as $page)
                                <li><a class="text-decoration-none" href="{{ route('page.slug',$page->slug)}}">{{ $page->title }}</a></li>
                            @endforeach
                    </ul>
                </div>
                <div class="default-text col-md-span-3 mobile-grid-column-span-2">
                    <h6 class="">Subscribe Now</h6>
                    <p class="text-muted fs-15">Subscribe your email for newsletter and featured news based on your interest</p>
                    <form action="{{ route('newsletter.store') }}" method="POST" class="mt-3" id="subscription">
                        @csrf
                        <div class="input-group p-2 border br-7">
                            <span class="input-group-text bg-white border-0">
                                <i class="bi bi-envelope text-muted"></i>
                            </span>
                            <input name="email" type="email" id="newsletterEmail" class="form-control bg-white border-0 ps-0 me-1"
                                placeholder="Write your email here" required>
                            <span class="mt-2 newsletter-submit">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[18px] 2xl:w-5 h-[18px] 2xl:h-5 false"><g clip-path="url(#clip0)"><path d="M18.809 8.21633L2.67252 1.52062C1.99272 1.23851 1.22471 1.36262 0.668264 1.84434C0.111818 2.32613 -0.120916 3.06848 0.0609589 3.78164L1.49725 9.41414H8.52951C8.85311 9.41414 9.11549 9.67648 9.11549 10.0001C9.11549 10.3237 8.85315 10.5861 8.52951 10.5861H1.49725L0.0609589 16.2186C-0.120916 16.9318 0.111779 17.6741 0.668264 18.1559C1.22584 18.6386 1.99393 18.7611 2.67256 18.4796L18.809 11.7839C19.5437 11.4791 20.0001 10.7955 20.0001 10.0001C20.0001 9.20469 19.5437 8.52113 18.809 8.21633Z" fill="#02B290"></path></g><defs><clipPath id="clip0"><rect width="20" height="20" fill="white"></rect></clipPath></defs></svg>
                            </span>
                        </div>
                    </form>
                    <div class="showSuccessDiv d-none">
                        <p class="text-green fs-13" style="color: #02b290;">
                            Thank you for subscribing to our newsletter
                        </p>
                    </div>
                </div>
            </div>
        </div>
       @endif

       <div class="px-20">
           <hr>
            <div class="mx-auto">
                <div class="d-flex justify-content-between mobile-d-block mobile-text-center">
                    <div>
                        <p class="mobile-mb-0">©&nbsp;{{ getSetting('frontend_copyright_text') }}
                        </p>
                    </div>
                    <div>
                        <p class="float-sm-right mt-1 mt-sm-0 text-center">
                            {{ __('Developed & Designed by')}} 
                            <a href="https://www.defenzelite.com" class="text-dark no-text-decoration" target="_blank">
                                {{ __('Defenzelite Pvt.Ltd')}}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
       </div>
   </footer>
