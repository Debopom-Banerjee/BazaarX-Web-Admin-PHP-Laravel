
    <div class="d-flex justify-content-between mb-2">
        <div>
            <label for="">Show
                <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                    <option value="10" {{ $users->perPage() == 10 ? 'selected' : ''}}>10</option>
                    <option value="25" {{ $users->perPage() == 25 ? 'selected' : ''}}>25</option>
                    <option value="50" {{ $users->perPage() == 50 ? 'selected' : ''}}>50</option>
                    <option value="100" {{ $users->perPage() == 100 ? 'selected' : ''}}>100</option>
                </select>
                entries
            </label>
        </div>
        <div>
            <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility</button>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                <li class="dropdown-item p-0 col-btn" data-val="col_1"><a href="javascript:void(0);"  class="btn btn-sm">S No.</a></li>
                <li class="dropdown-item p-0 col-btn" data-val="col_2"><a href="javascript:void(0);"  class="btn btn-sm">Customer (Affiliate)</a></li>
                <li class="dropdown-item p-0 col-btn" data-val="col_3"><a href="javascript:void(0);"  class="btn btn-sm">Service</a></li>
                <li class="dropdown-item p-0 col-btn" data-val="col_4"><a href="javascript:void(0);"  class="btn btn-sm">Transaction Id</a></li>
                <li class="dropdown-item p-0 col-btn" data-val="col_5"><a href="javascript:void(0);"  class="btn btn-sm">Razorpay Payment Id</a></li>
                <li class="dropdown-item p-0 col-btn" data-val="col_6"><a href="javascript:void(0);"  class="btn btn-sm">Transaction Type</a></li>
                <li class="dropdown-item p-0 col-btn" data-val="col_7"><a href="javascript:void(0);"  class="btn btn-sm">Affiliated To (User)</a></li>
                <li class="dropdown-item p-0 col-btn" data-val="col_8"><a href="javascript:void(0);"  class="btn btn-sm">Amount</a></li>
                <!--<li class="dropdown-item p-0 col-btn" data-val="col_9"><a href="javascript:void(0);"  class="btn btn-sm">Status</a></li>-->
            </ul>
            <a href="javascript:void(0);" id="print_page" data-url="{{ route('panel.users.print.balance') }}" data-rows="{{ json_encode($users) }}" class="btn btn-primary btn-sm">Print</a>
        </div>
        <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
    </div>
        <div class="table-responsive">
            <table id="user_table" class="table p-0">
                <thead>
                    <tr>
                        <th class="col_1 text-center no-export">{{ __('S No.')}}</th>
                        {{--<th class="col_2 no-export">{{ __('Action')}}</th>--}}
                        <th class="col_2">{{ __('Customer (Affiliate)')}}</th>
                        <th class="col_3">{{ __('Service')}}</th>
                        <th class="col_4">{{ __('Transaction Id')}}</th>
                        <th class="col_5">{{ __('Razorpay Payment Id')}}</th>
                        <th class="col_6">{{ __('Transaction Type')}}</th>
                        <th class="col_7">{{ __('Affiliated To (User)')}}</th>
                        <th class="col_8">{{ __('Amount')}}<div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="amount"></i><i class="ik ik ik-arrow-down desc" data-val="amount"></i></div></th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <!--<th class="col_9">{{ __('Status')}}</th>-->
                    </tr>
                </thead>
                <tbody>
                    @if($users->count() > 0)
                        @foreach ($users as $item)
                        <tr>
                            <td class="col_1 text-center no-export">{{ $loop->iteration }}</td>
                            <td class="col_2"><a class="btn btn-link p-0 m-0" href="{{route('panel.users.show', $item->user_id)}}">{{ $item->name }}</a></td>
                            <td class="col_3">{{ $item->title }}</td>
                            <td class="col_4">{{ $item->txn_id }}</td>
                            <td class="col_5">{{ $item->razorpayPaymentId }}</td>
                            <td class="col_6">{{ $item->type }}</td>
                            <td class="col_7"><a class="btn btn-link p-0 m-0" href="{{route('panel.users.show', $item->affiliated_id)}}">{{ $item->affiliated_by }}</a></td>
                            <td class="col_8">{{ format_price($item->amount) }}</td>
                            <td class="col_8">{{ ($item->created_at) }}</td>
                            <td class="col_8">{{ ($item->updated_at) }}</td>
                            <!--<td class="col_9">{{ $item->razorpayStatus }}</td>-->
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="8">No Data Found...</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

    <div class="card-footer d-flex justify-content-between">
        <div class="pagination">
            {{ $users->appends(request()->except('page'))->links() }}
        </div>
        <div>
            @if($users->lastPage() > 1)
                <label for="">Jump To:
                    <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                            <option value="{{ $i }}" {{ $users->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
            @endif
        </div>
    </div>
    
