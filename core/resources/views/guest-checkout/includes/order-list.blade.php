@php
    $payable_price = $cap-\Session::get('discount_amount');   
    if($payable_price > 0){
        $payable_price = $payable_price;
    }else{
        $payable_price = 10;
    }
@endphp
<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="h5 mb-0">Your Cart</span>
    
    <span class="badge text-bg-primary rounded-pill">3</span>
</div>
<ul class="list-group mb-3">
    <li class="d-flex justify-content-between lh-sm p-1">
        <div>
            <h6 class="my-0">{{@$service->title }}</h6>
            <small class="text-muted"></small>

        </div>
    </li>
    <li class="d-flex justify-content-between lh-sm p-3 border-bottom">
        <small class="text-muted">{{@$service->description }}</small>
    </li>
    
    <li class="d-flex justify-content-between lh-sm p-3 border-bottom">
        <div>
            <h6 class="my-0">Price</h6>
            
        </div>
        <span class="text-muted ml-5">₹<span class="totalPrice">{{@$cap}}</span>.00</span>
    </li>
    @if(\Session::has('discount_amount'))
    <li class="d-flex justify-content-between lh-sm p-3 border-bottom" id="discount_applied">
        <div>
            <h6 class="my-0">Discount
                <br>
                <div class="d-flex">
                    <strong class="text-success mr-2 promo_code">{{\Session::get('discount_code')}}</strong>
                    <a id="cancel" class="btn p-0 text-danger fw-800" style="margin-left: 10px; margin-top: -2px;">X</a>
                </div>
            </h6>
            
        </div>
        <span class="text-success fw-800 ml-5">-₹<span class="totalPrice">{{\Session::get('discount_amount')}}
        <span class="discount_amount d-none">{{\Session::get('discount_amount')}}</span>
    </li>
    <li class="d-flex justify-content-between lh-sm p-3 bg-primary">
        <div>
            <h6 class="my-0 text-white">Payable</h6>
            
        </div>
        <span class="text-white fw-700 ml-5">₹ <span class="totalPrice">{{$payable_price}}
    </li>
    @else 
        <form id="promoRedeemForm" action="{{route('guest-checkout.coupon.apply')}}" method="Post"> 
            @csrf
            <div class="input-group">
                <input type="hidden" name="amount" value="{{ $cap }}">
                <input type="hidden" name="code" value="{{ $code }}">
                <input type="text" class="form-control promoCode" name="promoCode" placeholder="Promo code">
                <button type="submit" id="redeem" class="btn btn-success">Apply</button>
            </div>
        </form>    
    @endif
    
</ul>