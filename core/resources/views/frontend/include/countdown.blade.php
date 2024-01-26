<div class="w-full min-h-40 px-4 d-flex  align-items-center justify-content-center bg-brand text-sm py-1">
    <div class="d-flex align-items-center py-1">
        <div class="d-flex py-1">
            <div class="">
                <img alt="Delivery Box" loading="lazy" decoding="async" data-nimg="1" src="{{ asset('frontend/assets/img/icons/price-tag.png') }}" style="color: transparent; width: auto; width: 16px; object-fit: contain; image-rendering: pixelated; margin-right: 7px;">
            </div>
            <div>
                <p class="text-white mb-0 countdown-text-font">
                    {{ getSetting('top_offer') }}</p>
            </div>
        </div>
    </div>
    {{-- <div>
        <button type="button" class="btn-close position-absolute countdown-close" data-bs-dismiss="modal"
        aria-label="Close"></button>
    </div> --}}

</div>
