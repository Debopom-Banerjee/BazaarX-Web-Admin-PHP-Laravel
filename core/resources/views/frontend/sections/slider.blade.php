@php
    $serviceSliderColors = ['rgb(255, 238, 214)','rgb(217,236,210)','rgb(219,229,239)','rgb(239,216,212)'];
@endphp
<style>
    .text-brand-dark {
    font-size: 1.125rem;
    line-height: 1.75rem;
    --tw-text-opacity: 1;
    color: #000;
    margin-bottom: 5px;
    }
    .pr-1{
        padding-right: 1rem;
    }
</style>
<section class="bg-white mt-3">
    <div class="container-fluid container-fluid slider-carousel owl-carousel"> 
        @php
            $j = 0;
        @endphp
        @foreach ($home_sliders as $home_slider)  
            <div class="card d-none slider-section cursor-pointer silder-img-hover" style="background-color: {{ $serviceSliderColors[$j] }};border: unset;">
                <div class="slider-card-body">
                    <div class="d-flex justify-content-start image-effect">
                        <div class="slider1">
                            <img class="slider-image" src="{{ asset('storage/backend/constant-management/sliders/'.$home_slider->image) }}" >
                        </div>
                        <div class="pl-2 pt-4 slider-text">
                            <h5 class="text-brand-dark mb-0 font-manrope">{{ \Str::limit($home_slider->title,35)  }}</h5>
                            <h6 class="mb-0 text-brand-desc">{{ \Str::words($home_slider->description,10)  }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        
            @php
                ++$j;
                if($j == 4){$j = 0;}
            @endphp
            @endforeach
    </div>
</section>