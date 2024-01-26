@extends('frontend.layouts.main')

@section('meta_data')
    @php
		$meta_title = 'Payout Request | '.getSetting('app_name');		
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
                                <h5 class="title mb-0">Payout Requests</h5>
                                <a href="javascript:void(0);"  class="btn btn-primary btn-sm" id="payout-btn">Request</a>
                            </div>

                            {{-- <div class="p-4">
                                <div class="table-responsive bg-white shadow rounded">
                                    <table class="table mb-0 table-center">
                                        <thead>
                                            <tr>
                                            <th scope="col" class="border-bottom">#</th>
                                            <th scope="col" class="border-bottom">Ref ID</th>
                                            <th scope="col" class="border-bottom">Amount</th>
                                            <th scope="col" class="border-bottom">Status</th>
                                            <th scope="col" class="border-bottom">Requested At</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @forelse ($refund_records as $records)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <th scope="row">{{ getWalletHashCode($records->id) }}</th>
                                                    <td>
                                                        <span class="badge bg-{{ getPayoutStatus($records->status)['color']}}">
                                                            {{ getPayoutStatus($records->status)['name']}}</span>
                                                    </td>
                                                    <td>{{ format_price($records->amount) }}</td>
                                                    <td>{{ getFormattedDate($records->created_at) }}</td>
                                                </tr>
                                            @empty 
                                                <td>
                                                    <td colspan="5" class="text-center">No Records!</td>
                                                </td>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}

                            @forelse ($refund_records as $records)
                                <div class="border-bottom  p-3">
                                    <a href="#">
                                        <div class="d-flex ms-2">
                                            <i class="uil uil-envelope h5 align-middle me-2 mb-0"></i>
                                            <div class="ms-3">
                                               <div class="d-flex justify-content-between">
                                                   <div>
                                                       <h6 class="text-dark mb-0">{{ getWalletHashCode($records->id) }}</h6>
                                                   </div>
                                                   <div style="position: absolute;right: 45px;">
                                                       <span class="badge bg-{{ getPayoutStatus($records->status)['color']  }}">{{ getPayoutStatus($records->status)['name']  }}</span>
                                                   </div>
                                               </div>
                                                <small class="text-muted d-block">Raised On {{ getFormattedDate($records->created_at) }} </small>
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
 @include('frontend.modal.create-payout')
@endsection
@push('script')
   <script>
    $('#payout-btn').on('click',function(){
        $('#add-payout-modal').modal('show');
    });
   </script>
@endpush