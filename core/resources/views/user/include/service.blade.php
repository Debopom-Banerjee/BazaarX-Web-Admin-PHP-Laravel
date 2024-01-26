<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between mb-2">
                <div>
                    <label for="">Show
                        <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                            <option value="10" {{ $orders->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $orders->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $orders->perPage() == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $orders->perPage() == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        entries
                    </label>
                </div>
                <input type="text" name="search" class="form-control" placeholder="Search" id="search"
                    value="{{ request()->get('search') }}" style="width:unset;">
            </div>
            <div class="table-responsive">
                <table class="table" id="paymentTable">
                    <thead>
                        <tr>
                            {{-- <th>Actions</th> --}}
                            <th>Action</th>
                            <th>ID</th>
                            <th class="pr_col_1">Service</th>
                            <th class="pr_col_2">Price</th>
                            <th class="pr_col_3">Created At</th>
                            
                        </tr>
                    </thead>
                   
                    <tbody>
                        @if($orders->count() > 0)
                        @foreach ($orders as $order)
                            <tr>
                                <td class="pr_col_3">
                                    {{-- <a href="{{route('panel.orders.invoice',$order->id)}}" class="btn btn-outline-primary">Invoice</a> --}}
                                    <a href="{{route('panel.orders.invoice',$order->id)}}" class="btn btn-primary ">
                                        Invoice
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-link" target="_blank" href="{{route('panel.orders.ordershow',$order->id)}}">#OD{{getPrefixZeros($order->id)}}</a>
                                </td>
                                @php
                                  $title =  fetchFirst('App\Models\Service',$order->type_id,'title','');
                                   if($title == null){
                                    $title = 'N/A';
                                   }
                                @endphp
                                <td class="pr_col_1">{{ \Str::words($title,25,'...')}}</td>
                                <td class="pr_col_2">{{format_price($order->total)}}</td>
                                <td class="pr_col_3">{{getFormattedDateTime($order->created_at)}}</td>
                                
                            </tr>
                        @endforeach
                        @else
                          <tr>
                            <td class="text-danger col-12 text-center" colspan="5">Data Not Found !</td>
                          </tr>
                       
                        @endif
                    </tbody> 
                </table>
            </div>
            <div class="text-center mx-auto">
                <a href="{{route('panel.orders.index',['partner_id'=>$user->id])}}" class="btn-link text-center p-3" style="font-size: 15px;">See All Orders</a>
            </div>
        </div>
    </div>
</div>
{{-- <div class="card-footer d-flex justify-content-between">
    <div class="pagination">
        {{ $orders->appends(request()->except('page'))->links() }}
    </div>
    <div>
        @if ($orders->lastPage() > 1)
            <label for="">Jump To:
                <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="jumpTo">
                    @for ($i = 1; $i <= $orders->lastPage(); $i++)
                        <option value="{{ $i }}" {{ $orders->currentPage() == $i ? 'selected' : '' }}>
                            {{ $i }}</option>
                    @endfor
                </select>
            </label>
        @endif
    </div>
</div> --}}