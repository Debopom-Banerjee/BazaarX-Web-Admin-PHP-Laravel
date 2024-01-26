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
    <div class="row justify-content-center py-5">
        <div class="col-lg-6 text-center">
            @if(request()->get('order_id') && $order != null)
                <h1 class="text-center">
                    <i class="bi bi-box text-muted"></i>
                </h1>
                <h5 class="mb-2 text-center">Order Details</h5>
                <div class="tracking-results text-center">
                    <p class="mb-0 ">Order Id: #OD{{  getPrefixZeros($order->id) }}</p>
                    <p class="mb-0 ">Status: 
                        <span class="text-{{ orderStatus($order->status)['color'] }}">
                            {{orderStatus($order->status)['name'] }}
                        </span>
                    </p>
                    <p class="">Order Placed Date: {{\Carbon\Carbon::parse($order->created_at)->format('M d,Y')}}</p>
                </div>
            @else
                <h1>
                    <i class="bi bi-geo-alt text-muted"></i>
                </h1>
                <h5 class="mb-0">Order Tracking</h5>
                <p class="mb-0"> 
                    Enter your Order Id to tract your Order.
                </p>
                <form action="" method="get" class="mt-3">
                    <div class="tracking-input form-group d-flex justify-content-center">
                        <div class="input-group w-50">
                            <div class="input-group-prepend">
                            <span class="input-group-text text-muted" id="basic-addon1">#OD</span>
                            </div>
                            <input type="text" name="order_id" value="{{ request()->get('order_id') }}" class="form-control w-50" placeholder="Ex:00176" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    @if(request()->get('order_id') && !$order)
                        <div class="text-danger fw-600 mt-1">This order ID doesn't have any orders</div>
                    @endif
                    <button class="btn btn-secondary btn-sm w-50 mt-2" type="submit">Track</button>
                </form>
            @endif
            <hr>

            <a href="{{ url('/') }}"class="btn btn-sm btn-outline-success btn-lg py-2 px-3 m-2 mt-4">
                 Back to Home
            </a>
        </div>
    </div>
</div>
@endsection






