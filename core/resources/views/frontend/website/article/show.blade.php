@extends('frontend.layouts.main')

@section('meta_data')
    @php
		$meta_title = $article->title.' | '.getSetting('app_name');		
		$meta_description = $article->short_description ?? getSetting('seo_meta_description');
		$meta_keywords = 'finance articles, business growth, entrepreneurship tips, '.'' ?? getSetting('seo_meta_keywords');
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
    
</style>
    <section class="pt-5 blog-img">
        <div class="container py-5 px-5">
            <div class="row gx-5">
                <div class="col-lg-12">
                    <h1 class="display-6 mb-2 w-50">{{$article->title}}</h1>
                    <p class="lead m-0">{{$article->seo_keywords}}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero End -->

    <!-- Blog STart -->
    <section class="section pt-3 pb-5">
        <div class="container ">
            <div class="row">
                <!-- BLog Start -->
                <div class="col-lg-12 mx-auto">
                    <div class="card shadow-sm rounded-3 position-relative border-0 blog blog-detail ">
                        <div class="container d-flex justify-content-center" >
                            <img src="{{ getArticleImage($article->description_banner) }}" class="img-fluid rounded-top w-100" alt="" style="height: 250px;
                            object-fit: contain;">
                        </div>
                        <div class="card-body content">
                            <p class="text-muted mt-3">
                                {!! ($article->short_description) !!}
                            </p>
                               <p>{!!($article->description)!!}</p>
                        </div>
                    </div>
                 
                </div>
                <!-- BLog End -->

             
            </div><!--end row-->
            
        </div><!--end container-->
    </section><!--end section-->
    <!-- Blog End -->
    
@endsection 