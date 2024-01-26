<style>
    .owl-nav{
        display: none;
    }
    .explore-carousel{
        padding-left: 1.3rem;
    }
</style>
<section>
    <div class="container-fluid pt-5">
        <div class="row g-4 owl-carousel explore-carousel owl-theme">
            @foreach ($explore_sliders as $explore_slider)
                <div class="rounded">
                    <div class="hover14">
                        <a href="{{ route('search.index') }}"class="no-text-decoration">
                            <figure class="mb-0">
                                <img src="{{ asset('storage/backend/constant-management/sliders/'.$explore_slider->image) }}" alt=""class="explore-img image-container">
                            </figure>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
