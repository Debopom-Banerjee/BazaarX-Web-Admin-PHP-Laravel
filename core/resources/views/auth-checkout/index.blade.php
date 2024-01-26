@php
    $disableFooter = 1;
@endphp

@extends('frontend.layouts.main')

@section('meta_data')
    @php
        $chk = 1;
		$meta_title = 'Home | '.getSetting('app_name');		
		$meta_description = '' ?? getSetting('seo_meta_description');
		$meta_keywords = '' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');		
		$meta_abstract = '' ?? getSetting('site_motto');		
		$meta_author_name = '' ?? 'Defenzelite';		
		$meta_author_email = '' ?? 'support@defenzelite.com';		
		$meta_reply_to = '' ?? getSetting('frontend_footer_email');		
		$meta_img = ' ';	
        $totalPrice = @$service->price-\Session::get('discount_amount');
	@endphp
@endsection
<style>
    /* Increase the size of the radio button */
    input[type="radio"] {
        /* width: 20px; 
        height: 20px;  */
        margin-left: 10px;
    }

    /* Style the label for the radio button */
    input[type="radio"] + label {
        font-size: 16px; /* Adjust label font size */
        margin-left: 10px; /* Add spacing between the radio button and label */
        vertical-align: middle; /* Vertically align the label with the radio button */
    }
    .paymentLabel{
        font-size: 20px;
        font-weight: 600;
    }
</style>
<style>
    apple-pay-button {
      --apple-pay-button-width: 150px;
      --apple-pay-button-height: 30px;
      --apple-pay-button-border-radius: 3px;
      --apple-pay-button-padding: 0px 0px;
      --apple-pay-button-box-sizing: border-box;
    }
    </style>
@section('content')
<div class="container mt-1">
    <div class="row">
        <div class="col-lg-8 order-2 order-lg-1">
            <div class="bg-white rounded shadow-sm">
                <div class="border-bottom p-3">
                    <h5 class="fw-bold mb-1">Billing Details</h5>
                    <p class="small text-muted mb-0">Fill your billing details</p>
                </div>
                <div class="row p-3">
                    <div class="col-12">
                        <form method="post" action="{{route('guest-checkout.store')}}" id="checkoutForm" >
                            @csrf
                            <input type="hidden" name="amount" class="amount" value="{{@ $service->price }}">
                            <input type="hidden" name="service_id" class="service_id" value="{{@ $service->id }}">
                            <div class="row g-3">
                                <div class="col-12 col-md-6 col-sm-12">
                                    <label for="" class="form-label">First Name<span class="text-danger">*</span></label>
                                    <input name="first_name" required type="text" class="form-control"
                                        id="first_name" placeholder="First Name">
                                </div>
                                <div class="col-12 col-md-6 col-sm-12">
                                    <label for="exampleInputText2" class="form-label">Last Name</label>
                                    <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Last Name">
                                </div>
                                <div class="col-12 col-md-6 col-sm-12">
                                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input required name="email" required type="email" class="form-control" id="email" placeholder="Email">
                                    <span class="invalid-feedback-email d-none text-danger">
                                        Please enter a valid email address.
                                    </span>
                                </div>
                                <div class="col-12 col-md-6 col-sm-12">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input name="phone" type="number" min="0"class="form-control"id="phone" placeholder="Phone">
                                </div>
                                <div class="col-12 col-md-6 col-sm-12">
                                    <label for="exampleInputText5" class="form-label">State<span class="text-danger">*</span ></label>
                                    <select required name="state_id" id="state" class="form-control select2">
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-sm-12">
                                    <label for="pincode" class="form-label">Pin Code</label>
                                    <input name="pincode" type="number"min="0" class="form-control"
                                        id="pincode" placeholder="Pin/Zip Code">
                                </div>
                                <div class="col-12 col-md-12 col-sm-12">
                                    <label for="exampleInputText6" class="form-label">Address<span class="text-danger">*</span ></label>
                                    <textarea name="address" type="text" class="form-control" id="address" 
                                        placeholder="Address.."></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-1 order-lg-2">
            <div class="bg-white rounded shadow-sm mb-3">
                <div class="p-3 border-bottom">
                    <h5 class="fw-bold mb-1">Your Cart</h5>
                </div>
                <div class="p-3" id="cart-list">
                    @include('auth-checkout.cart-list')
                </div>
            </div>
                <div class="border form-group p-2 rounded mb-2">
                    <input type="radio"  id="razor_pay" name="payment" value="razor_pay" class="paymentMethod ">
                    <img class="pay-image" alt="Razor Pay"for="razor_pay"  src="{{asset('images/payment/razorpay.jpg')}}"/>
                </div>
                {{-- <div class="border form-group p-2 rounded mb-3">
                    <input type="radio" id="apple_pay" name="payment" value="apple_pay" class="paymentMethod" checked>
                    <img class="pay-image" style="width: 50px;" for="apple_pay" alt="Apple Pay" src="{{asset('images/payment/apple-pay.jpg')}}"/>
                </div> --}}
                <div class="d-grid my-4">
                    <button disabled class="btn btn-success btn-lg p-2 pay-btn d-none" id="rzp-button1">
                        <div class="text-center">Pay Now</div>
                    </button>
                    {{-- <button disabled class="btn btn-success btn-lg p-2 pay-btn" id="applePayBtn">
                        <div class="text-center">Pay Now</div>
                    </button> --}}
                </div>
                {{-- <button class="btn btn-success btn-lg p-2 " buttonstyle="black" type="buy" locale="el-GR" id="apple-pay-button">
                    <div class="text-center">Pay Now</div>
                </button> --}}
            </div>
            {{-- <button id="apple-pay-button" style="width: 200px; height: 44px;"></button> --}}
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://applepay.cdn.apple.com/jsapi/v1/apple-pay-sdk.js"></script>
{{-- <script src="https://applepay.cdn-apple.com/jsapi/v1.1.0/apple-pay-sdk.js"></script> --}}
<script src="{{ asset('backend/js/apple-pay-sdk.js') }}"></script>
{{-- <script src="{{ asset('/js/stripe.js')}}"></script> --}}
    <script>
        const applePayConfig = {
            countryCode: 'US', // The two-letter country code for your business
            currencyCode: 'USD', // The three-letter currency code for your business
            merchantIdentifier: 'merchant.com.gofinx.ios', // Your Apple Pay merchant identifier
            supportedNetworks: ['amex', 'visa', 'masterCard'], // Supported payment card networks
            merchantCapabilities: ['3DS', 'debit', 'credit'], // Merchant capabilities

            total: {
                label: 'Total Amount', // A label for the total amount
                amount: '19.99', // The total amount in the specified currency
            },

            lineItems: [
                {
                    label: 'Item 1', // Label for the first line item
                    amount: '9.99', // Amount for the first line item
                },
                {
                    label: 'Item 2', // Label for the second line item
                    amount: '5.00', // Amount for the second line item
                },
            ],

            shippingMethods: [
                {
                    identifier: 'standard_shipping',
                    label: 'Standard Shipping',
                    detail: '5-7 business days',
                    amount: '0.00',
                },
                {
                    identifier: 'express_shipping',
                    label: 'Express Shipping',
                    detail: '2-3 business days',
                    amount: '9.99',
                },
            ],

            requiredBillingContactFields: ['email', 'postalAddress'],
            requiredShippingContactFields: ['name', 'email', 'phone', 'postalAddress'],
            };

        console.log(window.ApplePaySession)
        // Check if Apple Pay is available in the user's browser
        if (window.ApplePaySession) {
            // Determine if the current device supports Apple Pay
            if (window.ApplePaySession.canMakePayments()) {
                // Create an Apple Pay session
                const session = new ApplePaySession(1, applePayConfig);

                // Set up event handlers for the Apple Pay session
                session.onvalidatemerchant = (event) => {
                    // Perform merchant validation here (contact Apple Pay server)
                    const merchantValidationURL = 'merchant.com.gofinx.ios';
                    event.validationURL = merchantValidationURL;
                };

                session.onpaymentauthorized = (event) => {
                    // Handle payment authorization here
                    const payment = event.payment;
                    // Process the payment and complete the session
                    session.completePayment(ApplePaySession.STATUS_SUCCESS);
                };

                session.oncancel = (event) => {
                    // Handle cancellation
                };

                // Begin the Apple Pay session
                session.begin();
            } else {
                // Apple Pay is not supported on this device
            }
        } else {
            // Apple Pay is not available in this browser
        }
    </script>

<script>
    $(document).ready(function(){
        let val = {{$totalPrice}};  
        if(val === 0){
            $('.checkoutBtn').removeClass('d-none');
        }
        $('.paymentMethod').change(function() {
            let val = $(this).val();
            if (val == 'razor_pay') {
                $('#rzp-button1').removeClass('d-none');
                $('#applePayBtn').addClass('d-none');
            } else {
                $('#rzp-button1').addClass('d-none');
                $('#applePayBtn').removeClass('d-none');
            }
        });

        function getStates(countryId =  101) {
            $.ajax({
            url: '{{ route("world.get-states") }}',
            method: 'GET',
            data: {
                country_id: countryId
            },
            success: function(res){
                $('#state').html(res).css('width','100%');
            }
            })
        }
        getStates(101);
    });
    function isValidEmail(email) {
        if(email.length > 0){
            // Regular expression for email validation
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            // Test the input value against the regular expression
            return emailRegex.test(email);
        }
        return true;
    }
    function chkValidity() {
        var firstName = $('#first_name').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var state =  $("#state").val();
        var isValid = isValidEmail(email);
        if(isValid){
            $('.invalid-feedback-email').addClass('d-none');
            if(firstName != '' && address != '' && state != null){
                $('.pay-btn').prop('disabled', false);
            }else{
                $('.pay-btn').prop('disabled', true);
            }
        }else{
            $('.invalid-feedback-email').removeClass('d-none');
        }
    }
    $('#checkoutForm').on('input change', ':input', function() {
        chkValidity();
    });
    document.getElementById('rzp-button1').onclick = function(e) {
        chkValidity();
        $('#checkoutForm').submit();
    }

    $('#redeem').on('click', function(e){
        setTimeout(function() {
            $('#cancel').removeClass('d-none');
        }, 1000);
        $('.showPromoCode').removeClass('d-none');
    })
    $(document).on('click','#cancel', function(e){
        var service_id = $('.service_id').val();
        var code = $('.promo_code').html();
        var price = $('.amount').val();
        var discount = $('.discount_amount').text();
        
        $.ajax({
            url: "{{route('checkout.coupon.remove')}}",
            data: {
                service_id: service_id,
                promoCode: code,
                amount: price,
                discount: discount,
            },
            type : 'GET',
            dataType : 'json',
            success : function(res){
                $('#cart-list').html(res.html);
                checkoutprice = res.amount;
                console.log(res.amount);
                $.toast({
                    heading: res.status,
                    text: res.message,
                    showHideTransition: 'slide',
                    icon: 'success',
                    loaderBg: '#f96868',
                    position: 'top-right'
                });

            }
        });
    })

    $(document).on('submit','#promoRedeemForm',function(e){
        e.preventDefault();
        let action = $(this).attr('action');
        let method = $(this).attr('method');
        $.ajax({
            url : action,
            data : $(this).serialize(),
            type : method,
            dataType : 'json',
            success : function(res){
                if (res.status == 'error') {
                    $('.not-valid').removeClass('d-none');
                }else{
                    $('#cart-list').html(res.html);
                    checkoutprice = res.amount;
                    $.toast({
                        heading: res.message,
                        text: "The promo code you are attempting to use has already been utilized the maximum number of times allowed",
                        showHideTransition: 'slide',
                        icon: res.status,
                        loaderBg: '#f96868',
                        position: 'top-right'
                    });
                }
            }
        });
    });
    setTimeout(() => {
        $('.not-valid').addClass('d-none');
    }, 5000);

</script>
@endpush