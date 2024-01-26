<style>
    .owl-nav{
        display: none;
    }
    .custom-carousel{
        padding-left: 1.3rem;
    }
</style>
<section>
    <div class="container-fluid pt-5 w-80">
        <div class="text-center">
            <h3 class="category-title text-dark fw-700">In the News</h3>
        </div>
        <div class="row g-4 owl-carousel custom-carousel owl-theme text-center mx-auto">
            @foreach ($news_sliders as $news_slider)
                <div class="rounded">
                    <div class="hover14">
                        <a target="_blank" href="{{$news_slider->link}}" class="no-text-decoration">
                            <figure class="mb-0">
                                <img src="{{ asset('storage/backend/constant-management/sliders/'.$news_slider->image) }}" alt=""class="home-slider-img">
                            </figure>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
