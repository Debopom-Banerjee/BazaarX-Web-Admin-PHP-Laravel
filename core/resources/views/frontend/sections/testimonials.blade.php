<style>
  .testimonials-description{
    font-size: 1.1rem;
    color: #000;
  }
  .text-break{
    word-break: break-all !important;
  }
</style>
<section class="testimonials-mobile-padding p-5">
    <div class="text-center">
        <h3 class="category-title text-dark fw-700">Testimonials</h3>
        <h6 class="text-muted pb-30">Tailored finance solutions for your financial success</h6>
    </div>
    <div class="gtco-testimonials">
        <div class="owl-carousel testimonials-carousel1 owl-theme">
          @foreach ($testimonials as $testimonial)
          <div>
            <div class="card-testimonials text-center">
              <img class="testimonials-img-top" src="{{ ($testimonial->video_img) ? asset($testimonial->video_img) : asset('frontend/assets/img/icons/download.png') }}" alt="">
              <div class="card-body">
                <h6 class="mt-3">{{$testimonial->title}} </h6>
                  {{-- <strong> Project Manager </strong> --}}
                <p class="testimonials-description text-break"> {{ $testimonial->description }} </p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
    </div>
</section>
