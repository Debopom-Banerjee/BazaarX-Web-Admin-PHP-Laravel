@extends('frontend.layouts.main')

@section('meta_data')
@php
    $meta_title = 'BazaarX Service | '.getSetting('app_name');
    $meta_description = 'BazaarX offers a comprehensive range of AI-powered financial services, including Tax Filings, GST Registration, ITR Filing, MSME Registration, Start-up Funding, Logo Design, Branding, Financial & Marketing Services, Legal Assistance, Software Solutions, Wealth Management, and more. Simplify your finances and grow your business with our affordable and professional services under one roof.' ?? getSetting('seo_meta_description');
    $meta_keywords = 'AI-powered financial services,Financial Services, Marketing Services' ?? getSetting('seo_meta_keywords');
    $meta_motto = '' ?? getSetting('site_motto');
    $meta_abstract = '' ?? getSetting('site_motto');
    $meta_author_name = '' ?? 'Defenzelite';
    $meta_author_email = '' ?? 'support@defenzelite.com';
    $meta_reply_to = '' ?? getSetting('frontend_footer_email');
    $meta_img = ' ';
    // $disableFooter = 1;
@endphp
@endsection
@section('content')
<style>
	.paginate nav a{
		text-decoration: none !important;
	}
	.no-service-found-img{
		width: 30%;
	}
	.mt-40{
		margin-top: 40px;
	}
	@media (max-width: 767px){
		.page{
			display: contents;
		}
	}
	.searchBox{
		margin-top: -12px;
	}
	.fw-800{
		font-weight: 800;
	}
</style>
<div class="container-fluid py-4 py-lg-5 pb-0">
    <div class="row mb-5">
		<div class="col-12 col-md-3 col-lg-3 order-1">
			<div class="mb-0">
				<div class="ml-2">
					<div class="d-flex justify-content-between">
						<h5 class="mb-3 mobile-fs-15">Categories</h5>
						<a href="javascript:void(0)" class="text-theme filter-btn d-lg-none d-block" title="Category Filter">
							<i class="bi bi-funnel fs-22"></i>
						</a>
						<div class="cross-icon d-none text-danger">
							<i class="bi bi-x fs-22"></i>
						</div>
					</div>
					@if (request()->has('search') || request()->has('sub_category_id'))
						<div class="d-lg-none d-block fw-500 service-title text-muted alert alert-light-green p-1">
							<h5 class="mobile-fs-sm-x mb-0 ">
								<div class="text-muted">
									Filter:
									@if (request()->has('search'))
										<span class="text-muted fw-600">{{ request()->get('search') }}</span>
									@elseif(request()->has('sub_category_id'))
										<span class="text-theme fw-600">
											{{ fetchFirst('App\Models\Category',request()->get('sub_category_id'),'name') }}	
										</span>
									@endif
								</div>
							</h5>
						</div>
					@endif
					<ul class="mb-0 list-unstyled category-filter d-lg-block d-none">
						@foreach ($categories as $category)
							<a href="{{ route('search.index',['category_id' => $category->id]) }}" class="d-flex justify-content-between align-items-center mb-0 border text-decoration-none category-list nav-link @if(request()->get('category_id') == $category->id) active show @endif" data-bs-toggle="dropdown" data-category-id="{{ $category->id  }}">
								<div class="d-inline" style="font-size: 17px;font-weight: 600;">
									<img src="{{ asset('storage/backend/category-icon/'.$category->icon) }}" class="category-icon" alt="...">
									{{ ($category->name) }}
								</div>
								@if($category->categories->count() > 0)
									<div class="">
										<i class="bi bi-chevron-right bi-sm"></i>
									</div>
								@endif
							</a>
							<div class="content  @if(request()->get('category_id') == $category->id) active show @endif  @if($category->categories->count() > 0) dropdown-menu categories-dropdown @endif "data-category-id="{{ $category->id  }}">
								@foreach ($category->categories as $sub_category)
									<a href="{{ route('search.index',['category_id' => $category->id,'sub_category_id' => $sub_category->id]) }}" class="d-flex justify-content-between border text-unstyled sub-categories default-category-padding">
										<div class="sub-category-text dropdown-item nav-item pl-0">{{ \Str::limit($sub_category->name,25,'...') }}</div>
										<div class="dots">
											<div class="select-dot">
												<span class="dot @if(request()->has('sub_category_id') && request()->get('sub_category_id') == $sub_category->id) sub-active @endif"></span>
											</div>
										</div>
									</a>
								@endforeach
							</div>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-9 col-lg-9 order-2">
			<div class="d-flex justify-content-between align-items-center searchBox">
				<div class="">
					<small class="text-muted"><i class="bi bi-check2-circle"></i> {{$services->count()}} Results Found</small>
				</div>
				<div class=" col-6">
					<form action="{{ route('search.index') }}" method="get" class="searchForm">
							<div class="d-flex  align-items-center" style="margin-left:40px ">
								<div class="input-group input-group-lg border-0  bg-white shadow-sm rounded-3 "style="margin-left: 30px;
								">
									<span class="input-group-text bg-white border-0"><i class="icofont-search"></i></span>
									<input type="hidden" value="{{request()->get('category_id')}}" name="category_id">
									<input type="hidden" value="{{request()->get('sub_category_id')}}" name="sub_category_id">
									<input value="{{ request()->get('search') }}" name="search" type="text" class="form-control bg-white border-0 ps-0" placeholder="Search by Service Name..." aria-label="Username" aria-describedby="basic-addon1" style="font-size: 1rem;    line-height: 1.5rem;">
								</div>
							</div>
					</form>

				</div>

			</div>
			@if ($services->count() > 0)
				<div class="row row-cols-2 row-cols-md-4 row-cols-lg-4 g-4">
					@foreach ($services as $service)
						@php
							if (is_array($service->document)) {
								$documents = $service->document;
								$service['document'] = collect(App\Models\Category::select('id','name')->whereIn('id', $service->document)->pluck('name')->toArray())->join(', ');
							}
						@endphp	
						<div class="col-3 col-lg-3 col-md-4 col-sm-6 mb-4 ">
							@include('frontend.include.service-card')
						</div>
					@endforeach

					<div class="text-center paginate page mb-40">
						{{ $services->appends(request()->except('page'))->links() }}
					</div>
				</div>
			@else
				<div class="mt-40 mb-40">
					<div class="text-center">
						<img src="{{ asset('frontend/assets/img/icons/no-data-found.jpg') }}" alt="Empty-Image"
						 class="img-fluid no-service-found-img">
						<p class="text-muted">No Services Found</p>
					</div>
				</div>
			@endif
		</div>
    </div>
</div>
<section class="" style="background-color: #f0f5f7">
    <div class="container-fluid p-lg-5 p-3 mt-5">
        <div class="d-flex flex-wrap justify-content-around">
            <div class="">
                <h2 class="fw-bolder text-black">Need to speak with BazaarX expert!</h2>
            </div>
            <div class="">
                <a href="{{ route('contact.index') }}" class="btn btn-success btn-lg">Start free consultation now</a>
            </div>
        </div>
    </div>
</section>
@include('frontend.sections.app')

@include('frontend.modal.product-show-modal')
@endsection
<!-- Add this in the <head> section of your HTML document -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function () {
		$(".category-list").click(function () {
			var categoryId = $(this).data("category-id");
			$(".content[data-category-id=" + categoryId + "]").toggle();
		});
	});
	
</script>

