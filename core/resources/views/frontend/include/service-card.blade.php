<div class="text-center position-relative border010 rounded cursor-pointer">
    <a href="@if($service->slug != null){{ route('service.show',$service->slug) }} @else # @endif" class="text-decoration-none">
        <img src="{{ ($service->web_banner) ? asset($service->web_banner) : asset('frontend/assets/img/service-card.webp') }}" style="" class="img-fluid service-image" alt="...">
    </a>
        {{-- <hr class="mb-0 mt-1"> --}}
    <div class="listing-card-body details-card mt-0">
        <div class="d-flex justify-content-between">
            <a  href="@if($service->slug != null){{ route('service.show',$service->slug) }} @else # @endif" class="text-decoration-none d-flex">
                <div class="product-price"> 
                    <span class="mr-2 mb-1 fw-800">{{ format_price($service->price) }}</span>
                </div>
                <div class="product-mrp text-muted"> 
                    <s class="mobile-d-none">{{ format_price($service->mrp) }}</s>
                </div>
            </a>

            <button data-id="{{ $service->id }}" class="btn btn-success add-cart-btn btn-icon openShowModal mobile-eye-icon">
                <i class="bi bi-sm bi-eye"></i>
            </button>
        </div>
        <a  href="@if($service->slug != null){{ route('service.show',$service->slug) }} @else # @endif" class="text-decoration-none text-muted">
            <div class="service-title">
                <h5 class="mb-2 mobile-fs-sm fw-800">{{$service->title}}</h5>
            </div>
    
            <div class="service-days-text mt-3">
               @if ($service->service_duration != null)  
                  <h6 class="text-muted">{{ $service->service_duration }} days delivery</h6>
                @else
                  {{-- <h6 class="text-muted">{{ $service-> }} </h6>     --}}
                @endif 
            </div>
        </a>
    </div>
</div>