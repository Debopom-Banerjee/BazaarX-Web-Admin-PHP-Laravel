@php
    if (isset($service)) {
        $service_duration = $order->service->service_duration ?? 7;
        $expected_delivery = now()->addDays($service_duration)->format('Y-m-d');
    }
    $amount  = $service->price-\Session::get('discount_amount');
    $payableAmt = 10;
    if($amount > 0){
        $payableAmt = $amount;
    }
@endphp
<ul class="list-group mb-1 list-unstyled">
    <li class="border-bottom pb-2">
        <img src="{{ (@$service->web_banner) ? asset(@$service->web_banner) : asset('frontend/assets/img/service-card.webp') }}" class="img-fluid"alt="Image">
        <h5 class="mb-0 mt-3">{{@$service->title }}</h5>
        <div class="d-flex justify-content-between">
            <small class="text-muted">Expected Delivery By</small>
            <small class="text-muted">{{ $expected_delivery }}</small>
        </div>
    </li>
    
    <li class="d-flex justify-content-between mt-2">
        <div>
            <h6 class="my-0">Price</h6>
        </div>
        <span class="ml-5">₹<span class="totalPrice">{{@$service->price}}</span></span>
    </li>
    @if(\Session::has('discount_amount'))
    <li class="d-flex justify-content-between" id="discount_applied">
        <h6 class="my-0">Discount</h6>
        <span class="text-success fw-800 ml-5">-₹<span class="totalPrice">{{\Session::get('discount_amount')}}
        <span class="discount_amount d-none">{{\Session::get('discount_amount')}}</span>
    </li>
    <li class="d-flex justify-content-between border-bottom pb-2">
        <strong class="mr-2 promo_code">{{\Session::get('discount_code')}}</strong>
        <a id="cancel" href="javascript:void(0)" class="p-0 text-danger text-decoration-none"><strong>Remove</strong></a>
    </li>
    <li class="d-flex justify-content-between px-2 py-1 rounded mt-1">
        <div>
            <h6 class="my-0">Payable</h6>
        </div>
        <span class="fw-700 ml-5">₹<span class="totalPrice">{{@$payableAmt}}</span>.00</span>
    </li>
    @else 
        <form id="promoRedeemForm" class="mt-3" action="{{route('checkout.coupon.apply')}}" method="Post"> 
            @csrf
            <div class="input-group">
                <input type="hidden" name="service_id" value="{{ @$service->id }}">
                <input type="hidden" name="amount" value="{{ @$service->price }}">
                <input type="text" class="form-control promoCode" name="promoCode" placeholder="Promo code">
                <button type="submit" id="redeem" class="btn btn-success">Apply</button>
            </div>
            <div class="not-valid text-danger fw-600 text-center mt-1 d-none">Code is not valid!</div>
        </form>    
    @endif
    
</ul>