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
<div class="container">
    <div class="row justify-content-center py-4 mt-5">
        <div class="col-lg-6 mx-auto text-center">
            <img src="{{ asset('frontend/assets/img/order-done.gif') }}" alt="Askbootstrap"
                class="img-fluid h-70 rounded-pill shadow-sm" /> 
            <h5 class="mt-2">Thank You!</h5>
            <h6 class="text-dark mb-1 mt-2">{{Session::get('success') ?? 'We have received your request. Our team will contact you shortly.'}}</h6>
           
            
            <hr>
            <div class="text-center mt-3 ">
                For further status tracking, you can save this ref no
                <a href="{{ route('order-tracking') }}" style="font-weight: 700" class="text-decoration-none text-muted ">Click here
                </a>
            </div>

            <a href="{{ url('/') }}" class="btn btn-sm btn-outline-success btn-lg py-2 px-3 m-2 mt-5">
                 Back to Home
            </a>
        </div>
    </div>
</div>
@endsection






