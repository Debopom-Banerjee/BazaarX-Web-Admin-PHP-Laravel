@extends('frontend.layouts.main')

@section('meta_data')
@php
    $meta_title = 'Career | '.getSetting('app_name');
    $meta_description = 'Join the BazaarX team and embark on an exciting career in the world of finance, technology, and entrepreneurship. We offer diverse opportunities in Taxation, Financial Advisory, Marketing, Legal Services, Software Development, and more. Be a part of our innovative AI-powered platform and contribute to empowering businesses and individuals with top-notch financial solutions.' ?? getSetting('seo_meta_description');
    $meta_keywords = ' finance jobs, technology careers, entrepreneurship opportunities, taxation, financial advisory, marketing, ' ?? getSetting('seo_meta_keywords');
    $meta_motto = '' ?? getSetting('site_motto');
    $meta_abstract = '' ?? getSetting('site_motto');
    $meta_author_name = '' ?? 'Defenzelite';
    $meta_author_email = '' ?? 'support@defenzelite.com';
    $meta_reply_to = '' ?? getSetting('frontend_footer_email');
    $meta_img = ' ';
@endphp
@endsection
<style>
	.slider-heading-title{
		letter-spacing: 0.085rem;
    	font-size: 19px;
	}
</style>
@section('content')
<section class="pt-5 contact-img">
    <div class="container py-5 px-5">
        <div class="row gx-5">
            <div class="col-lg-12">
                <h1 class="display-6 mb-2 w-50">Jobs</h1>
                <p class="lead m-0">Have questions? We're here to help!</p>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid px-5 mobile-px-0">
    <div class="col-lg-10 py-5 mx-auto">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4">
            @foreach ($sliders as $slider)
				<div class="col">
					<div class="bg-white d-flex position-relative gap-3 rounded-3 shadow-sm overflow-hidden">
						<div class="w-100">
							<div class="p-4 ">
								<div class="mb-2 text-black d-flex align-items-center">
									<h6 class="m-0 fw-bold text-success slider-heading-title">{{ $slider->title }}</h6> 
								</div>
								<div class="fs-15 mb-0 d-flex small align-items-center text-muted">{{ \Str::words($slider->description,70) }}</div>
							</div>
							<div class="border-top d-flex align-items-center w-100 ">
								<small class="me-auto px-4 d-none d-lg-block">
									<i class="bi bi-telephone me-1"></i> {{ getSetting('frontend_footer_phone') }}
								</small>
								<small class="me-auto d-none d-lg-block">
									<i class="bi bi-envelope me-1"></i> {{ getSetting('admin_email') }}
								</small>
								<div class="d-flex flex-wrap d-lg-none d-block">
									<p class="mx-auto px-2 m-0 mt-2">
										<i class="bi bi-telephone me-1"></i> {{ getSetting('frontend_footer_phone') }}
									</p>
									<p class="mx-auto m-0 mb-2">
										<i class="bi bi-envelope me-1"></i> {{ getSetting('admin_email') }}
									</p>
								</div>
									<a href="mailto:{{ getSetting('admin_email') }}"
									class="btn btn-warning shadow-sm rounded-0 px-4 py-2 mobile-px-4"><span>APPLY NOW</span></a>
							</div>
							
						</div>
					</div>
				</div>
			@endforeach
        </div>
    </div>
</div>

@endsection
