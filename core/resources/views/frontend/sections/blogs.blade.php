<style>
    p{
        margin-bottom: 0;
    }
</style>
<section >
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h4 class="mb-0">FinxInsights Blog</h4>
            <p>Unlocking Financial Success: Insights, Tips, and Expert Advice</p>
        </div>
        <div class="collection-carousel owl-carousel">
            @foreach ($blogs as $blog)
                <div class="slider-section d-none card shadow-sm rounded-3 position-relative border-0 mb-4" style="min-height: 310px;">
                    <div class="card-body">
                        <img src="{{ $blog->description_banner ? asset('storage/backend/article/'.$blog->description_banner) : asset('frontend/assets/img/download.png')}}" class="card-img-top" alt="...">
                        <div class="listing-card-body">
                            <h6 class="card-title fw-bold mb-1">{{ $blog->title }}</h6>
                                <small class="mb-0 text-muted">{!! Str::words($blog->description,15) !!} <a class="text-decoration-none" href="{{ route('article.show',$blog->slug) }}" style="color:#1A78BF" class="p-0">Read more</a></small>
                        </div>
                    </div>
                </div><!--end col-->
            @endforeach
        </div>
    </div>
</section>