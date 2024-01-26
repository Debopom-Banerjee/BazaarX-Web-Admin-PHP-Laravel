<div class="card-body">
    <div class="d-flex justify-content-between mb-2">
        <div>
            <label for="">Show
                <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                    <option value="10"{{ $orders->perPage() == 10 ? 'selected' : ''}}>10</option>
                    <option value="25"{{ $orders->perPage() == 25 ? 'selected' : ''}}>25</option>
                    <option value="50"{{ $orders->perPage() == 50 ? 'selected' : ''}}>50</option>
                    <option value="100"{{ $orders->perPage() == 100 ? 'selected' : ''}}>100</option>
                </select>
                entries
            </label>
        </div>
        <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
    </div>
    <div class="table-responsive">
        <table id="table" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="no-export">Actions</th>
                    <th  class="no-export">OID </th>
                    <th class="col_1">Customer </th>
                    @if(AuthRole() == 'Admin') 
                        <th class="col_1">Phone</th>
                    @endif 
                    <th  style="width: 250px !important" class="col_2">Service</th>
                    <th class="col_2">Source</th>
                    <th class="col_2">Partner</th>
                    <th class="" style="padding: 0px 0px 13px 0px;">Amount 
                        <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div>
                    </th>
                    @if(AuthRole() == 'Admin') 
                        <th class="col_6"> <span title="Total Patner Commission">TPC</span> </th>
                        <th class="col_6"> <span title="Paid Patner Commission">PPC</span></th>
                        <th class="col_6"> <span title="Due Patner Commission">DPC</span></th>
                    @endif
                    <th class="col_6">Payment Status</th>
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
                                        <li class="dropdown-item p-0"><a href="{{ route('panel.orders.show',[$order->id,'active'=>'chat']) }}" title="Show Order" class="btn btn-sm">Summary</a></li>
                                        <li class="dropdown-item p-0"><a href="{{ route('panel.orders.invoice', $order->id) }}" title="Invoice" target="_blank" class="btn btn-sm">Invoice</a></li>
                                        
                                        @if(($order->payment_status) == 1)
                                            <li class="dropdown-item p-0"><a href="{{ route('panel.orders.update-payment-status', $order->id) }}" title="Mark as Paid" class="btn btn-sm mark-as-paid">Mark as Paid</a></li>
                                        @endif
                                        @if(($order->payment_status) == 2)
                                            <li class="dropdown-item p-0"><a href="{{ route('panel.orders.update-payment-status', $order->id) }}" title="Mark as Unpaid" class="btn btn-sm mark-as-unpaid">Mark as Unpaid</a></li>
                                        @endif
                                        <li class="dropdown-item p-0"><a href="{{ route('user-portfolio', $order->id) }}" title="Invoice" target="_blank" class="btn btn-sm">User Portfolio</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($order->case_workstream && @$order->case_workstream->message->user->id == $order->user_id)
                                        <span style="display: block; margin-right: 12px; height: 7px; width: 7px; border-radius: 50%; background-color: #fb6340;"></span>
                                    @endif
                                    <a href="{{ route('panel.orders.ordershow',[$order->id,'type'=> request()->get('type'),'active' => 'chat']) }}" class="btn btn-link p-0 h-auto">#OD{{  getPrefixZeros($order->id) }}</a>

                                </div>
                            </td>
                            <td class="col_1"><a class="btn-link" href="{{route('panel.users.show',$order->user_id)}}">{{fetchFirst('App\User',$order->user_id,'name','--')}}</a>
                            </td>
                            @if(AuthRole() == 'Admin') 
                                <td class="col_2">{{$order->user->phone ?? ''}}
                                </td>
                            @endif
                            <td>
                                {{isset($service->title) ? $service->title :''}}
                            </td>
                            <td>
                                {{$service->source ?? '--'}}
                            </td>
                            <td>
                                <a class="btn-link" href="{{route('panel.users.show',$order->partner_id ?? '')}}"> {{NameById($order->partner_id)}}</a>
                            </td>
                              <td class="col_6">{{format_price($order->total) }}</td>
                             
                              @if (AuthRole() == 'Admin')
                                <td>{{format_price($order->totalPartnerCommision)}}</td>

                                
                                <td>{{format_price($order->paymentTransferAmt)}}</td>
                                
                                <td>{{format_price(($order->totalPartnerCommision) - ($order->paymentTransferAmt))}}</td>
                              @endif

                              <td class="col_6"><span class="text-{{paymentStatus($order->payment_status)['color'] }} fw-600">{{paymentStatus($order->payment_status)['name'] }}</span></td>
                              <td class="col_7"><div class="badge badge-{{ orderStatus($order->status)['color'] }}">{{orderStatus($order->status)['name'] }}</div></td>
                            
                              <td>{{ getFormattedDateTime($order->created_at) }}</td>
                              @php
                               $total += $order->total;
                            @endphp
                        </tr>
                    @endforeach
                    <tr class="bg-primary">
                        <td colspan="8" style="text-align: end;" class="font-weight-bold text-white">Total :</td>
                        <td colspan="8" class="font-weight-bold text-white" style="text-align: start;">{{format_price($total)}}</td>
                    </tr>
                @else
                    <tr>
                        <td class="text-center text-danger" colspan="15">No Data Found !</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="card-footer d-flex justify-content-between">
    <div class="pagination">
        {{ $orders->appends(request()->except('page'))->links() }}
    </div>
    <div>
       @if($orders->lastPage() > 1)
            <label for="">Jump To:
                <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                    @for ($i = 1; $i <= $orders->lastPage(); $i++)
                        <option value="{{ $i }}" {{ $orders->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </label>
       @endif
    </div>
</div>
