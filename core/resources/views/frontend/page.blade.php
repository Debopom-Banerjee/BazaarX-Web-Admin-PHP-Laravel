@extends('frontend.layouts.main')

@section('meta_data')
@php
		$meta_title =  ($page->page_meta_title) ? $page->page_meta_title : getSetting('app_name');		
		$meta_description = ($page->page_meta_description) ? $page->page_meta_description : '';		
		$meta_keywords = ($page->page_keywords) ? $page->page_keywords : getSetting('app_name');		
		$meta_motto = (false) ? $page->page_keywords : getSetting('app_name');		
	@endphp
@endsection

@section('content')
    
    <!-- Start Terms & Conditions -->
    <section class="section m-0 p-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 mx-auto">
                    <div class="card border-0 rounded">
                        <div class="card-body">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- End Terms & Conditions -->

    <hr>
    
@endsection