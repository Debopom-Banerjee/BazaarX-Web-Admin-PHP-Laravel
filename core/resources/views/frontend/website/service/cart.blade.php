@php
    $disableFooter = 1;
@endphp
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

<div class="container my-5">
    <div class="row">
    <div class="col-lg-8">
    <div class="accordion accordion-payment accordion-flush ps-4 ms-4" id="accordionFlushExample">
    <div class="accordion-item accordion-item-line1 bg-white shadow-sm rounded border-0 position-relative mb-3">
    <h2 class="accordion-header" id="flush-headingOne">
    <button class="accordion-button rounded-3 p-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
    <span>
    <h5 class="fw-bold mb-2">Sign in to place your order</h5>
    <p class="small text-muted mb-0">Sign in to proceed</p>
    </span>
    </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
    <div class="accordion-body px-4 pb-4 pt-0">
    <div class="input-group bg-white border rounded p-1">
    <span class="input-group-text bg-white border-0"><i class="bi bi-phone pe-2"></i> +91 </span>
    <input type="number" class="form-control bg-white border-0 ps-0" placeholder="Enter phone number" aria-label="Username" aria-describedby="basic-addon1">
    <button class="btn btn-success rounded py-2 px-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">NEXT</button>
    </div>
    </div>
    </div>
    </div>
    <div class="accordion-item accordion-item-line2 bg-white shadow-sm rounded border-0 position-relative mb-3">
    <h2 class="accordion-header" id="flush-headingTwo">
    <button class="accordion-button rounded-3 collapsed p-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
    <span>
    <h5 class="fw-bold mb-2">Delivery Address</h5>
    <p class="small text-muted mb-0">Select a saved delivery address or add a new address</p>
    </span>
    </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
    <div class="accordion-body px-4 pb-4 pt-0">
    <div class="btn-group gap-3 osahan-btn-group d-flex" role="group" aria-label="Basic radio toggle button group">
    <input type="radio" class="btn-check" name="btnradiod" id="btnradio1" autocomplete="off">
    <label data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" class="btn btn-outline-light d-flex align-items-center gap-3 rounded p-3 col-6" for="btnradio1">
    <i class="bi bi-house h5 mb-0"></i>
    <span class="text-start">
    <h6 class="mb-1 fw-bold">Home</h6>
    <div class="text-muted small text-opacity-50">925 S Chugach St #APT 10, Palmer, Alaska 99645, USA</div>
    </span>
    <i class="bi bi-check-circle-fill ms-auto"></i>
    </label>
    <input type="radio" class="btn-check" name="btnradiod" id="btnradio2" autocomplete="off">
    <label data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" class="btn btn-outline-light d-flex align-items-center gap-3 rounded p-3 col-6" for="btnradio2">
    <i class="bi bi-building h5 mb-0"></i>
    <span class="text-start">
    <h6 class="mb-1 fw-bold">Work</h6>
    <div class="text-muted small text-opacity-50">Pune, 2336 Jack Warren Rd, Delta Junction, Alaska, USA</div>
    </span>
    <i class="bi bi-check-circle-fill ms-auto"></i>
    </label>
    </div>
    <div class="btn-group gap-3 osahan-btn-group d-flex my-3" role="group" aria-label="Basic radio toggle button group">
    <input type="radio" class="btn-check" name="btnradiod" id="btnradio13" autocomplete="off">
    <label data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" class="btn btn-outline-light d-flex align-items-center gap-3 rounded p-3 col-6" for="btnradio13">
    <i class="bi bi-geo-alt h5 mb-0"></i>
    <span class="text-start">
    <h6 class="mb-1 fw-bold">Other</h6>
    <div class="text-muted small text-opacity-50">Kalyani Yukon Rd, Kasilof, Alaska 99610, Maharashtra</div>
    </span>
    <i class="bi bi-check-circle-fill ms-auto"></i>
    </label>
    <input type="radio" class="btn-check" name="btnradiod" id="btnradio23" autocomplete="off">
    <label data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" class="btn btn-outline-light d-flex align-items-center gap-3 rounded p-3 col-6" for="btnradio23">
    <i class="bi bi-geo-alt h5 mb-0"></i>
    <span class="text-start">
    <h6 class="mb-1 fw-bold">Other</h6>
    <div class="text-muted small text-opacity-50">Maharashtra Lanark Dr, Wasilla, Alaska 99654</div>
    </span>
    <i class="bi bi-check-circle-fill ms-auto"></i>
    </label>
    </div>
    <button type="button" class="btn btn-outline-success btn-lg py-3 px-4 w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    <i class="bi bi-pin-map me-2"></i> Add New Address
    </button>
    </div>
    </div>
    </div>
    <div class="accordion-item bg-white shadow-sm rounded border-0 position-relative mb-3">
    <h2 class="accordion-header" id="flush-headingThree">
    <button class="accordion-button rounded-3 collapsed p-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
    <span>
    <h5 class="fw-bold mb-2">Select payment method</h5>
    <p class="small text-muted mb-0">Select a payment method from the existing one or create one</p>
    </span>
    </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
    <div class="accordion-body border-top p-0">
    <div class="row m-0">
    <div class="col-md-4 p-4 ps-md-4 py-md-4 pe-md-0 bg-light">
    <div class="nav flex-column delivery-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link active py-3" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Offers for you</button>
    <button class="nav-link py-3" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Wallets</button>
    <button class="nav-link py-3" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Credit and debit cards</button>
    <button class="nav-link py-3" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">UPI</button>
    </div>
    </div>
    <div class="col-md-8 p-4">
    <div class="tab-content" id="v-pills-tabContent">
    
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <div class="border rounded p-4 d-flex align-items-center gap-4 bg-white mb-3">
    <i class="icofont-3x icofont-apple-pay-alt"></i>
    <div class="d-flex flex-column">
    <h5 class="card-title h6 fw-bold mb-2">Apple Pay</h5>
    <p class="card-text text-muted">Apple Pay lets you order now &amp; pay later at no extra cost.</p>
    <a class="text-decoration-none fw-bold text-success" href="#">LINK ACCOUNT <i class="icofont-link-alt"></i></a>
    </div>
    </div>
    <div class="border rounded p-4 d-flex align-items-center gap-4 bg-white mb-3">
    <i class="icofont-3x icofont-paypal-alt"></i>
    <div class="d-flex flex-column">
    <h5 class="card-title h6 fw-bold mb-2">Paypal</h5>
    <p class="card-text text-muted">Paypal lets you order now &amp; pay later at no extra cost.</p>
    <a class="text-decoration-none fw-bold text-success" href="#">LINK ACCOUNT <i class="icofont-link-alt"></i></a>
    </div>
    </div>
    <div class="border rounded p-4 d-flex align-items-center gap-4 bg-white mb-3">
    <i class="icofont-3x icofont-diners-club"></i>
    <div class="d-flex flex-column">
    <h5 class="card-title h6 fw-bold mb-2">Diners Club</h5>
    <p class="card-text text-muted">Diners Club lets you order now &amp; pay later at no extra cost.</p>
    <a class="text-decoration-none fw-bold text-success" href="#">LINK ACCOUNT <i class="icofont-link-alt"></i></a>
    </div>
    </div>
    </div>
    
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <div class="border rounded mb-3">
    <div class="d-flex align-items-center gap-3 border-bottom p-3">
    <img src="assets/img/payment2.png" alt class="img-fluid rounded-circle bg-light h-40">
    <h6 class="fw-bold mb-0">Simpl</h6>
    </div>
    <div class="p-3">
    <p class="text-primary small mb-1">Get 40% cashbck, No min order value</p>
    <p class="text-muted">Your Simpl account is not linked. Please Link your Account.</p>
    <button type="button" class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#staticBackdroppay1">
    Link Account
    </button>
    </div>
    </div>
    <div class="border rounded">
    <div class="d-flex align-items-center gap-3 border-bottom p-3">
    <img src="assets/img/payment3.png" alt class="img-fluid rounded-circle bg-light h-40">
    <h6 class="fw-bold mb-0">Paytm</h6>
    </div>
    <div class="p-3">
    <p class="text-danger small mb-1">Get 40% cashbck, No min order value</p>
    <p class="text-muted">Your Paytm account is not linked. Please Link yourAccount.</p>
    <button type="button" class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#staticBackdroppay1">
    Link Account
    </button>
    </div>
    </div>
    </div>
    
    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
    <div class="border rounded-3 p-3">
    <div class="row">
    <div class="col-12">
    <h6 class="mb-0">Enter your card details</h6>
    <form class="mt-4">
    <div class="mb-3">
    <label for="exampleInputText1" class="form-label">Card Number</label>
    <input type="text" class="form-control" id="exampleInputText1" aria-describedby="emailHelp" placeholder="*** *** *** 1234">
    </div>
    <div class="row g-3 mb-3">
    <div class="col">
    <label for="exampleInputMMYY1" class="form-label">Expiry Date</label>
    <div class="d-flex align-items-center gap-2">
    <input type="text" class="form-control" id="exampleInputMMYY1" placeholder="MM" aria-label="First name">
    <span>/</span>
    <input type="number" class="form-control" placeholder="YY" aria-label="First name" id="exampleInputMMYY1">
    </div>
    </div>
    <div class="col">
    <label for="exampleInputCVV1" class="form-label">CVV</label>
    <input type="text" class="form-control" id="exampleInputCVV1" placeholder="e.g. 123" aria-label="Last name">
    </div>
    </div>
    <div class="mb-3">
    <label for="exampleInputName1" class="form-label">Name on Card</label>
    <input type="text" class="form-control" id="exampleInputName1" aria-describedby="emailHelp" placeholder="e.g. Rahul Mishra">
    <small class="text-muted">Full name as displayed on card</small>
    </div>
    <div class="d-grid">
    <button type="button" class="btn btn-success btn-lg py-3 px-4">
    <div class="d-flex justify-content-between">
    <div>Pay</div>
    <div class="fw-bold">₹750</div>
    </div>
    </button>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    
    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
    <div class="border rounded mb-3">
    <div class="d-flex align-items-center gap-3 border-bottom p-3">
    <img src="assets/img/payment1.png" alt class="img-fluid rounded-circle bg-light h-40">
    <h6 class="fw-bold mb-0">Add New UPI ID</h6>
    </div>
    <div class="p-3">
    <div class="input-group">
    <input type="text" class="form-control" placeholder="E.g rahul@icici">
    <button class="btn btn-secondary" type="button">Verify & Pay</button>
    </div>
    </div>
    </div>
    <div class="border rounded d-flex align-items-center gap-3 p-3">
    <img src="assets/img/payment2.png" alt class="img-fluid rounded-circle bg-light h-40">
    <span class="text-start">
    <p class="mb-0 fs-14"><a href="https://askbootstrap.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="95e7f4fde0f9d5fcf6fcf6fc">[email&#160;protected]</a></p>
    </span>
    <a class="btn btn-sm btn-success ms-auto my-auto" href="#">Pay ₹750</a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div role="alert" class="p-0 alert alert-success alert-dismissible fade show bg-white rounded shadow-sm overflow-hidden mb-3 ms-lg-5">
    <div class="border-bottom p-4">
    <h5 class="fw-bold mb-1">Amazing deals for you</h5>
    <p class="text-muted small mb-0">You're eligible for some samples</p>
    </div>
    <div class="product-list bg-white d-flex p-4">
    <img src="{{ asset('frontend/assets/img/p16.jpg') }}" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Kinder Creamy Milky And Crunchy 1 Pc</p>
    <p class="card-text small mb-3">Delicious chocklate filled with puffed rice cereals in a slightly.</p>
    <h6 class="mb-0"><del>₹135</del> <span class="text-success fw-bold mb-2">FREE</span></h6>
    </div>
    <div class="ms-auto mb-auto">
    <button data-bs-dismiss="alert" aria-label="Close" type="button" class="btn btn-white border rounded-pill text-success">Remove</button>
    </div>
    </div>
    </div>
    <div class="bg-white rounded shadow-sm overflow-hidden ms-lg-5">
    <div class="px-4 pt-4">
    <h5 class="fw-bold mb-1">Recommended for you</h5>
    <p class="text-muted small mb-0">We think you'll these items based on your cart</p>
    </div>
    <div class="p-4">
    <div class="row">
    <div class="col">
    <div class="card h-100 overflow-hidden shadow-sm border-0">
    <img src="{{ asset('frontend/assets/img/list7.jpg') }}" class="card-img-top of-cover " alt="...">
    <div class="card-body px-3 pb-3 pt-3">
    <p class="card-title">Lizol Citrus Surface Cleaner</p>
    <p class="card-text text-muted small">500 ML</p>
    </div>
    <div class="px-3 pt-0 pb-3 card-footer bg-white border-0 d-flex align-items-center justify-content-between">
    <div class="fw-bold">₹115</div>
    <button type="button" class="btn btn-outline-success px-3 btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;Add</button>
    </div>
    </div>
    </div>
    <div class="col">
    <div class="card h-100 overflow-hidden shadow-sm border-0">
    <img src="assets/img/list2.jpg" class="card-img-top of-cover" alt="...">
    <div class="card-body px-3 pb-3 pt-3">
    <p class="card-title">Harpic Surface Cleaner</p>
    <p class="card-text text-muted small">500 ML</p>
    </div>
    <div class="px-3 pt-0 pb-3 card-footer bg-white border-0 d-flex align-items-center justify-content-between">
    <div class="fw-bold">₹89</div>
    <button type="button" class="btn btn-outline-success px-3 btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;Add</button>
    </div>
    </div>
    </div>
    <div class="col d-none d-md-block">
    <div class="card h-100 overflow-hidden shadow-sm border-0">
    <img src="assets/img/list3.jpg" class="card-img-top of-cover" alt="...">
    <div class="card-body px-3 pb-3 pt-3">
    <p class="card-title">Lay's Magic Masala CHips &amp; Coca Cola</p>
    <p class="card-text text-muted small">2 ITEMS</p>
    </div>
    <div class="px-3 pt-0 pb-3 card-footer bg-white border-0 d-flex align-items-center justify-content-between">
    <div class="fw-bold">₹52</div>
    <button type="button" class="btn btn-outline-success px-3 btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;Add</button>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-4">
    <div class="fixed-sidebar">
    <div class="bg-white cart-box shadow-sm rounded position-relative mb-3">
    <div class="p-3 border-bottom">
    <h5 class="mb-0 fw-bold">Your Cart</h5>
    <p class="small mb-0">4 items from <span class="text-success">Grand Fresh Supermart</span></p>
    </div>
    <div class="py-2">
    <div class="cart-box-item d-flex align-items-center py-2 px-3">
    <div class="success-dot"></div>
    <div class="cart-box-item-title px-2">
    <p class="mb-0">Coke &amp; lays Combo</p>
    <p class="small text-muted mb-0">1 pack</p>
    </div>
    <div class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto">
    <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="1">
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    <div class="cart-box-item-price">
    <div class="text-end">₹87</div>
    </div>
    </div>
    <div class="cart-box-item d-flex align-items-center py-2 px-3">
    <div class="success-dot"></div>
    <div class="cart-box-item-title px-2">
    <p class="mb-0">Coca-Cola Soft Drink Can</p>
    <p class="small text-muted mb-0">300 ML</p>
    </div>
    <div class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto">
    <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="2">
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    <div class="cart-box-item-price">
    <div class="text-end">₹40</div>
    </div>
    </div>
    <div class="cart-box-item d-flex align-items-center py-2 px-3">
    <div class="success-dot"></div>
    <div class="cart-box-item-title px-2">
    <p class="mb-0">Coca-Cola Regular</p>
    <p class="small text-muted mb-0">250 ML</p>
    </div>
    <div class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto">
    <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="2">
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    <div class="cart-box-item-price">
    <div class="text-end">₹20</div>
    </div>
    </div>
    <div class="cart-box-item d-flex align-items-center py-2 px-3">
    <div class="success-dot"></div>
    <div class="cart-box-item-title px-2">
    <p class="mb-0">French fries combo</p>
    <p class="small text-muted mb-0">For 2 people</p>
    </div>
    <div class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto">
    <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="2">
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    <div class="cart-box-item-price">
    <div class="text-end">₹87</div>
    </div>
    </div>
    <div class="cart-box-item d-flex align-items-center py-2 px-3">
    <div class="success-dot"></div>
    <div class="cart-box-item-title px-2">
    <p class="mb-0">French fries regular</p>
    <p class="small text-muted mb-0">For 2 people</p>
    </div>
    <div class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto">
    <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="2">
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    <div class="cart-box-item-price">
    <div class="text-end">₹50</div>
    </div>
    </div>
    </div>
    </div>
    <div class="border border-warning bg-opacity-10 bg-warning shadow-sm rounded position-relative p-3 mb-3 tip-block">
    <div class="d-flex gap-2 mb-2 pb-1">
    <span><i class="bi bi-heart-fill text-warning"></i></span>
    <div>Thanks your partner with a tip</div>
    </div>
    <div>
    <div class="col-tip">
    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
    <label class="btn btn-light btn-sm rounded-pill border" for="btnradio1">
    <div class="d-flex align-items-center gap-1">
    <div><img src="{{ asset('frontend/assets/img/tip1.png') }}" alt class="img-fluid"></div>
    <div>&#8377;10</div>
    </div>
    </label>
    </div>
    <div class="col-tip">
    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" checked>
    <label class="btn btn-light btn-sm rounded-pill border" for="btnradio2">
    <div class="d-flex align-items-center gap-1">
    <div><img src="{{ asset('frontend/assets/img/tip2.png') }}" alt class="img-fluid"></div>
    <div>&#8377;20</div>
    </div>
    </label>
    </div>
    <div class="col-tip">
    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" checked>
    <label class="btn btn-light btn-sm rounded-pill border" for="btnradio3">
    <div class="d-flex align-items-center gap-1">
    <div><img src="assets/img/tip3.png" alt class="img-fluid"></div>
    <div>&#8377;35</div>
    </div>
    </label>
    </div>
    <div class="col-tip">
    <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off" checked>
    <label class="btn btn-light btn-sm rounded-pill border" for="btnradio4">
    <div class="d-flex align-items-center gap-1">
    <div><img src="assets/img/tip1.png" alt class="img-fluid"></div>
    <div>&#8377;40</div>
    </div>
    </label>
    </div>
    <div class="col-tip">
    <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off" checked>
    <label class="btn btn-light btn-sm rounded-pill border" for="btnradio5">
    <div class="d-flex align-items-center gap-1">
    <div><img src="assets/img/tip2.png" alt class="img-fluid"></div>
    <div>&#8377;50</div>
    </div>
    </label>
    </div>
    <div class="col-tip">
    <input type="radio" class="btn-check" name="btnradio" id="btnradio6" autocomplete="off" checked>
    <label class="btn btn-light btn-sm rounded-pill border" for="btnradio6">
    <div class="d-flex align-items-center gap-1">
    <div><img src="assets/img/tip3.png" alt class="img-fluid"></div>
    <div>&#8377;65</div>
    </div>
    </label>
    </div>
    </div>
    <div class="col-auto mt-2">
    <div class="small text-muted">The amount will be credited to the partner's tip jar</div>
    </div>
    </div>
    <div class="bg-white shadow-sm rounded position-relative mb-3">
    <div>
    <div class="input-group input-group-sm p-3 align-items-center border-bottom">
    <input type="text" class="form-control border-0 p-0" placeholder="Enter promo code">
    <a class="fw-bold border-0 text-warning p-0 text-decoration-none btn-sm rounded ms-1" href="#"><i class="icofont-sale-discount"></i> APPLY</a>
    </div>
    <div class="input-group input-group-sm p-3">
    <span class="input-group-text bg-white align-items-start border-0 ps-0 pb-0 pt-1 pe-3"><i class="bi bi-chat-left-dots"></i></span>
    <textarea class="form-control border-0 p-0" placeholder="Any Instructions? Eg: Do not ring the doorbell"></textarea>
    </div>
    </div>
    </div>
    <div class="bg-white shadow-sm rounded position-relative overflow-hidden">
    <div class="accordion" id="accordionExample">
    <div class="accordion-item border-0">
    <h2 class="accordion-header" id="headingOne">
    <button class="accordion-button bg-white text-dark p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
    <div class="fw-bold">Invoice</div>
    </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse text-dark show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
    <div class="accordion-body px-3 pb-3 pt-0">
    <div class="d-flex justify-content-between align-items-center pb-1">
    <div class="text-muted">Item total</div>
    <div class="text-dark">&#8377;1295</div>
    </div>
    <div class="d-flex justify-content-between align-items-center py-1">
    <div class="text-muted">Packing</div>
    <div class="text-dark">&#8377;5</div>
    </div>
    <div class="d-flex justify-content-between align-items-center py-1">
    <div class="text-muted">Partner tip amount</div>
    <div class="text-dark">&#8377;10</div>
    </div>
    <div class="d-flex justify-content-between align-items-center py-1">
    <div class="text-muted">Partner delivery fee&nbsp;<span><i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Free delivery covers all delivery charges such as delivery fee" class="bi bi-info-circle text-muted small"></i></span></div>
    <div class="text-dark">&#8377;70</div>
    </div>
    <div class="d-flex justify-content-between align-items-center py-1 text-warning">
    <div>BazaarX cash discount</div>
    <div>-&#8377;50</div>
    </div>
    <div class="d-flex justify-content-between align-items-center pt-1">
    <div class="fw-bold">To pay</div>
    <div class="fw-bold">&#8377;245</div>
    </div>
    </div>
    <div class="bg-warning text-white px-3 py-2">
    <span><i class="bi bi-check-circle-fill text-white"></i></span>&nbsp;
    Woohoo! You saved &#8377;50 on this order
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="d-grid my-3">
    <a href="{{ route('success.order') }}" class="btn btn-success btn-lg py-3 px-4">
    <div class="d-flex justify-content-between">
    <div>Checkout</div>
    <div class="fw-bold">₹750</div>
    </div>
    </a>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="container my-4">
    
    
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow overflow-hidden">
    <div class="modal-header px-4">
    <h5 class="h6 modal-title fw-bold">Add Drop Details</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body p-4">
    <div class="bg-light rounded overflow-hidden border mb-4">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54776.1744782857!2d75.8216539883091!3d30.900340484153784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a837462345a7d%3A0x681102348ec60610!2sLudhiana%2C%20Punjab!5e0!3m2!1sen!2sin!4v1659863868963!5m2!1sen!2sin" width="100%" height="150" class="border-0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div class="p-3">
    <div class="d-flex align-items-center gap-3">
    <i class="bi bi-pin-map h5 mb-0"></i>
    <span class="text-start">
    <h6 class="mb-1 fw-bold">Selected Location</h6>
    <div class="text-muted small text-opacity-50">925 S Chugach St #APT 10, Palmer, Alaska 99645, USA</div>
    </span>
    <i class="bi bi-check-circle-fill ms-auto"></i>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-6 mb-3">
    <label class="form-label">Flat, Floor, Building Name</label>
    <div class="input-group rounded overflow-hidden border">
    <span class="input-group-text bg-white border-0"><i class="bi bi-house-door-fill text-muted"></i></span>
    <input type="text" class="form-control bg-white border-0 ps-1" placeholder="e.g., 123, Gofinx" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    </div>
    <div class="col-6 mb-3">
    <label class="form-label">How to Reach (Optoinal)</label>
    <div class="input-group rounded overflow-hidden border">
    <span class="input-group-text bg-white border-0"><i class="bi bi-map-fill text-muted"></i></span>
    <input type="text" class="form-control bg-white border-0 ps-1" placeholder="e.g. Take Left" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    </div>
    <div class="col-6 mb-3">
    <label class="form-label">Contact Person Name</label>
    <div class="input-group rounded overflow-hidden border">
    <span class="input-group-text bg-white border-0"><i class="bi bi-person-fill text-muted"></i></span>
    <input type="text" class="form-control bg-white border-0 ps-1" placeholder="e.g. Nikhal" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    </div>
    <div class="col-6 mb-3">
    <label class="form-label">Contact Number</label>
    <div class="input-group rounded overflow-hidden border">
    <span class="input-group-text bg-white border-0"><i class="bi bi-telephone-fill text-muted"></i></span>
    <input type="text" class="form-control bg-white border-0 ps-1" placeholder="e.g. 12345678" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    </div>
    <div class="col-12">
    <label class="form-label">Save Address As</label>
    <div class="row">
    <div class="col-auto"><input type="radio" class="btn-check" name="btnradio" id="btnradio133" autocomplete="off">
    <label class="btn btn-outline-secondary" for="btnradio133">Home</label>
    </div>
    <div class="col-auto px-0"><input type="radio" class="btn-check" name="btnradio" id="btnradio233" autocomplete="off">
    <label class="btn btn-outline-secondary" for="btnradio233">Office</label>
    </div>
    <div class="col-auto"><input type="radio" class="btn-check" name="btnradio" id="btnradio333" autocomplete="off">
    <label class="btn btn-outline-secondary" for="btnradio333">Other</label>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="border-top d-flex">
    <button type="button" class="w-100 btn btn-lg py-4 border-0 btn-outline-success rounded-0" data-bs-dismiss="modal">CLOSE</button>
    <button type="button" class="w-100 btn btn-lg py-4 border-0 btn-success rounded-0" data-bs-dismiss="modal">SAVE ADDRESS</button>
    </div>
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