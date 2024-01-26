
<section class="service-mobile-padding p-5 desktop-pt-6">
    <div class="container-fluid pt-50">
        <div class="text-center mb-4">
            <h3 class="category-title text-dark fw-700">Featured BazaarX Services</h3>
            <h6 class="text-muted pb-30 mobile-pb-10">Tailored finance solutions for your financial success</h6>
        </div>
        <div class="row g-4 homepage-products-range d-grid services-cards-grid mt-25">
            @foreach ($services as $service)
                <div class="p-0 m-0 default-card">
                    @include('frontend.include.service-card')
                </div>
            @endforeach
        </div>
    </div>
</section>