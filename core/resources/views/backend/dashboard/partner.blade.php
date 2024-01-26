@php
    $user_kyc = App\Models\UserKyc::where('user_id',auth()->id())->first();
    $accountDetails = App\Models\BankDetail::where('user_id',auth()->id())->get();
    $statistics_1 = [
        [ 'a' => route('panel.orders.index'),'name'=>'Total Orders','bg_color'=>'bg-primary', "count"=>App\Models\Order::where('partner_id',auth()->id())->count(),
        "icon"=>"<i class='ik ik-shopping-bag'></i>" ,'col'=>'3', 'color'=> 'primary'],

        [ 'a' => route('panel.orders.index',['today'=>'order']),'name'=>"Today's Order",'bg_color'=>'bg-success', "count"=>App\Models\Order::where('partner_id',auth()->id())->whereDate('created_at','=',now())->count(),
        "icon"=>"<i class='ik ik-shopping-cart'></i>" ,'col'=>'3', 'color'=> 'primary'],
        [ 'a' => '#','name'=>'Total Earnings', 'bg_color'=>'bg-warning',"count"=>format_price(getTotalEarningsByPartnerId(auth()->id())), "icon"=>"<i
        class='ik ik-dollar-sign f-24 text-mute'></i>" ,'col'=>'3', 'color'=> 'primary'],
     ];
    $statistics_2 = [
        [ 'a' => 'javascript:void(0)','name'=>'On Going','text-color'=>1, "count"=>App\Models\Order::whereNotIn('status',[3,4])->where('partner_id',auth()->id())->count(),
        "icon"=>"<i class='ik ik-play f-24'></i>" ,'col'=>'3', 'color'=> 'primary',"value"=>0],
        [ 'a' => 'javascript:void(0)','name'=>orderStatus(1)['name'],'text-color'=>1, "count"=>App\Models\Order::where('status','=',1)->where('partner_id',auth()->id())->count(),
        "icon"=>"<i class='ik ik-zap f-24'></i>" ,'col'=>'3', 'color'=> 'primary',"value"=>1],
        [ 'a' => 'javascript:void(0)','name'=>orderStatus(2)['name'], 'text-color'=>1,"count"=>App\Models\Order::where('status','=',2)->where('partner_id',auth()->id())->count(), "icon"=>"<i
            class='ik ik-file f-24 text-mute'></i>" ,'col'=>'3', 'color'=> 'primary',"value"=>2],
        [ 'a' => 'javascript:void(0)','name'=>orderStatus(3)['name'],'text-color'=>1, "count"=>App\Models\Order::where('status','=',3)->where('partner_id',auth()->id())->count(), "icon"=>"<i
            class='ik ik-zap-off f-24 text-mute'></i>" ,'col'=>'3', 'color'=> 'red',"value"=>3],
        [ 'a' => 'javascript:void(0)','name'=>orderStatus(4)['name'],'text-color'=>1, "count"=>App\Models\Order::where('status','=',4)->where('partner_id',auth()->id())->count(), 
        "icon"=>"<i class='ik ik-check-circle f-24'></i>" ,'col'=>'3', 'color'=> 'red',"value"=>4],

    ];
@endphp
<div class="row">
    <div class="col-12">
        @if(isset($user_kyc) && $user_kyc->status == App\User::KYC_APPROVED)
            {{-- <div class="fw-700 alert alert-info">
                Congratulations! Your account has been verified.
            </div> --}}
        @elseif(isset($user_kyc) && $user_kyc->status == App\User::KYC_REJECTED)
            <div class="fw-700 alert alert-light mb-2">
                <span style="line-height: 2" class="fw-700">
                    <i class="ik ik-alert-triangle text-danger fa-lg"></i> The Account Verification request you sent has been rejected! Due to: {{json_decode($user_kyc->details,true)['admin_remark'] ?? ''}}
                </span>
                <a href="{{route('panel.user.profile',['active'=>'eKyc'])}}" type="button" class="btn float-right btn-outline-warning btn-sm ml-2 ">Resubmit Request</a>
            </div>
        @elseif(isset($user_kyc) && $user_kyc->status == App\User::KYC_PENDING)
            <div class="fw-700 alert alert-light mb-2">
                <i class="ik ik-alert-triangle text-danger fa-lg"></i> Your verification request has been successfully processed. Our verification team will be in touch within 48 hours.
            </div>
        @else 
            <div class="fw-700 alert alert-light mb-2 py-2">
                <span style="line-height: 2" class="fw-700">
                    <i class="ik ik-alert-triangle text-danger fa-lg"></i> To start using GoFinx, please complete the account verification step
                </span>
                <a href="{{route('panel.user.profile',['active'=>'eKyc'])}}" type="button" class="btn float-right btn-outline-info btn-sm ml-2 ">Complete Verification</a>
            </div>    
        @endif
    </div>
    @if($accountDetails->count() <= 0)
        <div class="col-12">
            <div class="alert alert-light mb-2 py-2">
                <span style="line-height: 2" class="fw-700">
                    <i class="ik ik-alert-triangle text-danger fa-lg"></i> In order to receive orders from BazaarX and receive payouts, please complete the Bank Account submission form.
                </span>
                <a href="{{route('panel.partner.account.create')}}" type="button" class="btn float-right btn-outline-danger btn-sm ml-2 ">Add Account</a>
            </div>
        </div>
    @endif
</div>
    <div class="row clearfix">
        @foreach ($statistics_1 as $item_1)
            <a class="col-lg-4 col-md-6 col-sm-12" href="{{ $item_1['a'] }}">
                <div class="widget {{ $item_1['bg_color'] }}">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>{{ $item_1['name'] }}</h6>
                                <h2>{{ $item_1['count'] }}</h2>
                            </div>
                            <div class="icon">
                                {!! $item_1['icon'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
        
    </div>
        <div class="container-fluid p-0">
            <h4>Order Milestone</h4>
        </div>
    <div class="row pp-main mb-0">
        @foreach ($statistics_2 as $item_2)
            <div class="col-lg col-md col-sm-12">
                <a href="{{$item_2['a']}}" class="card card-body">
                    <div class="pp-cont">
                        <div class="row align-items-center mb-20">
                            <div class="col-auto">
                                {!! $item_2['icon'] !!}
                            </div>
                            <div class="col text-right">
                                <h2 class="mb-0 text-primary">{{ $item_2['count'] }}</h2>
                            </div>
                        </div>
                        <div class="row align-items-center mb-15">
                            <div class="col-auto">
                                {{-- <p class="mb-0 text-dark" style="font-size: 15px;">{{ $item_2['name'] }}</p> --}}
                                <p class="mb-0 text-dark" style="font-size: 15px;">{{ $item_2['name'] }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="row">
        <!-- top contact and member performance start -->
        <div class="col-xl-12 col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h3>{{ __('My Orders')}}</h3>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="ik ik-chevron-left action-toggle"></i></li>
                            <li><i class="ik ik-minus minimize-card"></i></li>
                            <li><i class="ik ik-x close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="no-export">Actions</th>
                                    <th  class="no-export">OID <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                                    <th class="col_1">Customer </th>                       
                                    {{-- <th class="col_2">Txn No</th> --}}
                                    <th class="col_2">Service</th>
                                    <th class="col_6">Amount</th> 
                                    <th class="col_7">Status</th>
                                    <th class="col_7">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total = 0;
                            @endphp
                            @if($orders->count() > 0)
                                @foreach($orders as  $order)
                                    <tr>
                                        @php
                                            $service = App\Models\Service::whereId($order->type_id)->first();
                                            
                                        @endphp
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="no-export">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                                    <li class="dropdown-item p-0"><a href="{{ route('panel.orders.show', $order->id) }}" title="Show Order" class="btn btn-sm">Summary</a></li>
                                                    <li class="dropdown-item p-0"><a href="{{ route('panel.orders.invoice', $order->id) }}" title="Invoice" target="_blank" class="btn btn-sm">Invoice</a></li>
                                                </ul>
                                            </div> 
                                        </td>
                                        <td> <a href="{{ route('panel.orders.ordershow', $order->id) }}" class="btn btn-link p-0">#OD{{  getPrefixZeros($order->id) }}</a></td>
                                        <td class="col_1">{{fetchFirst('App\User',$order->user_id,'name','--')}}</td>
                                        {{-- <td class="col_2">{{$order->txn_no }}</td> --}}
                                        <td>
                                            {{\Str::words($service->title ?? 'N/A',2,'...')}}
                                        </td> 
                                        <td class="col_6">{{format_price($order->total) }}</td>
                                        <td class="col_7"><div class="badge badge-{{ orderStatus($order->status)['color'] }}">{{orderStatus($order->status)['name'] }}</div></td>
                                        
                                        <td>{{ getFormattedDateTime($order->created_at) }}</td>
                                        @php
                                        $total += $order->total;
                                        @endphp
                                    </tr>
                                @endforeach
                            @else 
                                <tr>
                                    <td class="text-center text-danger" colspan="15">No Data Found !</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 pl-5">
                        {{ $orders->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
        
    </div>