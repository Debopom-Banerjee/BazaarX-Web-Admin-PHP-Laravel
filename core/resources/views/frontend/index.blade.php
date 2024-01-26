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
		$related_services = [];		
	@endphp
@endsection
<style>
    .cardPara{
        font-size: .875rem !important;
      line-height: 1.25rem !important;
    }
    .owl-item{
		/* margin-right: 15px !important; */
    }
    .hover01 figure img {
	-webkit-transform: scale(1);
	transform: scale(1);
	-webkit-transition: .3s ease-in-out;
	transition: .3s ease-in-out;
	}
	.hover01 figure:hover img {
		-webkit-transform: scale(1.3);
		transform: scale(1.3);
	}
</style>
@section('content')
    @include('frontend.sections.hero')
    @include('frontend.sections.slider')
    @include('frontend.sections.category')
    @include('frontend.sections.service')
    @include('frontend.sections.explore')
	@if($news_sliders->count() > 0)
    	@include('frontend.sections.news')
	@endif
	@if($partners_clients_sliders->count() > 0)
    	@include('frontend.sections.client-partner-slider')
	@endif
    @include('frontend.sections.testimonials')
    {{-- @include('frontend.sections.blogs') --}}
    @include('frontend.sections.app')
    
    {{-- show modal --}}
@include('frontend.modal.product-show-modal')   
@endsection