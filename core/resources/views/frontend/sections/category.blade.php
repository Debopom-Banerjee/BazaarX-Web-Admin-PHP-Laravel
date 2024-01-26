<section>
    <div class="container-fluid mt-5">
        <div class="text-center mb-4">
            <h3 class="category-title text-dark fw-700">Choose categories from below</h3>
            <h6 class="text-muted">Discover financial opportunities with our diverse services</h6>
        </div>
        <div class="row justify-content-center flex-wrap mt-40">
            @foreach ($categories as $category)
                <div class="mx-auto category-col w-md-25 w-xl-20 category-padding category-card-hover">
                    <a href="{{ route('search.index',['category_id' => $category->id]) }}" class="shadow-category text-decoration-none br-7 d-flex justify-content-between">
                        <div class="d-flex justify-content-start category-div">
                           <div class="p-2">
                            <img src="{{ asset('storage/backend/category-icon/'.$category->icon) }}" class="category-icon" alt="...">
                           </div>
                           <div>
                             <p class="text-dark text-center mb-0 category-label fs-16 fw-700">{{($category->name) }}</p>
                           </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted mt-4 category-chevron-icon"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>