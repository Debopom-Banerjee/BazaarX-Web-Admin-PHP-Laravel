@if (isset($empty_msg))
    <div class="">
        <div class="text-center">
            <img src="{{ $img_path ?? asset('frontend/assets/img/icons/no-data-found.jpg') }}" alt="Empty-Image"
              class="img-fluid w-50">
            <p class="text-muted">{{ $empty_msg }}</p>
        </div>
    </div>
@endif