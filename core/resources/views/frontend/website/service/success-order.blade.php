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
	@endphp
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center py-4">
    <div class="col-lg-6 mx-auto text-center">
    <h1 class="display-1 mb-4"><img src="{{ asset('frontend/assets/img/order-done.gif') }}" alt="Askbootstrap" class="img-fluid h-200 rounded-pill shadow-sm" /> </h1>
    <h1 class="fw-bold">Osahan, Your order has been successful</h1>
    <p>Check your order status in <a href="profile.html" class="fw-bold text-decoration-none text-success">My Orders</a> about next steps information.</p>
    <div class="text-center mt-5 gap-3">
    <a href="{{route('index') }}" class="btn btn-outline-success btn-lg py-3 px-4 m-2">
    <i class="bi bi-house me-2"></i> Back to Home
    </a>
    <a href="profile.html" class="btn btn-success btn-lg py-3 px-5 m-2">
    <i class="bi bi-box me-2"></i> My Order
    </a>
    </div>
    </div>
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