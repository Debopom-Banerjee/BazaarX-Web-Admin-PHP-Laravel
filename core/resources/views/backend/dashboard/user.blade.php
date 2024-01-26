@php
        $statistics_2 = [
    [ 'a' => 'javascript:void(0)','name'=>'On Going','text-color'=>1, "count"=>App\Models\Order::whereNotIn('status',[3,4])->where('user_id',auth()->id())->count(),
    "icon"=>"<i class='ik ik-play f-24'></i>" ,'col'=>'3', 'color'=> 'primary',"value"=>0],
    [ 'a' => 'javascript:void(0)','name'=>orderStatus(1)['name'],'text-color'=>1, "count"=>App\Models\Order::where('status','=',1)->where('user_id',auth()->id())->count(),
    "icon"=>"<i class='ik ik-zap f-24'></i>" ,'col'=>'3', 'color'=> 'primary',"value"=>1],
    [ 'a' => 'javascript:void(0)','name'=>orderStatus(2)['name'], 'text-color'=>1,"count"=>App\Models\Order::where('status','=',2)->where('user_id',auth()->id())->count(), "icon"=>"<i
        class='ik ik-file f-24 text-mute'></i>" ,'col'=>'3', 'color'=> 'primary',"value"=>2],
    [ 'a' => 'javascript:void(0)','name'=>orderStatus(3)['name'],'text-color'=>1, "count"=>App\Models\Order::where('status','=',3)->where('user_id',auth()->id())->count(), "icon"=>"<i
        class='ik ik-zap-off f-24 text-mute'></i>" ,'col'=>'3', 'color'=> 'red',"value"=>3],
    [ 'a' => 'javascript:void(0)','name'=>orderStatus(4)['name'],'text-color'=>1, "count"=>App\Models\Order::where('status','=',4)->where('user_id',auth()->id())->count(), 
    "icon"=>"<i class='ik ik-check-circle f-24'></i>" ,'col'=>'3', 'color'=> 'red',"value"=>4],

    ];
@endphp

    <div class="container-fluid p-0">
        <h4>Order Milestone</h4>
    </div>
    <div class="row pp-main">
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
                                <!--<th class="col_1">Customer </th>                       -->
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
                                                <li class="dropdown-item p-0"><a href="{{ route('panel.orders.show',[ $order->id]) }}" title="Show Order" class="btn btn-sm">Summary</a></li>
                                                <li class="dropdown-item p-0"><a href="{{ route('panel.orders.invoice', $order->id) }}" title="Invoice" target="_blank" class="btn btn-sm">Invoice</a></li>
                                            </ul>
                                        </div> 
                                    </td>
                                      <td> <a href="{{ route('panel.orders.ordershow',[$order->id,'active'=>'chat']) }}" class="btn btn-link p-0">#OD{{  getPrefixZeros($order->id) }}</a></td>
                                      <!--<td class="col_1">{{fetchFirst('App\User',$order->user_id,'name','--')}}</td>-->
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

                {{ $orders->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
    
</div>