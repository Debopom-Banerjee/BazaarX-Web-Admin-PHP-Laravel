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
<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <div class="fixed-sidebar">
                <div id="carouselExampleControls" class="carousel slide shadow-sm rounded overflow-hidden"
                    data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset($services->banner) }}"
                                class="d-block w-100" alt="...">
                        </div>
                    </div>
                    {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button> --}}
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="bg-white shadow-sm rounded position-relative p-4">
                {{-- <a class="text-success text-decoration-none" href="{{ route('service.index') }}"><i
                        class="bi bi-shop"></i> {{ $services->slug }}</a> --}}
                <div class="h3 fw-bold mt-1 mb-3">{{ $services->title }}</div>
                <div class="d-flex align-items-center py-1">
                    <div>
                        <div class="h6 mb-0 text-dark">MRP: &#8377;{{ $services->mrp }} </div>
                        <small class="text-muted">(Inclusive of all taxes)</small>
                    </div>
                </div>
                {{-- <div class="d-flex align-items-center gap-3 mt-3 mb-4">
                    <div class="gap-2 d-flex">
                        <div class="col-auto"><input type="radio" class="btn-check" name="btnradio" id="btnradio133"
                                autocomplete="off">
                            <label class="btn btn-outline-secondary btn-sm" for="btnradio133">250 ML</label>
                        </div>
                        <div class="col-auto px-0"><input type="radio" class="btn-check" name="btnradio"
                                id="btnradio233" autocomplete="off">
                            <label class="btn btn-outline-secondary btn-sm" for="btnradio233">500 ML</label>
                        </div>
                        <div class="col-auto"><input type="radio" class="btn-check" name="btnradio" id="btnradio333"
                                autocomplete="off">
                            <label class="btn btn-outline-secondary btn-sm" for="btnradio333">700 ML</label>
                        </div>
                    </div>
                    <div class="small text-warning my-2">Customizable</div>
                </div> --}}
                <div>
                    {{ $services->benefit}}
                </div>
                {{-- <div class="d-flex align-items-center gap-5">
                    <div>
                        <div class="small text-uppercase text-muted">COUNTRY OF ORIGIN</div>
                        <p class="text-dark mb-0">India</p>
                    </div>
                    <div>
                        <div class="small text-uppercase text-muted">Shelf life</div>
                        <p class="text-dark mb-0">12 Months</p>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-12">
                        <div class="border-top pt-3 mt-3">
                            <h6>Important Information</h6>
                            <p class="text-muted mb-0">{{ $services->description }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="fixed-sidebar">
                <div class="bg-white cart-box border rounded position-relative">
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
                            <div
                                class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto">
                                <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
                                <input class="form-control text-center border-0 py-0 box" type="text" placeholder
                                    aria-label="default input example" value="1">
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
                            <div
                                class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto">
                                <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
                                <input class="form-control text-center border-0 py-0 box" type="text" placeholder
                                    aria-label="default input example" value="2">
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
                            <div
                                class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto">
                                <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
                                <input class="form-control text-center border-0 py-0 box" type="text" placeholder
                                    aria-label="default input example" value="2">
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
                            <div
                                class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto">
                                <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
                                <input class="form-control text-center border-0 py-0 box" type="text" placeholder
                                    aria-label="default input example" value="2">
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
                            <div
                                class="d-flex align-items-center justify-content-between rounded-pill border cart-quantity px-1 ms-auto">
                                <div class="minus cart-quantity-btn"><i class="bi bi-dash text-success"></i></div>
                                <input class="form-control text-center border-0 py-0 box" type="text" placeholder
                                    aria-label="default input example" value="2">
                                <div class="plus cart-quantity-btn"><i class="bi bi-plus text-success"></i></div>
                            </div>
                            <div class="cart-box-item-price">
                                <div class="text-end">₹50</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid my-3">
                    <a href="cart.html" class="btn btn-success btn-lg py-3 px-4">
                        <div class="d-flex justify-content-between">
                            <div>Checkout</div>
                            <div class="fw-bold">&#8377;195</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="bg-white border-top border-bottom shadow-sm">
    <div class="container">
        <div class="row align-items-center py-4">
            <div class="col-12 col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white rounded-circle shadow-sm border rounded-icon-50">
                        <i class="bi bi-bag-heart-fill text-success h4 m-0"></i>
                    </div>
                    <h6 class="text-uppercase m-0">no minimum order</h6>
                </div>
            </div>
            <div class="col-12 my-2 my-md-0 col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white rounded-circle shadow-sm border rounded-icon-50">
                        <i class="bi bi-clock-fill text-success h4 m-0"></i>
                    </div>
                    <h6 class="text-uppercase m-0">45 mins delivery</h6>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white rounded-circle shadow-sm border rounded-icon-50">
                        <i class="bi bi-hand-thumbs-up-fill text-success h4 m-0"></i>
                    </div>
                    <h6 class="text-uppercase m-0">contactless & safe</h6>
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
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Chanakyapuri</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Greater Kailash 2</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Jasola</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Lajpat Nagar</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Mehruli</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Rashtrapati Bhavan</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Sarojini Nagar</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <ul class="list-unstyled d-grid gap-2 mb-0">
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Chhatarpur</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Green Park</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">kalkaji</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Ladhi Colony</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Munirka</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Sainik Farm</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">South Ext.</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <ul class="list-unstyled d-grid gap-2 mb-0">
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Connaught Place</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Hauz Khas</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Karol Bagh</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Mahipalpur</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">New Friends Colony</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Saket</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Vasant Kunj</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <ul class="list-unstyled d-grid gap-2 mb-0">
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Greater Kailash 1</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Khan Market</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Malviya Nagar</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">RK Puram</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Sarai Kala khan</a></li>
                    <li><a href="{{ route('service.index') }}"
                            class="text-decoration-none text-muted">Vasant Vihar</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
