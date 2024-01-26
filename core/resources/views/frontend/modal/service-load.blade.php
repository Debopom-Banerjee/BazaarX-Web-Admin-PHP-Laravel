<div class="row justify-content-center mb-2">
    <div class="col-lg-8 col-md-12 col-sm-12 text-left order-2 order-lg-1">
        <div class="tabs">

            <h5 class="mt-2" style="font-weight: 800;">
                {{\Str::limit(@$service->title,100) }}
            </h5>
            <div class="mt-4 ml-2">
                <div class="mb-3">
                    <h6 class="mb-0" style="border-left: 3px solid #1A78BF;padding-left: 4px;">Overview</h6>
                    <div class="p-1">
                        <p class="text-muted ml-2 mb-0">{!! nl2br(@$service->description) !!}</p>
                    </div>
                </div>
            </div>
            <div class="mt-2 ml-2">
                <div class="mb-3">
                    <h6 class="mb-0" style="border-left: 3px solid #1A78BF;padding-left: 4px;">Benefits</h6>
                    <div class="p-1">
                        <p class="text-muted ml-2 mb-0">{!! nl2br(@$service->benefit) !!}</p>
                    </div>
                </div>
            </div>
            @if(@$service->document != null)
                <div class="mt-2 ml-2">
                    <div class="mb-3">
                        <h6 class="mb-0" style="border-left: 3px solid #1A78BF;padding-left: 4px;">Documents</h6>
                        <div class="p-1">
                            <ul class="text-muted ml-2 mb-0">
                                @foreach (explode(',',@$service->document) as $document_item)
                                    <li>
                                        {{@$document_item}}
                                    </li> 
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif 
            <div class="mt-2 ml-2">
                <div class="mb-3">
                    <h6 class="mb-0" style="border-left: 3px solid #1A78BF;padding-left: 4px;">Deliverables</h6>
                    <div class="p-1">
                        <p class="text-muted ml-2 mb-0">{!! nl2br(@$service->deliverable) !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="recommaended-services row">
            <h6 class="mb-2">Recommended Services</h6>
            @if (isset($related_services))
                @foreach (@$related_services as $related_service)
                    <div class="col-lg-4 col-sm-6 mb-4">
                        @include('frontend.include.service-card',['service'=>$related_service])
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 order-1 order-lg-2 border mobile-service-col-4" style="margin-top: 30px; height:585px; background-color: aliceblue;position: sticky; top: 15px;">
        <button style="position: absolute; right: 25px; top: 10px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>    
        <div class="listing-card-body">
            <div class="">
                <img src="{{ (@$service->web_banner) ? asset(@$service->web_banner) : asset('frontend/assets/img/service-card.webp') }}"  class="img-fluid service-xl-image rounded-3 hover01 mr-2" alt="...">
                <div class="product-details" style="margin: 15px 0 0 20px;">
                    <div class="service-title">
                        <h5 class="mb-0">{{\Str::limit(@$service->title,50) }}</h5>
                    </div>
                    <div class="d-flex">
                        <div class="product-price"> 
                            <span class="mr-2 mb-1 fw-800">{{ format_price(@$service->price) }}</span>
                        </div>

                        <div class="product-mrp"> 
                            <s>{{ format_price(@$service->mrp) }}</s>
                        </div>
                    </div>
                    <div class="delivery-info">
                        <small class="text-muted fw-400">
                            <i class="bi bi-clock-fill text-muted"></i>
                            Estimated Delivery At:  {{ now()->addDays(@$service->service_duration)->format('d M') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="mb-0 text-center" style="font-size: 14px; font-weight: 600; color: #008e27;">
            <span><i class="bi bi-check-circle-fill"></i></span>&nbsp;
            Woohoo! You saved {{ format_price(@$service->mrp-@$service->price) }} on this order
        </div>

        <a href="{{ route('checkout.index',encrypt(@$service->id)) }}" class="btn w-100 btn-success mt-4">Buy Now</a>

        
        <small class="category mt-2 d-flex justify-content-center" >
            <div class="">
                <i class="bi bi-tags fw-25 mt-1"></i> Category:
            </div>
            <a href="{{ route('search.index',['category_id' => @$service->category->id]) }}" class="text-decoration-none text-muted pt-0" style="margin-left: 10px;">
                {{ (@$service->category->name) }}
            </a>
        </small>

        <hr>
        @if(isset($service) && $service->slug != null)
        @php
            $message = "Hey there! Just wanted to share some exciting news – I found amazing website that offers ".@$service->title." services at incredibly affordable prices. If you're looking for hassle-free assistance, this could be a game-changer. Check it out: ".route('service.show', @$service->slug);
        @endphp
            <input type="hidden" id="copyServiceUrl" value="{{ route('service.show',@$service->slug) }}">
            <div class="mt-4 d-flex mobile-pt-0 mobile-mt-0" style="justify-content: space-evenly;">
               <a href="https://facebook.com/sharer.php?{{ $message }}
               " target="_blank"><i class="bi bi-facebook share-icon"></i></a>
               <a href="https://www.linkedin.com/sharing/share-offsite/?{{ $message }}" target="_blank"><i class="bi bi-linkedin share-icon"></i></a>
               <a href="https://twitter.com/intent/tweet?{{ $message }}" target="_blank"><i class="bi bi-twitter share-icon"></i></a>
               <a href="https://wa.me/?text={{ $message }}" target="_blank"><i class="bi bi-whatsapp share-icon"></i></a>
               <a title="Copy Link" href="javascript:void(0);"><i style="font-size: 21px"  class="bi bi-file-earmark-fill share-icon shareBtn" data-clipboard-target="#copyServiceUrl"></i></a>
            </div>
        @endif

        <div class="text-center copied-msg mt-2 d-none mt-1" style="font-size: 12px; font-weight: 600; color: #008e27;">
            <i class="bi bi-check2-circle"></i> <small>Share Link Copied to  your clipboard</small>
        </div>
    </div>
</div>
{{-- @include('frontend.modal.product-show-modal')   --}}