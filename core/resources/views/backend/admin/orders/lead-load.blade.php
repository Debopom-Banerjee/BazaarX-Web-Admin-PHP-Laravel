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
            {{-- <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility</button>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                        <li class="dropdown-item p-0 col-btn" data-val="col_1"><a href="javascript:void(0);"  class="btn btn-sm">User  </a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_2"><a href="javascript:void(0);"  class="btn btn-sm">Txn No</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_3"><a href="javascript:void(0);"  class="btn btn-sm">Discount</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_4"><a href="javascript:void(0);"  class="btn btn-sm">Tax</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_5"><a href="javascript:void(0);"  class="btn btn-sm">Sub Total</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_6"><a href="javascript:void(0);"  class="btn btn-sm">Total</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_7"><a href="javascript:void(0);"  class="btn btn-sm">Status</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_8"><a href="javascript:void(0);"  class="btn btn-sm">Payment Gateway</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_9"><a href="javascript:void(0);"  class="btn btn-sm">Remarks</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_10"><a href="javascript:void(0);"  class="btn btn-sm">From</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_11"><a href="javascript:void(0);"  class="btn btn-sm">To</a></li>                                    </ul>
                <a href="javascript:void(0);" id="print" data-url="{{ route('panel.orders.print') }}"  data-rows="{{json_encode($orders) }}" class="btn btn-primary btn-sm">Print</a>
            </div> --}}
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="table" class="table" style="width: 115%;">
                <thead>
                    <tr>
                        <th class="col-1">#</th>
                        <th class="no-export col-2">Actions</th>
                        <th  class="no-export col-1">Lead ID </th>
                        <th class="col-2">Customer </th>
                        <th class="col-2">Phone</th>
                        <th class="col-1">Amount 
                            <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div>
                        </th>
                        <th class="col-2">Payment Status</th>
                        <th class="col-7">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    {{-- @dd($orders) --}}
                    @if($orders->count() > 0)
                         @foreach($orders as  $order)
                            <tr>
                                @php
                                    $service = App\Models\Service::whereId($order->type_id)->first();

                                @endphp
                                <td class="col-1">{{ $loop->iteration }}</td>
                                <td class="no-export col-2">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <li class="dropdown-item p-0"><a href="{{ route('panel.orders.show', $order->id) }}" title="Show Order" class="btn btn-sm">Summary</a></li>
                                            <li class="dropdown-item p-0"><a href="{{ route('panel.orders.invoice', $order->id) }}" title="Invoice" target="_blank" class="btn btn-sm">Invoice</a></li>
                                            {{-- <li class="dropdown-item p-0"><a href="{{ route('user-portfolio', $order->id) }}" title="Invoice" target="_blank" class="btn btn-sm">User Portfolio</a></li> --}}
                                        </ul>
                                    </div>
                                </td>
                                <td class="col-1">
                                    <div class="d-flex align-items-center">
                                        @if($order->case_workstream && @$order->case_workstream->message->user->id == $order->user_id)
                                            <span style="display: block; margin-right: 12px; height: 7px; width: 7px; border-radius: 50%; background-color: #fb6340;"></span>
                                        @endif
                                        <a href="{{ route('panel.orders.ordershow',[$order->id,'active' => 'chat']) }}" class="btn btn-link p-0 h-auto">#OD{{  getPrefixZeros($order->id) }}</a>

                                    </div>
                                </td>
                                <td class="col-2"><a class="btn-link" href="{{route('panel.users.show',$order->user_id)}}">{{fetchFirst('App\User',$order->user_id,'name','--')}}</a>
                                </td>
                                  <td class="col-2">{{$order->user->phone ?? '--'}}</td>
                                  <td class="col-2">{{format_price($order->total) }}</td>
                                  <td class="col-2"><span class="text-{{paymentStatus($order->payment_status)['color'] }} fw-600">{{paymentStatus($order->payment_status)['name'] }}</span></td>
                                  <td>{{ getFormattedDateTime($order->created_at) }}</td>
                                
                                  @php
                                   $total += $order->total;
                                @endphp
                            </tr>
                        @endforeach
                        <tr class="bg-primary">
                            <td colspan="8" class="font-weight-bold text-white" style="text-align:center;">Total :  {{format_price($total)}}</td>
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
