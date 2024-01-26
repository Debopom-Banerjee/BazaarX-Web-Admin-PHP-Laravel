@extends('frontend.layouts.main')

@section('meta_data')
    @php
		$meta_title = 'About | '.getSetting('app_name');		
		$meta_description = '' ?? getSetting('seo_meta_description');
		$meta_keywords = '' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');		
		$meta_abstract = '' ?? getSetting('site_motto');		
		$meta_author_name = '' ?? 'Defenzelite';		
		$meta_author_email = '' ?? 'support@defenzelite.com';		
		$meta_reply_to = '' ?? getSetting('frontend_footer_email');		
		$meta_img = ' ';		
	@endphp
@endsection

@section('content')
  <!-- Hero Start -->
<section class="bg-half-170 bg-light d-table w-100">
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="pages-heading">
                    <h4 class="title mb-0"> About us </h4>
                </div>
            </div>  <!--end col-->
        </div><!--end row-->
        
        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="#">Page</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ul>
            </nav>
        </div>
    </div> <!--end container-->
</section><!--end section-->
<!-- Hero End -->

<!-- Shape Start -->
<div class="position-relative">
    <div class="shape overflow-hidden text-color-white">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
        </svg>
    </div>
</div>
<!--Shape End-->

<!-- About Start -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-5 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <div class="position-relative">
                    <img src="{{asset('frontend/assets/images/company/about.jpg')}}" class="rounded img-fluid mx-auto d-block" alt="">
                    <div class="play-icon">
                        <a href="#!" data-type="youtube" data-id="yba7hPeTSjk" class="play-btn lightbox border-0">
                            <i class="mdi mdi-play text-primary rounded-circle shadow"></i>
                        </a>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-7 col-md-7 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <div class="section-title ms-lg-4">
                    <h4 class="title mb-4">Our Story</h4>
                    <p class="text-muted">Start working with <span class="text-primary fw-bold">{{ getSetting('app_name') }}</span> that can provide everything you need to generate awareness, drive traffic, connect. Dummy text is text that is used in the publishing industry or by web designers to occupy the space which will later be filled with 'real' content. This is required when, for example, the final text is not yet available. Dummy texts have been in use by typesetters since the 16th century.</p>
                    <a href="javascript:void(0)" class="btn btn-primary mt-3">Buy Now <i class="uil uil-angle-right-b"></i></a>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <div class="container mt-100 mt-60">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">Key Features</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Start working with <span class="text-primary fw-bold">{{ getSetting('app_name') }}</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="d-flex features feature-primary key-feature align-items-center p-3 rounded shadow">
                    <div class="icon text-center rounded-circle me-3">
                        <i data-feather="monitor" class="fea icon-ex-md"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="title mb-0">Fully Responsive</h4>
                    </div>
                </div>
            </div><!--end col-->
            
            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="d-flex features feature-primary key-feature align-items-center p-3 rounded shadow">
                    <div class="icon text-center rounded-circle me-3">
                        <i data-feather="heart" class="fea icon-ex-md"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="title mb-0">Browser Compatibility</h4>
                    </div>
                </div>
            </div><!--end col-->
            
            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="d-flex features feature-primary key-feature align-items-center p-3 rounded shadow">
                    <div class="icon text-center rounded-circle me-3">
                        <i data-feather="eye" class="fea icon-ex-md"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="title mb-0">Retina Ready</h4>
                    </div>
                </div>
            </div><!--end col-->
            
            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="d-flex features feature-primary key-feature align-items-center p-3 rounded shadow">
                    <div class="icon text-center rounded-circle me-3">
                        <i data-feather="bold" class="fea icon-ex-md"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="title mb-0">Based On Bootstrap 5</h4>
                    </div>
                </div>
            </div><!--end col-->
            
            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="d-flex features feature-primary key-feature align-items-center p-3 rounded shadow">
                    <div class="icon text-center rounded-circle me-3">
                        <i data-feather="feather" class="fea icon-ex-md"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="title mb-0">Feather Icons</h4>
                    </div>
                </div>
            </div><!--end col-->
            
            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="d-flex features feature-primary key-feature align-items-center p-3 rounded shadow">
                    <div class="icon text-center rounded-circle me-3">
                        <i data-feather="code" class="fea icon-ex-md"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="title mb-0">Built With SASS</h4>
                    </div>
                </div>
            </div><!--end col-->
            
            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="d-flex features feature-primary key-feature align-items-center p-3 rounded shadow">
                    <div class="icon text-center rounded-circle me-3">
                        <i data-feather="user-check" class="fea icon-ex-md"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="title mb-0">W3c Valid Code</h4>
                    </div>
                </div>
            </div><!--end col-->
            
            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="d-flex features feature-primary key-feature align-items-center p-3 rounded shadow">
                    <div class="icon text-center rounded-circle me-3">
                        <i data-feather="git-merge" class="fea icon-ex-md"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="title mb-0">Flaticon Icons</h4>
                    </div>
                </div>
            </div><!--end col-->
            
            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="d-flex features feature-primary key-feature align-items-center p-3 rounded shadow">
                    <div class="icon text-center rounded-circle me-3">
                        <i data-feather="settings" class="fea icon-ex-md"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="title mb-0">Easy to customize</h4>
                    </div>
                </div>
            </div><!--end col-->
            
            <div class="col-12 mt-4 pt-2 text-center">
                <a href="javascript:void(0)" class="btn btn-primary">See More <i class="mdi mdi-arrow-right"></i></a>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- About End -->

<!-- Team Start -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">Our Greatest Minds</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Start working with <span class="text-primary fw-bold">{{ getSetting('app_name') }}</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            @for ($i = 1; $i < 4; $i++)
            <div class="col-lg-3 col-md-6 col-6 mt-4 pt-2">
                    <div class="card team team-primary text-center bg-transparent border-0">
                        <div class="card-body p-0">
                            <div class="position-relative">
                                <img src="assets/images/client/01.jpg" class="img-fluid avatar avatar-ex-large rounded-circle" alt="">
                                <ul class="list-unstyled mb-0 team-icon">
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-primary btn-pills btn-sm btn-icon"><i data-feather="facebook" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-primary btn-pills btn-sm btn-icon"><i data-feather="instagram" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-primary btn-pills btn-sm btn-icon"><i data-feather="twitter" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-primary btn-pills btn-sm btn-icon"><i data-feather="linkedin" class="icons"></i></a></li>
                                </ul><!--end icon-->
                            </div>
                            <div class="content pt-3 pb-3">
                                <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">Ronny Jofra</a></h5>
                                <small class="designation text-muted">C.E.O</small>
                            </div>                                
                        </div>
                    </div>
            </div><!--end col-->
                
            @endfor
        </div><!--end row-->
    </div><!--end container-->

    <div class="container mt-100 mt-60">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h4 class="title mb-4">See everything about your employee at one place.</h4>
                    <p class="text-muted para-desc mx-auto">Start working with <span class="text-primary fw-bold">{{ getSetting('app_name') }}</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>
                
                    <div class="mt-4">
                        <a href="javascript:void(0)" class="btn btn-primary mt-2 me-2">Get Started Now</a>
                        <a href="javascript:void(0)" class="btn btn-outline-primary mt-2">Free Trial</a>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- Team End -->  

@endsection