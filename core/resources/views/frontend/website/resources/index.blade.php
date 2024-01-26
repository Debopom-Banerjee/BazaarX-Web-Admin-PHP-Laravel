@extends('frontend.layouts.main')

@section('meta_data')
    @php
		$meta_title = 'Resources'.' | '.getSetting('app_name');		
		$meta_description = '-'?? getSetting('seo_meta_description');
		$meta_keywords = '-'.'' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');		
		$meta_abstract = '' ?? getSetting('site_motto');		
		$meta_author_name = '' ?? 'Defenzelite';		
		$meta_author_email = '' ?? 'support@defenzelite.com';		
		$meta_reply_to = '' ?? getSetting('frontend_footer_email');		
		$meta_img = ' ';		
	@endphp
@endsection

<style>
    @media (max-width: 768px){
        .section {
            padding: 35px 0;
        }
        
    }
    a{
        text-decoration: none !important;
    }
</style>
@section('content')
<section class="pt-5 blog-img">
    <div class="container py-5 px-5">
        <div class="row gx-5">
            <div class="col-lg-12">
                <h1 class="display-6 mb-2 w-50">Resources</h1>
                <p class="lead m-0">FinXpert Insights: Your Guide to Financial Empowerment</p>
            </div>
        </div>
    </div>
</section>
    <!-- Blog STart -->
    <div class="container py-5">
        <div class="row">
            @forelse ($articles as $article)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card shadow-sm rounded-3 position-relative border-0 mb-4" style="min-height: 275px;">
                    <div class="card-body">
                        <a href="{{ route('article.show',$article->slug) }}" class="text-dark">
                            <img src="{{ getArticleImage($article->description_banner) }}" class="card-img-top w-100" alt="...">
                            <div class="listing-card-body pt-3">
                                <h6 class="card-title fw-bold mb-1">{{ $article->title }}</h6>
                                <div class="d-flex align-items-center">
                                    <small class="me-auto">
                                        <i class="bi bi-clock me-1"></i>{{ getFormattedDate($article->created_at) }}
                                    </small>
                                </div>
                                    {{-- <p class="mb-0">{!! Str::words($article->short_description,5) !!}</p> --}}
                                <div class="post-meta d-flex justify-content-between mt-3">
                                    <a href="{{ route('article.show',$article->slug) }}" class="text-success ">Read More <i class="fs-13 bi bi-chevron-compact-right text-success "></i></a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div><!--end col-->
            </div>
            @empty
                @php
                    $empty_msg = 'No Articles yet!';
                @endphp
                <div class="col-lg-8 mx-auto text-center">
                    @include('frontend.empty')
                </div>
            @endforelse
        </div><!--end row-->

        <div class="text-center paginate">
            {{ $articles->appends(request()->except('page'))->links() }}
        </div>
        {{-- <div class="mx-auto d-block mt-5">
            <!-- PAGINATION START -->
            {{ $articles->links() }}
            <!-- PAGINATION END -->
        </div>   --}}
    </div><!--end container-->
    <!-- Blog End -->
@endsection