<section id="app-section" class="bg-white mobile-app-section mt-5">
    <div class="container-fluid  mobile-mx-100">
        <div class="bg-light px-7 mobile-px-0 app-height">
            <div class="row">
                <div class="col-lg-7 col-sm-12 col-md-12">
                    <div class="mt-90" style="margin-top:75px;">
                        <div class="text-md-start mobile-text-center desktop-w-84">
                            <h1 class="fw-bold mb-3 text-dark">Get the BazaarX app</h1>
                            <p class="m-0 fs-18 app-text">We offer high-quality foods and the best delivery service, and the food market you can blindly trust</p>
                        </div>
                        {{-- <form action="{{ route('send.app-link') }}" method="Post" class="my-4 me-lg-5">
                            @csrf
                            <div class="input-group bg-white shadow-sm rounded-pill p-2">
                                <span class="input-group-text bg-white border-0"><i class="bi bi-phone pe-2"></i> +91
                                </span>
                                <input name="phone" type="text" class="form-control bg-white border-0 ps-0 me-1"
                                    placeholder="Enter phone number">
                                <button style="position: static" class="btn btn-warning rounded-pill py-2 px-4 border-0" type="submit">Send app
                                    link</button>
                            </div>
                        </form> --}}
                        <div class="text-md-start text-center pb-md-4 ">
                            {{-- <p class="mb-3">Download app from</p> --}}
                            <a target="_blank" href="https://play.google.com/store/apps/details?id=com.gofinx.app"><img alt="Play Store" src="{{ asset('frontend/assets/img/play-store.svg')}}"
                                    class="img-fluid mobile-app-icon"></a>
                            <a target="_blank" href="https://apps.apple.com/in/app/gofinx/id6444019342"><img alt="App Store" src="{{ asset('frontend/assets/img/app-store.svg')}}"
                                    class="img-fluid mobile-app-icon"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 pe-lg-5 mt-5 mt-md-0 mt-lg-0 col-sm-d-none">
                    <img alt="#" src="{{ asset('frontend/assets/img/mobile-app.png')}}" class="img-fluid mobile-app-img" style="">
                </div>
            </div>
        </div>
    </div>
</section>