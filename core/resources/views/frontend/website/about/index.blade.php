@extends('frontend.layouts.main')

    @section('meta_data')
    @php
        $meta_title = 'About | '.getSetting('app_name');
        $meta_description = 'Empowering Your Financial Journey' ?? getSetting('seo_meta_description');
        $meta_keywords = 'Financial journey' ?? getSetting('seo_meta_keywords');
        $meta_motto = '' ?? getSetting('site_motto');
        $meta_abstract = '' ?? getSetting('site_motto');
        $meta_author_name = '' ?? 'Defenzelite';
        $meta_author_email = '' ?? 'support@defenzelite.com';
        $meta_reply_to = '' ?? getSetting('frontend_footer_email');
        $meta_img = ' ';
    @endphp
    @endsection

@section('content')

    <style>
        .text-break{
            word-break: break-all !important;
        }
        .avatar-team{
            max-height: 220px;
            min-height: 220px;
            max-width: 265px;
            min-width: 265px;
            object-fit: cover;
        }
    </style>

    <section class="pt-5 about-img mobile-d-none">
        <div class="container-fluid py-5 px-5">
            <div class="row gx-5">
                <div class="col-lg-12">
                    <h1 class="display-6 mb-2 w-50">About us</h1>
                    <p class="lead m-0">Empowering Your Financial Journey</p>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5 d-md-none d-lg-none mobile-d-block">
        <div class="container-fluid">
            <div class="row gx-5">
                <div class="col-lg-12">
                    <h1 class="display-6 mb-2 w-50">About us</h1>
                    <p class="lead m-0">Empowering Your Financial Journey</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-white" id="scroll-target">
        <div class="container-fluid px-5 mobile-px-1">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-12">
                    <h2 class="fs-24 fw-bolder text-black">BazaarX Vision</h2>
                    <h4>To Create Digital Marketplace of Services</h4>
                    <p class="lead fw-normal text-muted mb-0 fs-15 lh-2">
                        At Bazaarx, we believe in the power of innovation and technology to transform businesses of all sizes. We are not just a marketplace; we are a catalyst for growth, a beacon of possibilities, and a haven for those who dare to dream big. Our journey began with a simple yet profound goal: to provide Indian individuals, MSMEs, and start-ups with a comprehensive platform that not only caters to their diverse business needs but propels them towards unmatched success.
                    </p>
                </div>
                
                <div class="col-lg-12">
                    <div class="mt-50 mobile-mt-10">
                        <img class="img-fluid rounded mb-5 mb-lg-0 mobile-mb-0 about-banner-img"
                        src="{{ asset('frontend/assets/img/icons/about-banner.png') }}"alt="...">
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid px-5 mobile-px-1">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-12">
                    <h2 class="fs-24 fw-bolder text-black">What Sets Us Apart</h2>

                    <p class="lead fw-normal text-muted mb-0 fs-15 lh-2">
                        At Bazaarx, we stand out for our unwavering commitment to quality, excellence, and inclusivity. We curate a diverse spectrum of business services, handpicked to meet the unique requirements of our vast clientele. From cutting-edge technological solutions to creative design services, from expert consultations to collaborative tools – we bring the entire ecosystem under one roof.
                    </p>
                </div>
            </div>
        </div>
    </section>
    @if($teams->count() > 0)
        <section class="py-5 bg-white mobile-py-1">
            <div class="container-fluid px-5 mobile-px-1">
                <div class="text-center">
                    <h2 class="fs-24 fw-bolder text-black">Our Team</h2>
                    <p class="lead fw-normal text-muted mb-5">Dedicated to quality and your success</p>
                </div>
                <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-3">
                    @foreach ($teams as $team)
                        <div class="col-md-4 col-12 mb-5 mb-5 mb-xl-0 mt-4">
                            <div class="text-center">
                                <img class="img-fluid rounded-circle mb-4 px-4 avatar-team" src="{{ asset('storage/backend/constant-management/sliders/'.$team->image) }}" alt="...">
                                <h5 class="fw-bolder">{{ $team->title }}</h5>
                                 <a class="btn btn-lg" href="{{ $team->link }}"> 
                                    <i class="bi bi-linkedin" style="color: #0b65c2;"></i>
                                </a>
                                <div class="text-muted text-break">{{ \Str::limit($team->description,350,'...') }}</div>
                               
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection