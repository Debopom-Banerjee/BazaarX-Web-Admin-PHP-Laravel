@extends('frontend.layouts.main')

@section('meta_data')
    @php
		$meta_title = 'Wallet | '.getSetting('app_name');		
		$meta_description = '' ?? getSetting('seo_meta_description');
		$meta_keywords = '' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');		
		$meta_abstract = '' ?? getSetting('site_motto');		
		$meta_author_name = '' ?? 'Defenzelite';		
		$meta_author_email = '' ?? 'support@defenzelite.com';		
		$meta_reply_to = '' ?? getSetting('frontend_footer_email');		
		$meta_img = ' ';		
		$customer = 1;		
	@endphp
@endsection

@section('content')
    <!-- Hero Start -->
    <section class="bg-profile d-table w-100 bg-primary" style="background: url('assets/images/account/bg.png') center center;">
        <div class="container">
            @include('frontend.customer.include.profile-header')
        </div><!--ed container-->
    </section><!--end section-->
    <!-- Hero End -->

    <!-- Profile Start -->
    <section class="section mt-60">
        <div class="container mt-lg-3">
            <div class="row">
                @include('frontend.customer.include.sidebar')
                <div class="col-lg-8 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="component-wrapper rounded shadow">
                                <div class="p-4 border-bottom d-flex justify-content-between">
                                    <h5 class="title mb-0"> Wallet Logs</h5>
                                    <a href="#"  class="btn btn-primary btn-sm wallet-recharge" id="addMoneyToWalley">Recharge</a>
                                </div>
    
                                @forelse ($wallet_logs as $logs)
                                <div class="border-bottom  p-3">
                                    <a href="#">
                                        <div class="d-flex ms-2">
                                            <i class="uil uil-envelope h5 align-middle me-2 mb-0"></i>
                                            <div class="ms-3">
                                               <div class="d-flex justify-content-between">
                                                   <div>
                                                       <h6 class="text-dark mb-0">{{ getWalletHashCode($logs->id) }}</h6>
                                                   </div>
                                                   <div style="position: absolute;right: 45px;">
                                                       <span class="badge bg-{{ getTransactionType($logs->type)['color']  }}">{{ getTransactionType($logs->type)['name']  }}</span>
                                                   </div>
                                               </div>
                                                
                                                <small class="text-muted d-block">Raised On {{ getFormattedDate($logs->created_at) }} </small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @empty
                                    <div class="text-center mx-auto">
                                        <p>No Records!</p>
                                    </div>
                                @endforelse    
                            </div>
                        </div>
                    </div>
                 </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- Profile End -->
    @include('frontend.modal.add-wallet')
@endsection


@push('script')
<script>
    $(document).ready(function(){
        $('#addMoneyToWalley').on('click',function(){
            $('#add-wallet-modal').modal('show');
        });
    });
</script>
   
@endpush