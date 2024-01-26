@php
    // $disableFooter = 1;
@endphp
@extends('frontend.layouts.main')

@section('meta_data')
@php
    $meta_title = 'Service | '.getSetting('app_name');
    $meta_description = 'BazaarX offers a comprehensive range of AI-powered financial services, including Tax Filings, GST Registration, ITR Filing, MSME Registration, Start-up Funding, Logo Design, Branding, Financial & Marketing Services, Legal Assistance, Software Solutions, Wealth Management, and more. Simplify your finances and grow your business with our affordable and professional services under one roof.' ?? getSetting('seo_meta_description');
    $meta_keywords = 'AI-powered financial services,Financial Services, Marketing Services' ?? getSetting('seo_meta_keywords');
    $meta_motto = '' ?? getSetting('site_motto');
    $meta_abstract = '' ?? getSetting('site_motto');
    $meta_author_name = '' ?? 'Defenzelite';
    $meta_author_email = '' ?? 'support@defenzelite.com';
    $meta_reply_to = '' ?? getSetting('frontend_footer_email');
    $meta_img = ' ';
@endphp
@endsection

@section('content')
<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="py-5 d-flex align-items-center gap-4">
                    <div class="d-none d-md-block"><img alt="#"
                            src="{{ asset('frontend/assets/img/grocery.png') }}"
                            class="img-fluid ch-100 rounded-pill bg-light p-4"></div>
                    <div class="text-md-start text-center">
                        <h2 class="mb-2 fw-bold">{{ $category->name }}</h2>
                        <p class="lead m-0"><i class="bi bi-shop me-2"></i> {{ $category->services->count() }}
                            Services</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
        
        @foreach ($category->services as $service)
            <div class="col">
                <div class="bg-white listing-card shadow-sm rounded-3 p-3 position-relative">
                    <img src="{{ asset($service->banner) }}"
                        class="img-fluid rounded-3" alt="...">
                    <div class="listing-card-body pt-3">
                        <h6 class="card-title fw-bold mb-1">{{ $service->title }}</h6>
                        <p class="card-text text-muted mb-2">{{ \Str::limit($service->description, 55, '...') }}</p>
                        <p class="card-text text-muted">{{$service->price }}</p>
                    </div>
                    <a href="{{ route('product.details',$service->id) }}" class="stretched-link"></a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-5">
       
    </div>
</div>

<section class="footer py-5 bg-white shadow-sm">
    <div class="container">
        <div class="row">
            <h5 class="mb-4 fw-bold text-dark">Areas we deliver to</h5>
            <div class="col-lg-3 col-md-6 col-6">
                <ul class="list-unstyled d-grid gap-2 mb-0">
                    <li><a href="listing.html" class="text-decoration-none text-muted">Chanakyapuri</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Greater Kailash 2</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Jasola</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Lajpat Nagar</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Mehruli</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Rashtrapati Bhavan</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Sarojini Nagar</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <ul class="list-unstyled d-grid gap-2 mb-0">
                    <li><a href="listing.html" class="text-decoration-none text-muted">Chhatarpur</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Green Park</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">kalkaji</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Ladhi Colony</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Munirka</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Sainik Farm</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">South Ext.</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <ul class="list-unstyled d-grid gap-2 mb-0">
                    <li><a href="listing.html" class="text-decoration-none text-muted">Connaught Place</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Hauz Khas</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Karol Bagh</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Mahipalpur</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">New Friends Colony</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Saket</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Vasant Kunj</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <ul class="list-unstyled d-grid gap-2 mb-0">
                    <li><a href="listing.html" class="text-decoration-none text-muted">Greater Kailash 1</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Khan Market</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Malviya Nagar</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">RK Puram</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Sarai Kala khan</a></li>
                    <li><a href="listing.html" class="text-decoration-none text-muted">Vasant Vihar</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
