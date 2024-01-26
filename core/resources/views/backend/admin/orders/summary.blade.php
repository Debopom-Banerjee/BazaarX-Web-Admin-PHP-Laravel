@extends('backend.layouts.main') 
@section('title', 'Order')
@section('content')
@php
/**
* Order 
*
* @category  zStarter
*
* @ref  zCURD
* @author    Defenzelite <hq@defenzelite.com>
* @license  https://www.defenzelite.com Defenzelite Private Limited
* @version  <zStarter: 1.1.0>
* @link        https://www.defenzelite.com
*/
$breadcrumb_arr = [
    ['name'=>'Orders', 'url'=> route('panel.orders.index'), 'class' => ''],
    ['name'=>'Show Order', 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('backend/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    <style>
        .error{
            color:red;
        }
        .table thead {
            background-color: #fff;
        }
        .table thead th {
            border-bottom: 0px;
        }
    </style>
    @endpush

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>Show Order: #ORD{{ $order->id }}</h5>
                            <span>Show Order Details of #ORD{{ $order->id }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('backend.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- start message area-->
               @include('backend.include.message')
                <!-- end message area-->
                <div class="card ">
                    <div class="card-header">
                        <h3>Show Summary</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <td>ORD{{ $order->id }}</td>
                                </tr>
                                <tr>
                                    <th>User</th>
                                    <td>{{ $order->user->name ?? '--' }}</td>
                                </tr>
                                <tr>
                                    <th>SubTotal</th>
                                    <td>{{ format_price($order->sub_total) }}</td>
                                </tr>
                                <tr>
                                    <th>Tax</th>
                                    <td>{{ $order->tax }}</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td>{{ $order->discount }}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>{{ format_price($order->total) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Gateway</th>
                                    <td>{{ $order->payment_gateway }}</td>
                                </tr>
                            </thead>
                        </table>
                        
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <h5>Items:</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Item Type')}}</th>
                                            <th>{{ __('Product')}}</th>
                                            <th>{{ __('Qty')}}</th>
                                            <th>{{ __('Price')}}</th>
                                            <th>{{ __('Amount')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td> Product Type (Product, Service, etc) </td>
                                                <td>{{ $item->item_id }} (Product Name or title from table)</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{format_price($item->price) }}</td>
                                                <td>{{ format_price($item->price * $item->qty) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{asset('backend/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script src="{{asset('backend/js/form-advanced.js') }}"></script>
    <script>
        $('#OrderForm').validate();
                                                                                                                                                                                                                                        </script>
    @endpush
@endsection
