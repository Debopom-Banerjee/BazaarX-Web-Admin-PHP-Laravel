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
        	
	@endphp
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<style>
.card-header {
    border-bottom: none
}
#form {
	text-align: center;
	position: relative;
	margin-top: 20px
}

.text {
	color: #2F8D46;
	font-weight: normal
}

#progressbar {
	/* margin-bottom: 30px; */
	overflow: hidden;
	color: lightgrey;
    padding:0
}

#progressbar .active {
	color: #2f55d4
}

#progressbar li {
	list-style-type: none;
	font-size: 12px;
	width: 40%;
	float: left;
	position: relative;
	
    cursor: pointer;
}

#progressbar #step1:before {
  content: "1";
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  font-size: 10px;
  line-height: 1.6;
  margin-left: 12px;
  margin-bottom: -18px;
}


#progressbar #step2:before {
	content: "2";
	font-size: 10px;
	line-height: 1.6;
    margin-left: 25px;
    margin-bottom: -18px;
}

#progressbar li:before {
	width: 20px;
	height: 20px;
	line-height: 45px;
	display: block;
	font-size: 20px;
	color: #ffffff;
	background: lightgray;
	border-radius: 50%;
	margin: 0 auto 10px auto;
	padding: 2px
}

#progressbar #step1:after {
	content: '';
    margin-left: 116px;
	width: 72%;
	height: 3px;
	background: lightgray;
	position: absolute;
	left: 0;
	top: 10px;
	z-index: -1;
    background: #2f55d4;
}

#progressbar li.active:before,
#progressbar li.active:after {
	background: #2f55d4
}

.progress {
	height: 20px
}

.progress-bar {
	background-color: #2f55d4
}
@media (max-width: 731px) {
  .mobile-d-block {
    display: block !important;
  }
   #progressbar li {
        width: 35% !important;
    }
}
</style>
    <div class="container">
        <div class="row parentForm mb-4" data-id="1" style="margin-top: 50px !important;">
            <div class="justify-content-center">
                <div class="d-flex justify-content-between mobile-d-block mb-1">
                    <div class="col-lg-7 col-md-6 col-12">
                        <i class="fa fa-lock" style="color: #1e8638"></i>
                        <strong class="fw-800" style="font-size: 20px;margin-left: 3px;">
                            Secure Checkout
                        </strong> 
                        <small class="text-dark fw-700">Power by GoFinix</small>
                    </div>
                   
                     <div class="col-lg-4 col-md-6 col-12 ml-3 mt-2">
                         <div class="px-0  pb-0  mb-3">
                             <form id="form" class="m-0">
                                 <ul id="progressbar">
                                    <li class="active" id="step1" data-li="<i class='fa fa-check'></i>">
                                        <div>Shipping Cart</div>
                                    </li>
                                    <li id="step2" data-li="2" style="margin-left: 45px;"><div>Checkout</div></li> 
                                 </ul>
                             </form>
                         </div>
                     </div>
                </div>
            </div>
            <div class="col-md-7 col-lg-8 order-2 order-lg-1">
                <form method="post" action="{{route('guest-checkout.store')}}" id="checkoutForm" >
                    @csrf
                    <input type="hidden" name="promo_code" value="" class="code">
                    <input type="hidden" name="discount" value="" class="discountAmt">
                    <input type="hidden" name="affiliate_id" value="{{ $affiliate_id }}">
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <input type="hidden" name="amount" class="amount" value="{{ $cap }}">
                    <input type="hidden" name="code" class="code" value="{{ $code }}">
                    <div class="card rounded shadow border-0 address-card">
                        <div class="card-header">
                            <h5 class="mb-0">Billing Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">First name<span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First Name" value="" required="">
                                    <div class="invalid-feedback-firstname d-none">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
                                    <span class="invalid-feedback-email d-none text-danger">
                                        Please enter a valid email address.
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                                    <input type="number" name="phone" class="form-control" id="phone" placeholder="Enter Number" required="">
                                    <div class="invalid-feedback">
                                        Please enter your phone number.
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <input type="hidden" name="state_name" id="stateName">
                                    <label for="state" class="form-label">State<span class="text-danger">*</span></label>
                                    <select name="state_id" class="form-select form-control" id="state" required="">
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" required="">
                                    <div class="invalid-feedback">
                                        Please enter your shipping address.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded shadow border-0 payment-card d-none">
                        <div class="card-header">
                            <h5 class="mb-0">Confirm Details</h5>
                        </div>
                        <div class="card-body" style="min-height: 300px">
                            <div class="row alert alert-light mb-2">
                                <span class="text-muted">
                                    Contact Details: 
                                </span>
                                
                                <span class="text-dark" id="showName"></span>
                                <span class="text-dark" id="showEmail"></span>
                                <span class="text-dark" id="showPhone"></span>
                                <span class="text-dark" id="showAddress"></span>
                                <span class="text-dark" id="showState"></span>
                            </div>

                            
                            <hr>
                            <p class="text-muted fw-400 mb-4">
                                <h6 class="fw-700 mb-0">
                                    Terms and Conditions
                                </h6>
                            <p class="text-muted" style="font-size: 14px">After placing an order, you will receive an email confirmation with details of your purchase. This email serves as an acknowledgment of your order. We strive to ensure that all products listed on our website are available for purchase.</p> 
                            </p>

                        </div>
                        <div class="card-footer">
                            
                            <button type="button" class="btn btn-link text-secondary mx-auto d-block previous-step d-none" id="" ><i class="fa fa-arrow-left"></i> Change Details</button>
                           
                        </div>
                    </div>
                </form>
            </div><!--end col-->
            <div class="col-md-5 col-lg-4 order-1 order-lg-2">
                <div class="card rounded shadow p-4 border-0" id="order-list" style="background-color: #f7f7f7;">
                    @include('checkout.includes.order-list')
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary w-100 d-block m-1 next-step" disabled>Save & Proceed to Pay</button>
                    
                    <button class="w-100 btn btn-success d-none" id="rzp-button1" type="submit">Processed to payment</button>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
@endsection

@push('script')

<script>
    var checkoutprice = "{{(int)$cap*100}}"
    function chkValidity() {
        var firstName = $('#firstName').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var state =  $("#state").val();
        var isValid = isValidEmail(email);
        if(isValid){
            $('.invalid-feedback-email').addClass('d-none');
            if(firstName != '' && address != '' && phone != '' && state != null){
                $('.next-step').prop('disabled', false);
            }else{
                $('.next-step').prop('disabled', true);
            }
        }else{
            $('.invalid-feedback-email').removeClass('d-none');
        }
    }
    function getdata(){
        var firstName = $('#firstName').val();
        var address = $('#address').val();
        var promocode = $('#promoCode').val();
    }
    $('#checkoutForm').on('input change', ':input', function() {
        chkValidity();
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
    // \f00c
    $(document).ready(function(){
        $(".next-step").on('click',function () {
            // Usage example
                $('#rzp-button1').removeClass('d-none');
                $('.address-card').addClass('d-none');
                $('.payment-card').removeClass('d-none');
                $('#step2').addClass('active');
                $(this).addClass('d-none');
                $('.previous-step').removeClass('d-none');
                $('.invalid-feedback-email').addClass('d-none');

                //Add Payment tab values
                var firstName = $('#firstName').val();
                var email = $('#email').val();
                var address = $('#address').val();
                var phone = $('#phone').val();
                var state = $('#state').val();
                var stateName = $('#stateName').val();
                $('#showName').html(firstName);
                $('#showEmail').html(email);
                $('#showPhone').html(phone);
                $('#showAddress').html(address);
                $('#showState').html(stateName);
        });
        $(".previous-step").click(function () {
            $("#rzp-button1").removeClass('d-none');
            $(".next-step").removeClass('d-none');
            $('.address-card').removeClass('d-none');
            $('.payment-card').addClass('d-none');
            $('#step2').removeClass('active');
            $('#step1').addClass('active');
            $('.previous-step').addClass('d-none');
        });
    });
    
    document.getElementById('rzp-button1').onclick = function(e) {
        chkValidity();
        $('#checkoutForm').submit();
    }

    $(document).ready(function(){
        $('.select2').select2();
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

        function getCities(stateId =  101) {
            
            $.ajax({
                url: '{{ route("world.get-cities") }}',
                method: 'GET',
                data: {
                    state_id: stateId
                },
                success: function(res){
                    $('#city').html(res).css('width','100%');
                }
            })
        }
        
        getStates(101);
        $('#state').on('change', function(e){
            getCities($(this).val());
            $('#stateName').val( $(this).find("option:selected").text());
           
        })

        $('#city').on('change', function(e){
            $('#cityName').val( $(this).find("option:selected").text());
           
        })
        $('#redeem').on('click', function(e){
            setTimeout(function() {
                $('#cancel').removeClass('d-none');
            }, 1000);
            $('.showPromoCode').removeClass('d-none');
        })

        $(document).on('click','#cancel', function(e){
            var code = $('.promo_code').html();
            var price = $('.amount').val();
            var discount = $('.discount_amount').text();
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('guest-checkout.coupon.remove')}}",
                
                data: {
                    promoCode: code,
                    amount: price,
                    discount: discount,
                    code: "{{$code}}"
                    
                },
                type : 'POST',
                dataType : 'json',
                success : function(res){
                    $('#order-list').html(res.html);
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
                    $('#order-list').html(res.html);
                    checkoutprice = res.amount;
                    console.log(res.amount);
                    $.toast({
                        heading: res.message,
                        text: "The promo code you are attempting to use has already been utilized the maximum number of times allowed",
                        showHideTransition: 'slide',
                        icon: res.status,
                        loaderBg: '#f96868',
                        position: 'top-right'
                    });

                }
            });
         })
        
    });
        
</script>
@endpush