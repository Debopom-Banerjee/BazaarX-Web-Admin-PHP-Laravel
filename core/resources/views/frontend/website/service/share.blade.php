@extends('frontend.layouts.main')

@section('meta_data')
@php
    $meta_title = $service->title.' | '.getSetting('app_name');
    $meta_description = $service->description ?? getSetting('seo_meta_description');
    $meta_keywords = '' ?? getSetting('seo_meta_keywords');
    $meta_motto = '' ?? getSetting('site_motto');
    $meta_abstract = '' ?? getSetting('site_motto');
    $meta_author_name = '' ?? 'Defenzelite';
    $meta_author_email = '' ?? 'support@defenzelite.com';
    $meta_reply_to = '' ?? getSetting('frontend_footer_email');
    $meta_img = (@$service->web_banner) ? asset(@$service->web_banner) : asset('frontend/assets/img/service-card.webp');
@endphp
@endsection
<style>
    .bi::before, [class^="bi-"]::before, [class*=" bi-"]::before {
        font-weight: bold !important;
    }
</style>
@section('content')
<section class="bg-white pt-4">
    <div class="container">
        <div class="row justify-content-center mb-2">
            <div class="col-lg-8 col-md-12 col-sm-12 text-left order-2 order-lg-1">
                <div class="tabs">
                    <h4 class="mt-2 d-none d-lg-block fw-600">
                        {{\Str::limit(@$service->title,100) }}
                    </h4>
                    <div class="mt-4 ml-2">
                        <div class="mb-3">
                            <h6 class="mb-0" style="border-left: 3px solid #1A78BF;padding-left: 4px;">Overview</h6>
                            <div class="p-1">
                                <p class="text-muted ml-2 mb-0">{!! nl2br(@$service->description) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 ml-2">
                        <div class="mb-3">
                            <h6 class="mb-0" style="border-left: 3px solid #1A78BF;padding-left: 4px;">Benefits</h6>
                            <div class="p-1">
                                <p class="text-muted ml-2 mb-0">{!! nl2br(@$service->benefit) !!}</p>
                            </div>
                        </div>
                    </div>
                    @if(@$service->document != null)
                        <div class="mt-2 ml-2">
                            <div class="mb-3">
                                <h6 class="mb-0" style="border-left: 3px solid #1A78BF;padding-left: 4px;">Documents</h6>
                                <div class="p-1">
                                    <ul class="text-muted ml-2 mb-0">
                                        @foreach (explode(',',@$service->document) as $document_item)
                                        <li>
                                                {{@$document_item}}
                                            </li> 
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif    
                    <div class="mt-2 ml-2">
                        <div class="mb-3">
                            <h6 class="mb-0" style="border-left: 3px solid #1A78BF;padding-left: 4px;">Deliverables</h6>
                            <div class="p-1">
                                <p class="text-muted ml-2 mb-0">{!! nl2br(@$service->deliverable) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="recommaended-services row">
                <h5 class="mb-2">Recommended Services</h5>
                @if (isset($related_services))
                    @foreach (@$related_services as $related_service)
                        <div class="col-lg-4 col-sm-6 mb-4">
                            @include('frontend.include.service-card',['service'=>$related_service])
                        </div>
                    @endforeach
                @endif
        </div>
            </div>
            <h4 class="mb-2 d-lg-none d-block">
                {{\Str::limit(@$service->title,100) }}
            </h4>
            <div class="col-lg-4 col-md-12 col-sm-12 order-1 order-lg-2 border serviceShareCard" style="">
                <div class="">
                    <div class="">
                        <img src="{{ (@$service->web_banner) ? asset(@$service->web_banner) : asset('frontend/assets/img/service-card.webp') }}" class="img-fluid service-xl-image p-2 rounded-3 hover01" alt="...">
                    </div>
                    <div class="product-details" style="margin-left: 90px;">
                        <div class="d-flex">
                            <div class="product-price"> 
                                <span class="mr-2 mb-1 fw-800">{{ format_price(@$service->price) }}</span>
                            </div>
    
                            <div class="product-mrp"> 
                                <s>{{ format_price(@$service->mrp) }}</s>
                            </div>
                        </div>
                        <div class="delivery-info">
                            <small class="text-muted fw-400">
                                <i class="bi bi-clock-fill text-muted"></i>
                                Estimated Delivery By:  {{ now()->addDays(@$service->service_duration)->format('d M') }}
                            </small>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mb-0 text-center" style="font-size: 14px; font-weight: 600; color: #008e27;">
                    <span><i class="bi bi-check-circle-fill"></i></span>&nbsp;
                    Woohoo! You saved {{ format_price(@$service->mrp-@$service->price) }} on this order
                </div>
        
                <a href="{{ route('checkout.index',encrypt(@$service->id)) }}" class="btn w-100 btn-success mt-4">Buy Now</a>
        
                
                <small class="category mt-2 d-flex justify-content-center" >
                    <div class="">
                        <i class="bi bi-tags fw-25 mt-1"></i> Category:
                    </div>
                    <a href="{{ route('search.index',['category_id' => @$service->category->id]) }}" class="text-decoration-none text-muted pt-0" style="margin-left: 10px;">
                        {{ (@$service->category->name) }}
                    </a>
                </small>
        
                <hr>
                @if(isset($service) && $service->slug != null)
                    <input type="hidden" id="copyServiceUrl" value="{{ route('service.show',@$service->slug) }}">
                    <div class="pb-1 d-flex mobile-pt-0 mobile-mt-0" style="justify-content: space-evenly;">
                       <a href="https://facebook.com/sharer.php?{{ route('service.show',@$service->slug) }}
                       " target="_blank"><i class="bi bi-facebook share-icon"></i></a>
                       <a href="https://www.linkedin.com/sharing/share-offsite/?{{ route('service.show',@$service->slug) }}" target="_blank"><i class="bi bi-linkedin share-icon"></i></a>
                       <a href="https://twitter.com/intent/tweet?{{ route('service.show',@$service->slug) }}" target="_blank"><i class="bi bi-twitter share-icon"></i></a>
                       <a href="https://wa.me/?text={{ route('service.show', @$service->slug) }}" target="_blank"><i class="bi bi-whatsapp share-icon"></i></a>
                     
                       <a title="Copy Link" href="javascript:void(0);"><i style="font-size: 21px"  class="bi bi-file-earmark-fill share-icon shareBtn" data-clipboard-target="#copyServiceUrl"></i></a>
                    
                    </div>
                @endif
        
                <div class="text-center d-none copied-msg pb-1" style="font-size: 12px; font-weight: 600; color: #008e27;">
                    <i class="bi bi-check2-circle"></i> <small>Share Link Copied to  your clipboard</small>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="" style="background-color: #f0f5f7">
    <div class="container-fluid p-lg-5 p-3 mt-5">
        <div class="d-flex flex-wrap justify-content-around">
            <div class="">
                <h2 class="fw-bolder text-black">Need to speak with BazaarX expert!</h2>
            </div>
            <div class="">
                <a href="{{ route('contact.index') }}" class="btn btn-success btn-lg">Start free consultation now</a>
            </div>
        </div>
    </div>
</section>
@include('frontend.sections.app')
@include('frontend.modal.product-show-modal')
@endsection
