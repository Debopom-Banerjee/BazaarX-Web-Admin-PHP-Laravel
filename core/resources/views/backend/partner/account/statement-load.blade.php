<div class="card-body">
    <div class="d-flex justify-content-between mb-2">
        <div>
            <label for="">Show
                <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                    <option value="10"{{$payments->perPage() == 10 ? 'selected' : ''}}>10</option>
                    <option value="25"{{$payments->perPage() == 25 ? 'selected' : ''}}>25</option>
                    <option value="50"{{ $payments->perPage() == 50 ? 'selected' : ''}}>50</option>
                    <option value="100"{{ $payments->perPage() == 100 ? 'selected' : ''}}>100</option>
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
                    <th class="w-20">Sno  </th>
                    <th class="w-20">Month  </th>
                    <th class="w-15">Partner Name</th>
                    <th class="w-15">User</th>
                    <th class="w-15">Order ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Razor Id|Remark</th>
                    <th style="width: 30%">Created At</th>
                    <th class="w-20">Payout Date</th>
                    <th class="w-20">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($payments->count() > 0)
                     @foreach($payments as $payment)
                            <td>{{$loop->iteration}}</td>
                            <td> 
                                {{ $payment->month }} 
                            </td>
                            <td>    
                                @if($payment->user_id)
                                    <a href="{{route('panel.users.show',$payment->user_id)}}" class="btn btn-link text-dark">{{ NamebyId($payment->user_id) ?? '--'}}</a>
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                {{ @$payment->user->name ?? '--' }} #UID{{(@$payment->user->id)}}
                                <hr class="p-0 m-1">
                                <span class="text-muted">
                                    {{@$payment->user->bankDetail->name ?? '--'}} - {{substr(@$payment->user->bankDetail->accountNumber, 4) ?? '--'}}
                                </span>
                            </td>
                             <td> 
                                <a class="btn btn-link p-1" href="{{ route('panel.orders.ordershow',[$payment->order_id,'active' => 'milestone']) }}"
                                >#OD{{ $payment->order_id }}</a>
                            </td>
                              <td> 
                                {{ format_price($payment->amount) }}
                            </td>
                              <td> 
                               <span class="badge badge-{{getPaymentStatus($payment->status)['color']}}">{{getPaymentStatus($payment->status)['name']}}</span>
                            </td>
                              <td> 
                               {{ $payment->r_payment_id ?? '--' }}
                               <hr class="m-1">
                               {{ $payment->remark ?? '--' }}
                            </td>
                              <td class="w-25"> 
                               {{ $payment->created_at ?? '--' }}
                            </td>
                            </td>
                              <td> 
                               {{ $payment->payout_date ?? '--' }}
                            </td>
                            <td>
                                @if($payment->status == 0 || $payment->status == 3)
                                    <a href="{{route('panel.payment.approve',[$payment->id,'status' => 1])}}" class="btn btn-success confirm">Approve</a>
                                @endif
                                @if($payment->status == 0 || $payment->status == 1)
                                    @if($payment->status == 1)
                                        <a href="{{ route('panel.payment.force-pay',$payment->id) }}" class="btn btn-info confirm">Force Pay</a>
                                    @endif
                                    <a href="javascript:void(0)" data-toggle="modal" data-id="{{$payment->id}}" data-target="#rejeactPayment" class="btn btn-danger rejeactBtn mt-2">Cancel Payment</a>
                                @endif
                            </td>
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
</div>
<div class="card-footer d-flex justify-content-between">
    <div class="pagination">
        {{ $payments->appends(request()->except('page'))->links() }}
    </div>
    <div>
       @if($payments->lastPage() > 1)
            <label for="">Jump To: 
                <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                    @for ($i = 1; $i <= $payments->lastPage(); $i++)
                        <option value="{{ $i }}" {{ $payments->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </label>
       @endif
    </div>
</div>