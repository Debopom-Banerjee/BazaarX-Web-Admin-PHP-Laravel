<style>
    .owl-nav{
        display: none;
    }
</style>
<section>
    <div class="container-fluid pt-5 w-80">
        <div class="text-center">
            <h3 class="category-title text-dark fw-700">Partners & Clients</h3>
        </div>
        <div class="row g-4 owl-carousel custom-carousel owl-theme text-center mx-auto">
            @foreach ($partners_clients_sliders as $partners_clients_slider)
                <div class="rounded">
                    <a target="_blank" href="{{$partners_clients_slider->link}}"  class="hover14">
                        <img src="{{ asset('storage/backend/constant-management/sliders/'.$partners_clients_slider->image) }}" alt=""class="explore-img image-container home-slider-img">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
