@extends('backend.layouts.empty') 
@section('title', 'User')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive">
                    <table id="user_table" class="table p-0">
                        <thead>
                            <tr>
                                <th class="col_2">{{ __('Customer')}}</th>
                                <th class="col_3">{{ __('Service')}}</th>
                                <th class="col_4">{{ __('Transaction Id')}}</th>
                                <th class="col_5">{{ __('Razorpay Payment Id')}}</th>
                                <th class="col_6">{{ __('Transaction Type')}}</th>
                                <th class="col_7">{{ __('Affiliated By')}}</th>
                                <th class="col_8">{{ __('Amount')}}</th>
                                <!--<th class="col_9">{{ __('Status')}}</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @if($users->count() > 0)
                                @foreach ($users as $item)
                                <tr>
                                    <td class="col_2">{{ $item['name'] }}</td>
                                    <td class="col_3">{{ $item['title'] }}</td>
                                    <td class="col_4">{{ $item['txn_id'] }}</td>
                                    <td class="col_5">{{ $item['razorpayPaymentId'] }}</td>
                                    <td class="col_6">{{ $item['type'] }}</td>
                                    <td class="col_7">{{ $item['affiliated_by'] }}</td>
                                    <td class="col_8">{{ $item['amount'] }} </td>
                                    <!--<td class="col_9">{{ $item['razorpayStatus'] }}</td>-->
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
            </div>
        </div>
    </div>
</div>
@endsection