@extends('frontend.layouts.main')
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
<style>
    .academy_img{
        display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
    object-fit: cover;
    opacity: 0.75;

    }
    .academy_img_container{
        position: relative;
        overflow: hidden;
        width: 100%;
      height: 220px;
      display: flex;
        justify-content: center;
        align-items: center;
       
    }
    . .academy_img_container a{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .academy_section{
        min-height: 90vh;
    }
    .start-video {
        position: absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
        z-index: 1;
        cursor: pointer;
        transition: all 0.3s;
        opacity: 0.98;
}

@media screen and (max-width: 576px) {
    .academy_video_row{
        width: 100%;
        padding-top: 0;
      
    }
}
@media screen and (min-width: 576px) {
    .academy_video_row{
        width: 75%;
    }
}

  </style>

<!-- Navbar End -->
@section('meta_data')
    @php
		$meta_title = 'BazaarX Academy'.' | '.getSetting('app_name');		
		$meta_description = 'Welcome to the BazaarX Academy, your hub for knowledge and skill-building in finance, entrepreneurship, and business management. Our expert-led courses cover topics like Taxation, GST, Investment Strategies, Start-up Fundamentals, Marketing, Legal Compliance, and more. Gain valuable insights and empower yourself to succeed in the financial world.' ?? getSetting('seo_meta_description');
		$meta_keywords = ' finance courses, entrepreneurship education, business management, taxation, GST'.'' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');		
		$meta_abstract = '' ?? getSetting('site_motto');		
		$meta_author_name = '' ?? 'Defenzelite';		
		$meta_author_email = '' ?? 'support@defenzelite.com';		
		$meta_reply_to = '' ?? getSetting('frontend_footer_email');		
		$meta_img = ' ';		
	@endphp
@endsection
@section('content')
<style>
    .no-service-found-img{
    width: 30%;
	}
	.mt-40{
		margin-top: 40px;
	}
</style>

@if(!session()->has('mob'))
    <section class="pt-5 academy-img">
        <div class="container py-5 px-5">
            <div class="row gx-5">
                <div class="col-lg-12">
                    <h1 class="display-6 mb-2 w-50">Academy</h1>
                    <p class="lead m-0">BazaarX Academy: Empowering Your Financial Knowledge</p>
                </div>
            </div>
        </div>
    </section>
@endif
<div class="container py-5">
    <div class="row">
        @forelse ($sliders as $slider)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card mb-4 border-0 card shadow-sm rounded-3 position-relative" style="min-height: 275px;">
                    <div class="academy_img_container border-0">
                        <a class="start-video" data-toggle="modal" data-target="#exampleModal" 
                        onclick="playModel('{{$slider->link}}','{{$slider->title}}')" ><img width="40" height="40" src="{{asset('storage/backend/academy/play.png')}}" alt="">
                        </a>
                        <img class="card-img-top academy_img" src="{{asset('storage/backend/constant-management/sliders/'.$slider->image)}}" alt="Card image cap"> 
                    
                    </div>
                    <div class="card-body p-md-1 p-sm-2" style="padding: 13px;">
                        <div class="row d-flex align-item-center">
                            <div class="col-9 px-4">
                                <h5 class="card-title mb-0" style="font-size: 18px;">{{\Str::limit($slider->title,20,'...')}} </h5>
                                <p class="card-text text-muted" style="font-size: 14px;">{{ \Str::words($slider->description,10,'...')}}</p>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        @empty
            <div class="mt-40">
					<div class="text-center">
						<img src="{{ asset('frontend/assets/img/icons/no-data-found.jpg') }}" alt="Empty-Image"
						 class="img-fluid no-service-found-img">
						<p class="text-muted">No Academy Found</p>
					</div>
				</div>
        @endforelse
    </div> 
</div> 

{{-- model start --}}
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between" style="padding: 5px;background-color: #2495F0 !important;">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn btn-icon text-white" onclick="closeModel()" data-dismiss="modal">X</button>
        </div>
        <div class="modal-body p-0 m-0 d-flex justify-content-center">
            <iframe style="width: -webkit-fill-available;" id="modelPlayer" height="315"
            src="https://www.youtube.com/watch?v=Go8nTmfrQd8">
            </iframe>
        </div>
       
      </div>
    </div>
  </div>
{{-- model end --}}
@endsection

@push('script')
  <script>
    function playModel(link,title){ 
        $('#exampleModal').modal('show');
        $('#exampleModalLabel').html(title)
        $('#modelPlayer')[0].src = link
    }

     function closeModel(){
        $('#exampleModal').modal('hide');
     }
  </script>
@endpush



                   

           