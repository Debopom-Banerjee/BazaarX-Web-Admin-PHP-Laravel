@extends('frontend.layouts.main')

@section('meta_data')
    @php
		$meta_title = 'Home | '.getSetting('app_name');		
		$meta_description = '' ?? getSetting('seo_meta_description');
		$meta_keywords = '' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');		
		$meta_abstract = '' ?? getSetting('site_motto');		
		$meta_author_name = '' ?? 'Defenzelite';		
		$meta_author_email = '' ?? 'support@defenzelite.com';		
		$meta_reply_to = '' ?? getSetting('frontend_footer_email');		
		$meta_img = ' ';
        $customer = 1;		
	@endphp
@endsection

@section('content')
    <!-- Hero Start -->
    <section class="bg-profile d-table w-100 bg-primary" style="background: url('assets/images/account/bg.png') center center;">
        <div class="container">
            @include('frontend.customer.include.profile-header')
        </div><!--ed container-->
    </section><!--end section-->
    <!-- Hero End -->

    <!-- Profile Start -->
    <section class="section mt-60">
        <div class="container mt-lg-3">
            <div class="row">
                @include('frontend.customer.include.sidebar')
                <div class="col-lg-8 col-12">
                    <div class="border-bottom pb-4">
                        <h5>{{ auth()->user()->name }}</h5>
                        <p class="text-muted mb-0">{{ auth()->user()->bio ?? 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta, consequatur.' }}</p>
                    </div>
                    
                    <div class="border-bottom pb-4">
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <h5>Personal Details :</h5>
                                <div class="mt-4">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="mail" class="fea icon-ex-md text-muted me-3"></i>
                                        <div class="flex-1">
                                            <h6 class="text-primary mb-0">Email :</h6>
                                            <a href="javascript:void(0)" class="text-muted">{{ auth()->user()->email }}</a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-3">
                                        <i data-feather="gift" class="fea icon-ex-md text-muted me-3"></i>
                                        <div class="flex-1">
                                            <h6 class="text-primary mb-0">Birthday :</h6>
                                            <p class="text-muted mb-0">
                                                {{ getFormattedDate(auth()->user()->dob ?? now()) }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-3">
                                        <i data-feather="map-pin" class="fea icon-ex-md text-muted me-3"></i>
                                        <div class="flex-1">
                                            <h6 class="text-primary mb-0">Location :</h6>
                                            <a href="javascript:void(0)" class="text-muted">{{ fetchFirst('App\Models\State',auth()->user()->state,'name') }}, {{ fetchFirst('App\Models\Country',auth()->user()->country,'name') }}</a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-3">
                                        <i data-feather="phone" class="fea icon-ex-md text-muted me-3"></i>
                                        <div class="flex-1">
                                            <h6 class="text-primary mb-0">Cell No :</h6>
                                            <a href="javascript:void(0)" class="text-muted">{{auth()->user()->phone}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end col-->

                            <div class="col-md-6 mt-4 pt-2 pt-sm-0">
                                <h5>Experience :</h5>

                                @for ($i = 1; $i < 4; $i++)
                                    <div class="d-flex features feature-primary key-feature align-items-center p-3 rounded shadow mt-4">
                                        <img src="assets/images/job/Circleci.svg" class="avatar avatar-ex-sm" alt="">
                                        <div class="flex-1 content ms-3">
                                            <h4 class="title mb-0">Senior Web Developer</h4>
                                            <p class="text-muted mb-0">3 Years Experience</p>
                                            <p class="text-muted mb-0"><a href="javascript:void(0)" class="read-more">CircleCi</a> @London, UK</p>    
                                        </div>
                                    </div>
                                @endfor

                            </div><!--end col-->
                        </div><!--end row-->
                    </div>

                    <h5 class="mt-4 mb-0">Posts & News :</h5>
                    <div class="row">
                        @for ($i = 0; $i < 2; $i++)
                            <div class="col-md-6 mt-4 pt-2">
                                <div class="card blog blog-primary rounded border-0 shadow">
                                    <div class="position-relative">
                                        <img src="{{asset('frontend/assets/images/blog/01.jpg')}}" class="card-img-top rounded-top" alt="...">
                                        <div class="overlay rounded-top"></div>
                                    </div>
                                    <div  iv class="card-body content">
                                        <h5><a href="javascript:void(0)" class="card-title title text-dark">Design your apps in your own way</a></h5>
                                        <div class="post-meta d-flex justify-content-between mt-3">
                                            <ul class="list-unstyled mb-0">
                                                <li class="list-inline-item me-2 mb-0"><a href="javascript:void(0)" class="text-muted like"><i class="uil uil-heart me-1"></i>33</a></li>
                                                <li class="list-inline-item"><a href="javascript:void(0)" class="text-muted comments"><i class="uil uil-comment me-1"></i>08</a></li>
                                            </ul>
                                            <a href="#" class="text-muted readmore">Read More <i class="uil uil-angle-right-b align-middle"></i></a>
                                        </div>
                                    </div>
                                    <div class="author">
                                        <small class="user d-block"><i class="uil uil-user"></i> Calvin Carlo</small>
                                        <small class="date"><i class="uil uil-calendar-alt"></i> 25th June 2021</small>
                                    </div>
                                </div>
                            </div><!--end col-->
                        @endfor

                        <div class="col-12 mt-4 pt-2">
                            <a href="" class="btn btn-primary">See More <i class="uil uil-angle-right-b align-middle"></i></a>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- Profile End -->
    
@endsection