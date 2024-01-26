@extends('frontend.layouts.main')

@section('meta_data')
@php
    $meta_title = 'Become Partner | '.getSetting('app_name');
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
    <section class="pt-5 become-partner-img">
        <div class="container-fluid px-5 py-5 px-5">
            <div class="row gx-5">
                <div class="col-lg-12">
                    <h1 class="display-6 mb-2 w-50">Become Our Partner</h1>
                    <p class="lead m-0">Join Forces for Financial Empowerment</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-white" id="scroll-target">
        <div class="container-fluid px-5 mt-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-12 text-center">
                    {{-- <h2 class="fw-bolder text-black fs-24">Unlocking Financial Opportunities</h2> --}}
                    <h2 class="fw-bolder text-black fs-24">Benefits BazaarX Partners</h2>
                    <p class="lead fw-normal text-muted mb-0 fs-15 lh-2">At Gofinx, we believe in the power of collaboration and partnerships to expand our reach and offer exceptional financial services to a broader audience. If you share our passion for personal finance and have a business or platform that aligns with our vision, we invite you to become a partner with us. Together, we can unlock a world of financial opportunities for our customers and clients.</p>
                </div>
                @if (!auth()->check())
                    <div class="mt-3 w-50 mx-auto"> 
                        <div class="alert d-flex justify-content-between " style="background-color: #f9f9f9">
                            <h6 class="mb-0 fw-700" style="line-height: 2">
                                Are you a existing Gofinx Partner?
                            </h6>
                            <a class="no-text-decoration partner-btn ms-1" style="background-color: #f7f7f9 !important;color: #02b290 !important;" data-bs-toggle="modal" href="#signInToggle" role="button">Login</a>
                        </div>
                    </div>
                @endif
                {{-- <div class="row justify-content-center">
                    <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0"
                        src="{{ asset('frontend/assets/img/vision.jpg') }}" alt="...">
                    </div>
                </div> --}}
                
            </div>
            <div class="row pt-5">
                <div class="col-lg-3 col-md-6 col-sm-12 " style="height: 95px!important;">
                    <div class="card text-center shadow border-0  px-3 mb-lg-0 mb-4">
                        <div class="card-body py-3">
                            {{-- <div class="pt-2 pb-3">
                                <img class="img-fluid"
                                src="{{ asset('frontend/assets/img/startup-business1.png') }}" alt="...">
                            </div> --}}
                            <h5 class="card-title">Earnings Boost</h5>
                            <div class="pt-2">
                                <p class="card-text text-muted"> Join BazaarX and unlock a steady income stream. Tap into a wide customer base and skyrocket your earnings.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 " style="height: 95px!important;">
                    <div class="card text-center shadow border-0  px-3 mb-lg-0 mb-4">
                        <div class="card-body py-3">
                            {{-- <div class="pt-2 pb-3">
                                <img class="img-fluid"
                                src="{{ asset('frontend/assets/img/investment.png') }}" alt="...">
                            </div> --}}
                            <h5 class="card-title">Client Expansion</h5>
                            <div class="pt-2">
                                <p class="card-text text-muted">Expand your bussiness clientele effortlessly with BazaarX. Access a network of new clients seeking your expertise.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 " style="height: 95px!important;">
                    <div class="card text-center shadow border-0  px-3 mb-lg-0 mb-4">
                        <div class="card-body py-3">
                            {{-- <div class="pt-2 pb-3">
                                <img class="img-fluid"
                                src="{{ asset('frontend/assets/img/flexible1.png') }}" alt="...">
                            </div> --}}
                            <h5 class="card-title">Flexible Work</h5>
                            <div class="pt-2">
                                <p class="card-text text-muted">Enjoy work-life balance. BazaarX offers flexible schedules, empowering you to work when it suits you best.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 " style="height: 95px!important;">
                    <div class="card text-center shadow border-0  px-3 mb-lg-0 mb-4">
                        <div class="card-body py-3">
                            {{-- <div class="pt-2 pb-3">
                                <img class="img-fluid"
                                src="{{ asset('frontend/assets/img/professional-development1.png') }}" alt="...">
                            </div> --}}
                            <h5 class="card-title">Professional Growth</h5>
                            <div class="pt-2">
                                <p class="card-text text-muted">Elevate your career with BazaarX. Benefit from skill-building opportunities and gain exposure in your field.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="" style="background-color: #efefef">
        <div class="container-fluid px-5 mt-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-8 text-center mx-auto">
                    <h2 class="fw-bolder text-black fs-24 pt-5">Why Partner with Gofinx</h2>
                    <p class="lead fw-normal text-muted mb-0 fs-15 lh-2">By becoming a partner with Gofinx, you become part of a transformative journey to empower individuals with effective financial planning and secure insurance solutions. Together, we can make a significant impact on the financial well-being of people across India. <strong>Join us in this mission and unlock a world of financial opportunities for your audience.</strong></p>
                </div>
                <div class="col-12 my-5 text-center">
                    <a href="javascript:void(0)" class="btn btn-success btn-lg partnerSignUpBtn">Become BazaarX Partner</a>
                </div>
            </div>
        </div>
    </section>
@endsection
@include('frontend.modal.signin')
@include('frontend.modal.signin-with-otp')
