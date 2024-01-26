@extends('backend.layouts.main')
@section('title', 'Services')
@section('content')
    @php
        /**
         * Service
         *
         * @category  zStarter
         *
         * @ref  zCURD
         * @author    Defenzelite <hq@defenzelite.com>
         * @license  https://www.defenzelite.com Defenzelite Private Limited
         * @version  <zStarter: 1.1.0>
         * @link        https://www.defenzelite.com
         */
        $breadcrumb_arr = [['name' => 'Services', 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
        <style>
            .input-group.search,
            .input-group.search input.search {
                border-top-left-radius: 60px;
                border-bottom-left-radius: 60px;

            }

            .input-group.search,
            .input-group.search label.search {
                border-top-right-radius: 60px;
                border-bottom-right-radius: 60px;
            }
            .rating-review-section {
                max-width: 100%;
            }

            .rating {
                font-size: 24px;
                color: #f7b731;
            }

            .star {
                display: inline-block;
                margin-right: -5px;
            }

            .review-text {
                font-size: 17px;
            }

            .reviewer-name {
                font-size: 16px;
                font-style: italic;
            }

            .review-form {
                margin-top: 20px;
            }

            .reviews-list{
                list-style: none;
                padding: 0;
            }

            /* .card-block{
                    height: 405px;
                    overflow-y: auto;
                }
                .card-block::-webkit-scrollbar, .chat-list::-webkit-scrollbar{
                    width: 6px;
                } */
            /* .scrollable{
                    overflow: auto;
                    border-radius: 10px;
                }
                #style-1::-webkit-scrollbar-thumb
                {
                    border-radius: 6px;
                    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
                    background-color: #948f8f;
                }
                #style-1::-webkit-scrollbar
                {
                    width: 8px;
                    background-color: #763737;
                } */

            .avatar {
                vertical-align: middle;
                width: 50px;
                height: 50px;
                border-radius: 50%;
            }

            .dot {
                position: relative;
                height: 10px;
                width: 10px;
                border-radius: 50%;
                display: inline-block;
                cursor: pointer;
            }

            .date {
                position: relative;
                top: -5px;
            }

            /* lock */
            section {

                background: #ffffff;
                justify-content: center;
                align-items: center;
                width: 100%;

            }

            section .layout {
                position: relative;
                width: 100%;
                max-width: 600px;
                padding: 50px;
                /* box-shadow: 0 10px 20px rgba(0, 0, 0, .1); */
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.25);
                border-radius: 10px;
            }

            section .layout::before {
                content: '';
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
            }

            section .layout h1 {
                position: relative;
                text-align: center;
            }

            section .layout p {
                position: relative;
                color: #fff;
            }

            section .layout button {
                position: relative;
            }

            .photo-popup-content {
                text-align: center;
            }

            .photo-popup-content .photo-popup-image {
                height: 100%;
                max-width: 100%;
            }

            .form-inline {
                display: flex;
                flex-flow: row wrap;
                align-items: inherit !important;
            }
        </style>
    @endpush
    <div class="container-fluid">
        <div class="page-header" style="margin-bottom: 5px;">
            <div class="card" style="margin-bottom: 5px;">
                <div class="row align-items-end m-2">
                    <div class="col-lg-8 ">
                        <div class="d-flex">
                            <div class="mr-2">
                                <a href="{{ route('panel.orders.index',['type' => request()->get('type')]) }}" title="Back to Orders"  type="button" id="" class=" mr-1 btn-secondary btn-icon"><i class="ik ik-arrow-left"></i></a>
                            </div>
                            <div class="d-inline">
                                <h5 class="text-primary">
                                    @php
                                        $createDate = new DateTime(now());
                                        $currentdate = $createDate->format('Y-m-d');
                                        $service_duration = $order->service->service_duration ?? 7;
                                        $expected_delivery = \Carbon\Carbon::parse($order->date)->addDays($service_duration)->format('Y-m-d');
                                        $color = '';
                                        // If now() is less then orderDate+ServiceDurationDays
                                        if ($currentdate < $expected_delivery) {
                                            $dot = 'success';
                                        }
                                        // If now() is equals orderDate+ServiceDurationDays
                                        if ($currentdate == $expected_delivery) {
                                            $dot = 'warning';
                                        }
                                        // If now() is greater then orderDate+ServiceDurationDays
                                        if ($currentdate > $expected_delivery) {
                                            $dot = 'danger';
                                        }
                                    @endphp

                                    <span class="dot bg-{{ $dot }} " data-toggle="tooltip" data-placement="left"
                                        title="
                                @if ($currentdate < $expected_delivery) {{ 'Service is on time' }} @endif
                                @if ($currentdate == $expected_delivery) {{ 'Today is Deadline' }} @endif
                                @if ($currentdate > $expected_delivery) {{ 'Tentative Deadline Expired ' }} @endif
                                
                                ">
                                </span>
                                    {{--  \Str::limit(ucfirst($service->title),55,'...') --}}
                                    {{$order->getPrefix()}}-{{ $service->title ?? 'N/A' }}
                                </h5>
                                <div class="d-flex">
                                    <div class="mr-2 text-muted">
                                        <span class="ik ik-clock" style="font-size: 14px; margin-top:2px;"></span>
                                        Order Date: {{ $order->date ?? now() }}
                                    </div>
                                    <div class="text-success fw-700 mr-2">
                                        Expected Delivery At: {{ $expected_delivery }}
                                    </div>
                                    <h6 title="This service usually delivered in {{ $service_duration }} days." class="ik ik-info text-warning"></h6>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="page-header-title">
                        </div> --}}
                    </div>

                    <div class="col-lg-4">
                        <div class="float-right" style="position:relative;">
                            <h6><span class="badge badge-{{ getPayoutStatus($order->payment_status)['color'] }}">
                                {{ getPayoutStatus($order->payment_status)['name'] }}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-12 col-md-12">
                <div class="card m-0">
                    <div class="card-header d-flex justify-content-between ">
                        <div class="user d-flex" style="position: relative;">

                            <a href="#">
                                <img class="avatar"
                                    src="{{ $user && $user->avatar ? $user->avatar : asset('backend/default/default-avatar.png') }}"
                                    style="object-fit: cover; width: 35px; height: 35px" alt="">
                            </a>
                            <div class="ml-2 d-flex flex-column">
                                <span><a  href="@if(AuthRole() == 'Admin') {{ route('panel.users.show',$user->id) }} @else javascript:void(0) @endif" class="text-muted">{{ @$user->name }}</a>
                                    @if(AuthRole() == 'User')
                                    {{-- <!-- <a title="Call Partner" data-id="{{ $order->partner->id ?? 0}}" class="callMaskingBtn" href="javascript:void(0)">--> --}}
                                    <!--    <i class="ik ik-phone text-primary" aria-hidden="true"></i>-->
                                    <!--</a>-->
                                        @if($order->partner_id != null)
                                          <a title="Call Partner" class="callMaskingBtn" href="javascript:void(0)" data-type="partner" data-id="{{ $order->partner_id }}">
                                              <i class="ik ik-phone text-primary" aria-hidden="true"></i>
                                            </a>
                                        @endif    
                                    @endif
                                    
                                    @if(AuthRole() == 'Partner')
                                     <a title="Call Customer" data-id="{{ $user->id }}" class="callMaskingBtn" data-type="customer" href="javascript:void(0)">
                                        <i class="ik ik-phone text-primary" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                    
                                    @if(AuthRole() == 'Admin')
                                        <div class="d-flex">
                                            <a title="Call Customer" data-id="{{ $user->id }}" class="callMaskingBtn mr-2" data-type="customer" href="javascript:void(0)">
                                                <i class="ik ik-phone text-primary" aria-hidden="true"></i> Customer
                                            </a>
                                            @if($order->partner_id != null)
                                                <a title="Call Partner" data-id="{{ $order->partner_id }}" class="callMaskingBtn" data-type="partner" href="javascript:void(0)">
                                                    <i class="ik ik-phone text-danger" aria-hidden="true"></i> Partner
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                    
                                   
                                    <span class="icon-container d-none mt-1">
                                        <i class="loader"></i>
                                    </span>
                                </span>
                                <small>{{ \Carbon\Carbon::parse(@$user->updated_at)->diffForHumans() }}</small>
                            </div>
                        </div>
                        @if (authRole() == 'Admin' || authRole() == 'Partner')
                            <div class="drop-down d-flex">
                                <form method="post" action="{{ route('panel.orders.updateStatus', $order->id) }}"
                                    id="orderStatusForm">
                                    @csrf
                                    <div class="form-group m-0">
                                        <select name="orderStatus" id="orderStatus"
                                            class="form-control select2 select2-hidden-accessible"style="width: 100%;"
                                            aria-hidden="true">
                                            <?php foreach (orderStatus() as $key => $value) { ?>
                                            <option value="{{ $value['id'] }}"
                                                {{ $order->status == $value['id'] ? 'selected' : '' }}>
                                                {{ $value['name'] }}</option>
                                            <?php   } ?>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card">
                    {{-- tab header start --}}
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        {{-- @if ($service->permission['chat'] == 1) --}}
                        <li class="nav-item ">
                            <a class="nav-link @if (request()->get('active') == 'chat') active @endif" id="pills-chat-tab"
                                data-toggle="pill" href="#chat" onclick="changeParam('chat')" role="tab"
                                aria-controls="pills-chat" aria-selected="true">{{ __('Conversation') }}</a>
                        </li>
                        {{-- @endif --}}
                        @if ($permissions != null && $permissions->attachment == 1)
                            <li class="nav-item">
                                <a class="nav-link @if (request()->get('active') == 'attachment') active @endif"
                                    id="pills-attachment-tab" data-toggle="pill" href="#attachment"
                                    onclick="changeParam('attachment')" role="tab" aria-controls="pills-attachment"
                                    aria-selected="false">{{ __('Attachment') }}</a>
                            </li>
                        @endif
                        @if ($permissions != null && $permissions->portfolio == 1)
                            <li class="nav-item">
                                <a class="nav-link @if (request()->get('active') == 'portfolio') active @endif" id="pills-portfolio-tab"
                                    data-toggle="pill" href="#portfolio" onclick="changeParam('portfolio')" role="tab"
                                    aria-controls="pills-portfolio" aria-selected="false">{{ __('Portfolio') }}</a>
                            </li>
                        @endif
                        {{-- <li class="nav-item">
                            <a class="nav-link @if (request()->get('active') == 'detail') active @endif" id="pills-detail-tab"
                                data-toggle="pill" href="#detail" onclick="changeParam('detail')" role="tab"
                                aria-controls="pills-detail" aria-selected="false">{{ __('Order Details') }}</a>
                        </li> --}}
                        @if(AuthRole() != 'User' && $order->payment_status == \App\Models\Order::PAYMENT_STATUS_PAID)
                            <li class="nav-item">
                                <a class="nav-link @if (request()->get('active') == 'manage') active @endif" data-toggle="pill"
                                    href="#manage" onclick="changeParam('manage')" role="tab" aria-controls="pills-detail"
                                    aria-selected="false">{{ __('Assign to Partner') }}</a>
                            </li>
                        @endif    
                        @if($order->partner_id != null)
                            <li class="nav-item">
                                <a class="nav-link @if (request()->get('active') == 'milestone') active @endif" data-toggle="pill"
                                href="#milestone" onclick="changeParam('milestone')" role="tab"
                                aria-controls="pills-detail" aria-selected="false">{{ __('Payment Milestones') }}</a>
                            </li>
                        @endif
                        @if($customer_review)
                            <li class="nav-item">
                                <a class="nav-link @if (request()->get('active') == 'reviews') active @endif" data-toggle="pill"
                                href="#reviews" onclick="changeParam('reviews')" role="tab"
                                aria-controls="pills-detail" aria-selected="false">{{ __('Review') }}</a>
                            </li>
                        @endif
                    
                    </ul>
                    <div class="tab-content" id="pills-tabContents">
                        <div class="tab-pane fade @if (request()->get('active') == 'chat') show active @endif " id="chat"
                            role="tabpanel" aria-labelledby="pills-chat-tab">
                            @if (!isset($workStream))
                                <div class="card-body d-flex align-items-center" style="height: 300px">
                                    {{-- chat no intitate --}}
                                    <section class=" w-100">
                                        <div class="container">
                                            <h5 class="text-danger text-center"> Your Chat is Not initialized Yet !</h5>
                                        </div>
                                        <div class="container d-flex justify-content-center  w-100">
                                            {{-- <button class="btn btn-info" onclick="chatInit({{$order->id}},'{{ route('panel.orders.initChat') }}')">Initialize It</button>  --}}
                                            <a class="btn btn-info"
                                                href="{{ route('panel.orders.create-stearm', $order->id) }}">Initialize
                                                It</a>
                                        </div>
                                    </section>

                                </div>
                            @else
                                <div class="card-body chat-box" id="style-1"
                                    style="scrollbar-darkshadow-color: black;">
                                    <ul class="chat-list " id="chat-list"
                                        style="scrollbar-darkshadow-color: black; height: 285px;">
                                        @foreach ($message as $item)
                                            @if ($item->user_id == auth()->id())
                                                <li class="odd chat-item mr-2">
                                                    <div class="chat-content">
                                                        <h6 class="box bg-gray text-dark p-3" style="background: #F0F0F0">
                                                            {!! nl2br($item->message) !!}
                                                        </h6>
                                                        <br>
                                                    </div>
                                                    <div class="chat-time mb-2" style="font-size: 12px">
                                                        {{ $item->created_at }}</div>
                                                </li>
                                            @else
                                                <li class="chat-item">
                                                    {{-- <div class="chat-img"><img src="{{ asset('backend/img/users/2.jpg') }}" alt="user"></div> --}}
                                                    <div class="chat-content">
                                                        {{-- <h6 class="font-medium p-0">{{ NameById($item->user_id) }}</h6> --}}

                                                        <h6 class="box bg-light-info p-3">
                                                            {!! nl2br($item->message) !!}
                                                        </h6>
                                                    </div>
                                                    <div
                                                        style="font-size: 12px; color: #4F5467; margin: 2px 15px 0px 30px;">
                                                        By {{ NameById($item->user_id) }} At {{ $item->created_at }}
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card-footer bg-white border-0 m-0 py-0">
                                    <form action="{{ route('panel.services.chat.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="user_id" id="user_id"
                                            value="{{ auth()->id() }}">
                                        <input type="hidden" name="type" id="type" value="0">
                                        <input type="hidden" name="workstream_id" id="workstream_id"
                                            value="{{ $workStream->id }}">
                                            <hr>
                                        <div class="row mb-4">
                                            <div class="col-md-11">
                                                <textarea type="text" placeholder="Type here..." name="message" id="message" rows="1"
                                                    class="form-control" style="background: #F0F0F0;" required></textarea>
                                            </div>
                                            <div class="col-md-1 d-flex align-items-center">
                                                <button type="submit" class="btn btn-icon btn-theme" id="send"
                                                    style="top: 25px;right:25px;"><i
                                                        class="fa fa-paper-plane"></i></button>
                                            </div>
                                        </div>
                                        {{-- <div class="input-group input-wrap"> --}}
                                        {{-- <input type="file" id="imgupload" style="display:none"/> 
                                                <button id="OpenImgUpload" class="btn btn-accent" style="top: 0; right: 50px" type="button">
                                                    <i class="ik ik-paperclip"></i>
                                                </button> --}}
                                        {{-- </div> --}}
                                    </form>
                                </div>
                            @endif
                        </div>

                        <div class="tab-pane fade @if (request()->get('active') == 'attachment') show active @endif" id="attachment"
                            role="tabpanel" aria-labelledby="pills-attachment-tab">
                            <div class="card-body">
                                <div id="ajax-container-attachment">
                                    {{-- <iframe src="{{ url('/laravel-filemanager')."?directory=".$path }}?empty=true" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe> --}}
                                    <div class="card m-0 p-0" style="box-shadow: none">
                                        @include('backend.admin.orders.fileManager.file')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade @if (request()->get('active') == 'portfolio') show active @endif" id="portfolio"
                            role="tabpanel" aria-labelledby="pills-portfolio-tab">
                            <div class="col-lg-12 col-md-12 m-0 p-2">
                                <table id="table" class="table border">
                                    <thead>
                                        <tr>
                                            {{-- <th class="no-export">Actions</th>  --}}
                                            <th class="col_2">#PID
                                                <div class="table-div">
                                                    <i class="ik ik-arrow-up  asc"data-val="id"></i>
                                                    <i class="ik ik ik-arrow-down desc" data-val="id"></i>
                                                </div>
                                            </th>
                                            <th class="col_2"> Title </th>
                                            {{-- <th class="col_4"> Buy Link </th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @if ($order->service_data != null)
                                            @foreach ($order->service_data as $val)
                                                <tr>
                                                    <td class="col_2">#{{ getPrefixZeros($val['id']) }}</td>
                                                    <td class="col_2">

                                                        <a class="text-dark"
                                                            @if ($val['buy_link'] == null) href="javascript:void(0)"
                                                            @else 
                                                                href="{{ $val['buy_link'] }}" @endif>
                                                            <h6>{{ $val['title'] }}</h6>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="2">
                                                    <h6 class="text-danger text-center">No Data Found !</h6>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- <div class="tab-pane fade @if (request()->get('active') == 'detail') show active @endif" id="detail"
                            role="tabpanel" aria-labelledby="pills-detail-tab">
                            <div class="card-body">
                                <div id="ajax-container-detail">
                                    <div class="col-lg-12 col-md-12 m-0 p-0">
                                        <table id="table" class="table border">
                                            <thead>
                                                <tr>
                                                    <th class="col_2"> OrderID </th>
                                                    <th class="col_2"> Referred By </th>
                                                    <th class="col_2"> Type </th>
                                                    <th class="col_2"> Tax Number </th>
                                                    <th class="col_2"> Sub Total </th>
                                                    <th class="col_2"> Discount </th>
                                                    <th class="col_2"> Tax </th>
                                                    <th class="col_2"> Total </th>
                                                    <th class="col_4"> Remark </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="border-bottom">
                                                    <td class="col_2">
                                                        <h6>{{$order->getPrefix()}}</h6>
                                                    </td>
                                                    <td class="col_2">
                                                        <h6>{{$order->referred_by == null ? 'NA' : $order->referred_by}}</h6>
                                                    </td>
                                                    <td class="col_2">
                                                        <h6>{{$order->type == null ? 'NA' : $order->type}}</h6>
                                                    </td>
                                                    <td class="col_2">
                                                        <h6>{{ $order->txn_no == null ? 'NA' : $order->txn_no }}</h6>
                                                    </td>
                                                    <td class="col_2">
                                                        <h6>{{ $order->sub_total == null ? 'NA' : $order->sub_total }}</h6>
                                                    </td>
                                                    <td class="col_2">
                                                        <h6>{{ $order->discount == null ? 'NA' : $order->discount }}</h6>
                                                    </td>
                                                    <td class="col_2">
                                                        <h6>{{ $order->tax == null ? 'NA' : $order->tax }}</h6>
                                                    </td>
                                                    <td class="col_2">
                                                        <h6>{{ $order->total == null ? 'NA' : $order->total }}</h6>
                                                    </td>

                                                    <td class="col_4">
                                                        <h6>{{ $order->remarks == null ? 'NA' : $order->remarks }} </h6>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="tab-pane fade @if (request()->get('active') == 'manage') show active @endif" id="manage"
                            role="tabpanel" aria-labelledby="pills-manage-tab">
                            <div class="card-body">
                                @if ($order->partner_id != null)
                                    <div class="row ">
                                        <div class="col-md-3 col-12">
                                            <h6>
                                                Partner: 
                                                <br>
                                                <strong>{{ NameById($order->partner_id) }}</strong> 
                                              
                                                <!--<span class="partner-icon-container d-none">-->
                                                <!--    <i class="loader"></i>-->
                                                <!--</span>-->
                                            </h6>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <h6>
                                                Commission:
                                                <br>
                                                <strong>{{ $order->commission ?? 0 }}%</strong>
                                            </h6>
                                        </div>
                                        @if ($payments->count() <= 0 && AuthRole() == 'Admin')
                                        <div class="col-md-4 col-12 text-right mb-lg-0 mb-2">
                                            <a href="{{route('panel.orders.change-assign-to',$order->id)}}" class="btn btn-outline-danger confirm">Change Partner</a>
                                        </div>
                                    @endif
                                        <div class=" col-12 row">
                                                <div class="col-md-3 col-4">
                                                    <h6>
                                                        Project Cost:
                                                        <br>
                                                        <strong>{{format_price ($order->total) }}</strong>
                                                    </h6>
                                                </div>
                                                @php
                                                    $gofinx_fee =  $order->total * $order->commission / 100;
                                                    $partner_earning =  $order->total - $gofinx_fee;
                                                @endphp
                                                <div class="col-md-3 col-4">
                                                    <h6>
                                                        Partner Earning:
                                                        <br>
                                                        <strong>{{  format_price($partner_earning) }}</strong>
                                                    </h6>
                                                </div>
                                                <div class="col-md-3 col-4">
                                                    <h6>
                                                        BazaarX Fee:
                                                        <br>
                                                        <strong>{{format_price ($gofinx_fee) }}</strong>
                                                    </h6>
                                                </div>
                                        </div>
                                    
                                    </div>
                                @else
                                    <form method="post" action="{{ route('panel.orders.assign-to', $order->id) }}"
                                        id="orderAssignToForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="">Assign to<span
                                                            class="text-danger">*</span></label>
                                                    <select required name="partner_id" id="assignTo"
                                                        class="form-control getPartnersList">
                                                        <option value=""aria-readonly="true">Select Partner</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="">Commission(in %)<span
                                                            class="text-danger">*</span></label>
                                                    <input required type="number" min="0" max="100"
                                                        class="form-control" name="commission"
                                                        value="{{ @$order->commission }}">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-between">
                                                <span class="text-danger fw-700">
                                                    This action cannot be undone
                                                </span>
                                                <button type="submit" @if ($payments->count() > 0 && $order->partner_id != null) disabled @endif
                                                    class="btn btn-primary">Assign to Partner</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane fade @if (request()->get('active') == 'milestone') show active @endif" id="milestone"
                            role="tabpanel" aria-labelledby="pills-milestone-tab">
                            <div class="card-body">
                                @if ($payments->count() <= 0 && AuthRole() == 'Admin')
                                    <div class="border p-3 mb-2" style="border-radius: 5px">
                                        <div class="d-flex justify-content-between mb-2">

                                            <div>
                                                Order Amount: {{ format_price($order->total) }}

                                            </div>
                                            <div>
                                                Commission Amount: {{ format_price($order->commission) }}
                                            </div>
                                            <div>
                                                Partner Amount:
                                                <span class="partner_amount">{{ (@$order->total - ($order->total * $order->commission) / 100) }}</span>
                                            </div>
                                            @if ($payments->count() <= 0)
                                                <div>
                                                    Milestone Amount: <span id="milestone_total">
                                                        0
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="alert alert-danger p-1">
                                            Milestones cannot be undone once they have been created. It is important to
                                            check carefully before creating.
                                        </div>
                                        <label for="" class="fw-700">
                                            Payout Date Planner
                                        </label>
                                        <form action="{{ route('panel.orders.payment-store', $order->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="form-inline repeater">
                                                <div data-repeater-list="payments">
                                                    <div data-repeater-item class="d-flex mb-2">
                                                        <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                                                            <label class="mr-4" for="">Month<span
                                                                    class="text-danger">*</span></label>
                                                            <input required type="month" name="month"
                                                                class="form-control" placeholder="Enter Month">
                                                        </div>
                                                        <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                                                            <label class="mr-4" for="">Payout Amount (in
                                                                INR)<span class="text-danger">*</span></label>
                                                            <input required step=".01" type="number" name="amount"
                                                                class="form-control milestone" placeholder="Enter Amount">
                                                        </div>
                                                        <button data-repeater-delete type="button"
                                                            class="btn btn-danger btn-icon ml-2"><i
                                                                class="ik ik-trash-2"></i></button>
                                                    </div>
                                                </div>
                                                <button data-repeater-create type="button"
                                                    class="btn btn-success btn-icon ml-2 mb-2"><i
                                                        class="ik ik-plus"></i></button>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between mb-2 mt-2">
                                                <div class="form-check" style="line-height: 25px;">
                                                    <input required class="form-check-input check-parent" name="confirm" type="checkbox" value="1" id="confirmed">
                                                    <label class="form-check-label text-muted fw-700" for="confirmed">
                                                        The above milestones are
                                                        in accordance with BazaarX policy and have been confirmed by the
                                                        partner as acceptable.
                                                    </label>
                                                </div>

                                                <button type="submit" class="btn btn-primary create_milestones" disabled>Create Milestones</button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                                <table id="table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Remark</th>
                                            <th>Payment Date</th>
                                            @if (AuthRole() == 'Admin')
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr class="border-bottom">
                                                <td>{{ @$payment->month }} ({{\Carbon\Carbon::parse($payment->month)->format('M')}})</td>
                                                <td>
                                                    {{ @$payment->user->name ?? '--' }} #UID{{(@$payment->user->id)}}
                                                    <hr class="p-0 m-1">
                                                    <span class="text-muted">
                                                        {{@$payment->user->bankDetail->name ?? '--'}} - {{substr(@$payment->user->bankDetail->accountNumber, 4) ?? '--'}}
                                                    </span>
                                                </td>
                                                <td>{{ format_price($payment->amount) }}</td>
                                                <td>
                                                    <span class="badge badge-{{ getPaymentStatus($payment->status)['color'] }}">{{ getPaymentStatus($payment->status)['name'] }}</span>
                                                </td>
                                                <td>{{ $payment->r_payment_id ?? '--' }}</td>
                                                <td>{{ $payment->payout_date ?? '--' }}</td>
                                                @if (AuthRole() == 'Admin')
                                                    <td>
                                                        @if($payment->status == 0 || $payment->status == 3)
                                                            <a href="{{route('panel.payment.approve',[$payment->id,'status' => 1])}}" class="btn btn-success confirm">Approve</a>
                                                        @endif
                                                        @if($payment->status == 0 || $payment->status == 1)
                                                            @if($payment->status == 1)
                                                                <a href="{{ route('panel.payment.force-pay',$payment->id) }}" class="btn btn-info confirm">Force Pay</a>
                                                            @endif
                                                            <a href="javascript:void(0)" data-toggle="modal" data-id="{{$payment->id}}" data-target="#rejeactPayment" class="btn btn-danger rejeactBtn">Cancel Payment</a>
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($customer_review)
                            <div class="tab-pane fade @if (request()->get('active') == 'reviews') show active @endif" id="reviews"
                                role="tabpanel" aria-labelledby="pills-reviews-tab">
                                <div class="card-body">
                                    <div class="rating-review-section">
                                        <h6 class="fw-600 text-muted">{{ $customer_review->name ?? '' }} Feedback</h6>
                                        <ul class="reviews-list">
                                            <li class="review p-4 rounded bg-light">
                                                <p class="review-text mb-0">{{ $customer_review->description ?? '' }}</p>

                                                <div class="rating">
                                                    <span class="star @if($customer_review->rating >= 1) @else text-muted @endif"> &#9733;</span>
                                                    <span class="star @if($customer_review->rating >= 2) @else text-muted @endif"> &#9733;</span>
                                                    <span class="star @if($customer_review->rating >= 3) @else text-muted @endif"> &#9733;</span>
                                                    <span class="star @if($customer_review->rating >= 4) @else text-muted @endif"> &#9733;</span>
                                                    <span class="star @if($customer_review->rating >= 5) @else text-muted @endif"> &#9733;</span>
                                                </div>
                                            </li> 
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!--  chatbox end -->
            </div>
        </div>
    </div>
    @include('panel.services.include.attachment')
    {{-- order   start --}}
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hands up!</h5>
                    <button type="button" id="modelCloseCross" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure to change the status? </h6>
                    <ul>
                        <li>
                            <p class="p-0 m-0">
                                It will trigger a notification to user.
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="orderStatusFormSubmitBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    {{-- order status end --}}

{{-- Call Modal --}}
    <div class="modal fade" id="callModal" tabindex="-1" role="dialog" aria-labelledby="callModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="callModalLabel">
                        Contact Widget
                    </h5>
                    <button type="button" id="modelCloseCross" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h6 class="mb-0"><i class="ik ik-phone text-muted"> </i> Dial </span>
                        <br>
                        <h4 class="phoneNumber text-primary fw-600 mt-2"></h4>
                    </h6>
                    <hr>
                    <div class="text-danger">
                        <i class="ik ik-info"></i> The call is being recorded for quality assurance and training purposes.
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="btn btn-primary" id="callBtn">Dialing <span id="timer"></span></a>
                </div>
            </div>
        </div>
    </div>
@include('backend.admin.orders.include.reject-payment')

@endsection

@push('script')
    <script src="{{ asset('backend/plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="{{ asset('backend/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click','.callMaskingBtn', function() {
                let user_id = $(this).data('id');
                let type = $(this).data('type');
                $(this).addClass('d-none');
                $('.icon-container').removeClass('d-none');
                callMaskingApi(user_id,type);
            });
            function callMaskingApi(user_id,type){
                $.ajax({
                        url: "{{ route('panel.orders.place-call') }}",
                        data: {
                            user_id: user_id,
                            type: type,
                        },
                        dataType: "json",
                        method: "GET",
                        success: function(data) {
                            // if (data.type) {
                                $('.icon-container').addClass('d-none'); 
                                $('.callMaskingBtn').removeClass('d-none');
                            // }
                            if (data.status == 'error') {
                                $.toast({
                                    heading: 'ERROR',
                                    text: data.message,
                                    showHideTransition: 'slide',
                                    icon: 'error',
                                    loaderBg: '#f2a654',
                                    position: 'top-right'
                                });
                            }else{
                                $('.phoneNumber').html(data.phone)
                                $('#callBtn').attr('href','tel:'+data.phone);
                                $('#callModal').modal('show')
                                setTime();
                            }
                        }
                });
            }
            $('#callBtn').on('click',function(){
                $('#timer').hide();
            })
            function setTime() {
                $('#timer').show();
                var timeLeft = 5;
                var elem = document.getElementById('timer');
    
                var timerId = setInterval(countdown, 1000);
    
                function countdown() {
                    if (timeLeft == 0) {
                        clearInterval(timerId);
                        $('#timer').hide();
                        if ($('#callModal').is(':visible')) {
                            $('#callBtn')[0].click();
                        }
                    } else {
                        elem.innerHTML = 'in ' + timeLeft + ' seconds';
                        timeLeft--;
                    }
                }
            }
        });
        function changeParam(tab) {
            const url = new URL(window.location);
            url.searchParams.set('active', tab);
            window.history.pushState({}, '', url);
        }

        $(document).on('keyup', 'input.milestone', function() {
            var sum = 0;
            var partner_amount = $('.partner_amount').html();
            $('.milestone').each(function(index, value) {
                sum = sum + +$(this).val();
            });
            $('#milestone_total').html(sum);
            if (partner_amount == sum || partner_amount >= sum) {
            $('.create_milestones').attr('disabled', false);
            }
        });
        $('.rejeactBtn').on('click', function() {
            var id = $(this).data('id');
            $('#paymentId').val(id);
        });

        function getPartners() {
            $(".getPartnersList").select2({
                ajax: {
                    url: "{{ route('panel.get-partners') }}",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            query: params.term, // search term
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: $.map(response, function(item, index) {
                                return {
                                    text: '#PID' + item.id + ' - ' + item.name + ' Tel: ' + item.phone +
                                        ' @: ' + item.email + ' Commission : ' + item.commission + '%',
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        }


        setTimeout(() => {
            $('#assignTo').val("{{ $order->partner_id }}");
        }, 100);

        $(document).ready(function() {
            $('#orderStatus').on('change', function() {
                $('#exampleModal1').modal('show');
            })

            $('#modelCloseCross').click(function() {
                $('#exampleModal1').modal('hide');
            })

            $('#modelCloseBtn').click(function() {
                $('#exampleModal1').modal('hide');
            })

            $('#orderStatusFormSubmitBtn').click(function() {
                $('#orderStatusForm').submit();
                $('#exampleModal1').modal('hide');
            })
            getPartners();
        });

        // Repeater Create
        $('.repeater').repeater({
            defaultValues: {
                'text-input': 'foo'
            },
            show: function() {
                $(this).slideDown();
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            isFirstItemUndeletable: true
        });



        var lfm = function(id, type, options) {
            let button = document.getElementById(id);

            button.addEventListener('click', function() {
                var route_prefix = (options && options.prefix) ? options.prefix : "{{ url('#') }}";
                var target_input = document.getElementById(button.getAttribute('data-input'));
                var target_preview = document.getElementById(button.getAttribute('data-preview'));

                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager',
                    'width=900,height=600');
                window.SetUrl = function(items) {
                    var file_path = items.map(function(item) {
                        return item.url;
                    }).join(',');

                    // set the value of the desired input to image url
                    target_input.value = file_path;
                    target_input.dispatchEvent(new Event('change'));

                    // clear previous preview
                    target_preview.innerHtml = '';

                    // set or change the preview image src
                    items.forEach(function(item) {
                        let img = document.createElement('img')
                        img.setAttribute('style', 'height: 5rem')
                        img.setAttribute('src', item.thumb_url)
                        target_preview.appendChild(img);
                    });

                    // trigger change event
                    target_preview.dispatchEvent(new Event('change'));
                };
            });
        };

        var route_prefix = "url-to-filemanager";
        lfm('lfm', 'image', {
            prefix: "{{ url('') }}"
        });
        lfm('lfm2', 'file', {
            prefix: "{{ url('') }}"
        });


        function html_table_to_excel(type, tableid) {
            var table_core = $('#' + tableid).clone();
            var clonedTable = $('#' + tableid).clone();
            clonedTable.find('[class*="no-export"]').remove();
            clonedTable.find('[class*="d-none"]').remove();
            $('#' + tableid).html(clonedTable.html());
            var data = document.getElementById(tableid);

            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, tableid + '.' + type);
            $('#' + tableid).html(table_core.html());

        }
        $('.nav-link').click(function() {
            if (checkUrlParameter('showtype')) {
                url = updateURLParam('showtype', $(this).data('type'));
            } else {
                url = updateURLParam('showtype', $(this).data('type'));
            }
            // alert(url);
            getData(url);

        })
        $(document).on('click', '#export_button', function() {
            html_table_to_excel('xlsx', $(this).data('table'));
        });
        $('.scrollable').animate({
            scrollTop: $('.scrollable').prop("scrollHeight")
        }, 10);
    </script>
@endpush
