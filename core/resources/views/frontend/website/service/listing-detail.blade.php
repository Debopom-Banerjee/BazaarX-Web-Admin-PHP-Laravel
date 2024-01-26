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

<section class="bg-white">
    <div class="container">
    <div class="row py-3">
    <div class="col-12">
    <nav>
    <ol class="breadcrumb small mb-0">
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-success">Home</a></li>
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-success">Punjab</a></li>
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-success">Green Park</a></li>
    <li class="breadcrumb-item active" aria-current="page">Deal 4 Grocery</li>
    </ol>
    </nav>
    </div>
    </div>
    </div>
    </section>
    <main class="sticky-top ">
    <section class="bg-success">
    <div class="container py-4">
    <div class="row justify-content-between align-items-center">
    <div class="col-md-6">
    <div class="d-flex align-items-center listing-detail-info gap-3">
    <img src="{{ asset('frontend/assets/img/list8.jpg') }}" class="img-fluid rounded-3" alt="...">
    <div class="listing-detail-info-body">
    <h3 class="listing-detail-info-title fw-bold mb-1 text-white">Deal 4 Grocery</h3>
    <p class="mb-3 text-white-50">Cafe, Beverages, Fast Food, Desserts, India</p>
    <div class="d-flex align-items-center gap-4">
    <div>
    <div class="text-uppercase text-warning-light fw-bold fs-14"><i class="bi bi-star-fill"></i> 4.0</div>
    <p class="text-white-50 small mb-0">1K+ Ratings</p>
    </div>
    <div>
    <div class="text-uppercase text-white fw-bold fs-14">33 mins</div>
    <p class="text-white-50 small mb-0">Delivery Time</p>
    </div>
    <div>
    <div class="text-uppercase text-warning-light fw-bold fs-14">Open now</div>
    <p class="text-white-50 small mb-0">Opening</p>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-md-4 d-none d-md-block">
    <div class="offer-box position-relative bg-white rounded-3 shadow-sm p-4">
    <small class="offer-box-title fw-bold bg-warning text-white">OFFER</small>
    <div class="d-flex align-items-center gap-3 mb-3">
    <i class="bi bi-percent m-0 rounded-pill rounded-icon"></i>
    <span>
    <div class="text-uppercase text-success fw-bold">60% off</div>
    <p class="text-muted small mb-0">Up to ₹120 | Use code MISSEDYOU</p>
    </span>
    </div>
    <div class="d-flex align-items-center gap-3">
    <i class="bi bi-gift m-0 rounded-pill rounded-icon"></i>
    <span>
    <div class="text-uppercase text-success fw-bold">Free Food</div>
    <p class="text-muted small mb-0">Free Laccha Paratha on orders above Rs 349</p>
    </span>
    </div>
    </div>
    </div>
    </div>
    </div>
    </section>
    </main>
    
    <section class="border-bottom bg-light listing-detail-page">
    <div class="container">
    <div class="row">
    <div class="col-12 col-md-2">
    <div class="listing-detail-fixed-sidebar">
    <div class="nav flex-column listing-detail-tabs mt-3 pb-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Recommended</button>
    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Ingredients</button>
    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Meat / Drinks</button>
    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Fest Desserts
    </button>
    </div>
    </div>
    </div>
    <div class="col-12 col-md-6">
    <div class="border-start border-end position-relative bg-white">
    <form class="bg-white border-bottom p-2">
    <div class="input-group border-0 osahan-search-icon rounded">
    <span class="input-group-text bg-white border-0"><i class="icofont-search"></i></span>
    <input type="text" class="form-control bg-white border-0 ps-2" placeholder="Search in Deal 4 Grocery">
    </div>
    </form>
    <div class="tab-content" id="v-pills-tabContent">
    
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <div class="bg-light border-bottom p-3">
    <h5 class="fw-bold mb-0 text-dark">Recommended</h5>
    </div>
    <h6 class="small text-success mb-0 p-3">37 ITEMS</h6>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="{{ asset('frontend/assets/img/p11.jpg') }}" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Coke & Lays Combo</p>
    <p class="card-text small mb-0">Coca Cola Can (3x300Ml) + Lays Magic masala Chips(3x26 Gms)</p>
    <p class="card-text text-muted mb-2">1 Pack</p>
    <h6 class="fw-bold">&#8377;135</h6>
    </div>
    <div class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto mb-auto">
    <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="1">
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="{{ asset('frontend/assets/img/p6.jpg') }}" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Comfort Morning Fresh Fabric Conditioner Bottle</p>
    <p class="card-text text-muted small mb-1">Morning freash fabric conditioner now with fragrance peals gives all-day freshness to clothes soft</p>
    <p class="card-text text-muted mb-2">1 LTR</p>
    <h6 class="fw-bold">&#8377;235</h6>
    </div>
    <div class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto mb-auto">
    <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="1">
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="{{ asset('frontend/assets/img/p8.jpg') }}" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Rin detergent powder</p>
    <p class="card-text small text-muted mb-2">1KG</p>
    <h6 class="fw-bold">&#8377;65</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="{{ asset('frontend/assets/img/p4.jpg') }}" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Surf Excel Easywash Detergent Powder</p>
    <p class="card-text small text-muted mb-2">1KG</p>
    <h6 class="fw-bold">&#8377;120</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="{{ asset('frontend/assets/img/p6.jpg') }}" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Surf Excel Matic Front Load Detergent Powder</p>
    <p class="card-text small text-muted mb-2">1LTR</p>
    <h6 class="fw-bold">&#8377;250</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="{{ asset('frontend/assets/img/p5.jpg') }}" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Surf Excel Matic Liquid Detergent Powder</p>
    <p class="card-text small text-muted mb-2">1KG</p>
    <h6 class="fw-bold">&#8377;230</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="{{ asset('frontend/assets/img/p3.jpg') }}" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Tide Plus Jasmine & Rose Detergent Powder</p>
    <p class="card-text small text-muted mb-2">1KG</p>
    <h6 class="fw-bold">&#8377;160</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="p-3">
    <div class="small mb-1"><span><i class="bi bi-newspaper me-2"></i></span> Deal 4 Grocery</div>
    <div class="text-muted small mb-1"><span><i class="bi bi-coin me-2"></i></span> RUPAL PAL</div>
    <div class="text-muted small mb-1"><span><i class="bi bi-geo-alt-fill me-2"></i></span> 213, Guneet Kashyap Marg Rd, South Extension, Masjid Moth Village, South Extension</div>
    <div class="fw-bold ps-3 ms-1">License No. 23319009001905</div>
    </div>
    </div>
    
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <div class="bg-light border-bottom p-3">
    <h5 class="fw-bold mb-0 text-dark">Ingredients</h5>
    </div>
    <h6 class="small text-success mb-0 p-3">47 ITEMS</h6>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="{{ asset('frontend/assets/img/p10.jpg') }}" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Classic Mild</p>
    <p class="card-text text-info small mb-1">Age Veriication Needed</p>
    <p class="card-text small text-muted mb-2">Pack Of 20</p>
    <h6 class="fw-bold">&#8377;330</h6>
    </div>
    <div class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto mb-auto">
    <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="1">
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="{{ asset('frontend/assets/img/p2.jpg') }}" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Classic Ultra Mild</p>
    <p class="card-text text-info small mb-1">Age Veriication Needed</p>
    <p class="card-text small text-muted mb-2">Pack Of 20</p>
    <h6 class="fw-bold">&#8377;330</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="{{ asset('frontend/assets/img/p3.jpg') }}" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Gold Flakes Small</p>
    <p class="card-text text-info small mb-1">Age Veriication Needed</p>
    <p class="card-text small text-muted mb-2">Pack Of 10</p>
    <h6 class="fw-bold">&#8377;100</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="{{ asset('frontend/assets/img/p4.jpg') }}" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Marlboro Gold(Lights/White)</p>
    <p class="card-text text-info small mb-1">Age Veriication Needed</p>
    <p class="card-text small text-muted mb-2">Pack Of 10</p>
    <h6 class="fw-bold">&#8377;330</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="{{ asset('frontend/assets/img/p.jpg') }}" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Classic Ultra Mild</p>
    <p class="card-text text-info small mb-1">Age Veriication Needed</p>
    <p class="card-text small text-muted mb-2">Pack Of 20</p>
    <h6 class="fw-bold">&#8377;330</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p6.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Gold Flakes Small</p>
    <p class="card-text text-info small mb-1">Age Veriication Needed</p>
    <p class="card-text small text-muted mb-2">Pack Of 10</p>
    <h6 class="fw-bold">&#8377;100</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p7.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Marlboro Gold(Lights/White)</p>
    <p class="card-text text-info small mb-1">Age Veriication Needed</p>
    <p class="card-text small text-muted mb-2">Pack Of 10</p>
    <h6 class="fw-bold">&#8377;330</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    </div>
    
    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
    <div class="bg-light border-bottom p-3">
    <h5 class="fw-bold mb-0 text-dark">Meat / Drinks</h5>
    </div>
    <h6 class="small text-success mb-0 p-3">98 ITEMS</h6>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p12.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Coca-Cola Soft Drink Can</p>
    <p class="card-text text-muted small mb-1">300 ML</p>
    <h6 class="fw-bold">&#8377;40</h6>
    </div>
    <div class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto mb-auto">
    <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="1">
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p13.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Coca-Cola Soft Drink Can</p>
    <p class="card-text text-muted small mb-1">250 ML</p>
    <h6 class="fw-bold">&#8377;20</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p4.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Coca-Cola Diet Cn with Light Taste No Suger</p>
    <p class="card-text text-muted small mb-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus corporis cupiditate sed est ratione</p>
    <p class="card-text text-muted small mb-2">300 ML</p>
    <h6 class="fw-bold">&#8377;40</h6>
    </div>
    <div class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto mb-auto">
    <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="1">
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p10.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Coca-Cola Soft Drink Can</p>
    <p class="card-text text-muted small mb-1">250 ML</p>
    <h6 class="fw-bold">&#8377;20</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="p-3">
    <div class="small mb-1"><span><i class="bi bi-newspaper me-2"></i></span> Deal 4 Grocery</div>
    <div class="text-muted small mb-1"><span><i class="bi bi-coin me-2"></i></span> RUPAL PAL</div>
    <div class="text-muted small mb-1"><span><i class="bi bi-geo-alt-fill me-2"></i></span> 213, Guneet Kashyap Marg Rd, South Extension, Masjid Moth Village, South Extension</div>
    <div class="fw-bold ps-3 ms-1">License No. 23319009001905</div>
    </div>
    </div>
    
    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
    <div class="bg-light border-bottom p-3">
    <h5 class="fw-bold mb-0 text-dark">Desserts</h5>
    </div>
    <h6 class="small text-success mb-0 p-3">24 ITEMS</h6>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p18.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Harpic Powe Plus 10X Blue Toilet Cleaner</p>
    <p class="card-text text-muted small mb-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus corporis cupiditate sed est ratione dolor</p>
    <p class="card-text text-muted mb-2">1 LTR</p>
    <h6 class="fw-bold">&#8377;187</h6>
    </div>
    <div class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto mb-auto">
    <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="1">
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p9.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Harpic Powe Plus 10X Blue Toilet Cleaner</p>
    <p class="card-text small text-muted mb-2">500 ML</p>
    <h6 class="fw-bold">&#8377;130</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p16.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Comfort Morning Fresh Fabric Conditioner Bottle</p>
    <p class="card-text text-muted small mb-1">Morning freash fabric conditioner now with fragrance peals gives all-day freshness to clothes soft</p>
    <p class="card-text text-muted mb-2">1 LTR</p>
    <h6 class="fw-bold">&#8377;235</h6>
    </div>
    <div class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto mb-auto">
    <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="1">
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p8.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Rin detergent powder</p>
    <p class="card-text small text-muted mb-2">1KG</p>
    <h6 class="fw-bold">&#8377;65</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p4.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Surf Excel Easywash Detergent Powder</p>
    <p class="card-text small text-muted mb-2">1KG</p>
    <h6 class="fw-bold">&#8377;120</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p6.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Surf Excel Matic Front Load Detergent Powder</p>
    <p class="card-text small text-muted mb-2">1LTR</p>
    <h6 class="fw-bold">&#8377;250</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p5.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Surf Excel Matic Liquid Detergent Powder</p>
    <p class="card-text small text-muted mb-2">1KG</p>
    <h6 class="fw-bold">&#8377;230</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p3.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Tide Plus Jasmine & Rose Detergent Powder</p>
    <p class="card-text small text-muted mb-2">1KG</p>
    <h6 class="fw-bold">&#8377;160</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p2.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Vim Bar</p>
    <p class="card-text small text-muted mb-2">500 GMS</p>
    <h6 class="fw-bold">&#8377;52</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p7.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Black Hit Spray- Mosquitoes & Flies</p>
    <p class="card-text small text-muted mb-2">500 GMS</p>
    <h6 class="fw-bold">&#8377;52</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p12.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">AA Duracell Battery</p>
    <p class="card-text small text-muted mb-2">4 PCS</p>
    <h6 class="fw-bold">&#8377;160</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p17.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Duracell Aaa Battery</p>
    <p class="card-text small text-muted mb-2">1 PCS</p>
    <h6 class="fw-bold">&#8377;35</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p1.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">VIm Power Lemon Dishwash Get Bottle</p>
    <p class="card-text small text-muted mb-2">750 ML</p>
    <h6 class="fw-bold">&#8377;155</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p13.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Good knight Gold Flash Refill+Machine</p>
    <p class="card-text small text-muted mb-2">1PC</p>
    <h6 class="fw-bold">&#8377;89</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    <div class="product-list d-flex p-3 border-bottom">
    <img src="assets/img/p14.jpg" class="img-fluid" alt="...">
    <div class="product-list-body px-3">
    <p class="fw-bold mb-1">Garbage Bag Large</p>
    <p class="card-text small text-muted mb-2">1PC</p>
    <h6 class="fw-bold">&#8377;89</h6>
    </div>
    <div class="ms-auto mb-auto">
    <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><span><i class="bi bi-plus-lg"></i></span>&nbsp;ADD</button>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-12 col-md-4">
    <div class="listing-detail-fixed-sidebar mb-4">
    <div class="bg-white cart-box border rounded position-relative mt-4">
    <div class="p-3 border-bottom">
    <h5 class="mb-0 fw-bold">Your Cart</h5>
    <p class="small mb-0">4 items from <span class="text-success">Grand Fresh Supermart</span></p>
    </div>
    <div class="py-2">
    <div class="cart-box-item d-flex align-items-center py-2 px-3">
    <div class="success-dot"></div>
    <div class="cart-box-item-title px-2">
    <p class="mb-0">Coke & lays Combo</p>
    <p class="small text-muted mb-0">1 pack</p>
    </div>
    <div class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto">
    <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="1" />
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    <div class="cart-box-item-price">
    <div class="text-end">&#8377;87</div>
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
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="2" />
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    <div class="cart-box-item-price">
    <div class="text-end">&#8377;40</div>
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
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="2" />
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    <div class="cart-box-item-price">
    <div class="text-end">&#8377;20</div>
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
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="2" />
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    <div class="cart-box-item-price">
    <div class="text-end">&#8377;87</div>
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
    <input class="form-control text-center border-0 py-0 box" type="text" placeholder aria-label="default input example" value="2" />
    <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
    </div>
    <div class="cart-box-item-price">
    <div class="text-end">&#8377;50</div>
    </div>
    </div>
    </div>
    </div>
    <div class="d-grid my-4">
    <a href="{{ route('cart') }}" class="btn btn-success btn-lg py-3 px-4">
    <div class="d-flex justify-content-between">
    <div>Checkout</div>
    <div class="fw-bold">&#8377;750</div>
    </div>
    </a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </section>
    
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