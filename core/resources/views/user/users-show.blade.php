@extends('backend.layouts.main')
@section('title', 'Show User')
@section('content')

    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/fullcalendar/dist/fullcalendar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/plugins/datedropper/datedropper.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/plugins/select2/dist/css/select2.min.css') }}">
    @endpush

    <style>
        .customer-buttons {
            margin-bottom: 15px;
        }

        .note-toolbar-wrapper {
            height: 50px !important;
            overflow-x: auto;
        }

        .dgrid {
            display: grid !important;
        }

    </style>
    @php
        $orderTotal = App\Models\Order::where('user_id', $id)->sum('total');
        $useraffiliates = App\Models\AffiliateItem::where('user_id', $id)->count();
        $statistics_2 = [
                [ 'a' => route('panel.orders.index'),'name'=>'Total Orders','text-color'=>'primary', "count"=>$order_count,
                "icon"=>"<i class='ik ik-shopping-cart f-24'></i>" ,'col'=>'3', 'color'=> 'primary'],

                [ 'a' => route('panel.orders.index'),'name'=>'Order Value','text-color'=>'success', "count"=>$orderTotal != 0 ? format_price($orderTotal) : 0,
                "icon"=>"<i class='ik ik-user f-24'></i>" ,'col'=>'3', 'color'=> 'primary'],

                [ 'a' => route('panel.affiliate-items.index',['user_id'=>$id]),'name'=>'Affiliated Items','text-color'=>'warning', "count"=> $useraffiliates,
                "icon"=>"<i class='ik ik-user f-24'></i>" ,'col'=>'3', 'color'=> 'primary'],
        ];
        $kyc_record = null;
        if($user_kyc && isset($user_kyc->details) && $user_kyc->details != null){
            $kyc_record = json_decode($user_kyc->details,true);
        }
    @endphp
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fas fa-user bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ $user->name }}</h5>
                            <span>{{UserRole($user->id)}} Name </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('panel.dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Customer') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Profile') }}</li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>

        @include('backend.include.message')

        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div style="width: 150px; height: 150px; position: relative" class="mx-auto">
                                <img src="{{ ($user && $user->avatar) ? $user->avatar : asset('backend/default/default-avatar.png') }}" class="rounded-circle" width="150" style="object-fit: cover; width: 150px; height: 150px" />
                                <button class="btn btn-dark rounded-circle position-absolute" style="width: 30px; height: 30px; padding: 8px; line-height: 1; top: 0; right: 0"  data-toggle="modal" data-target="#updateProfileImageModal"><i class="ik ik-camera"></i></button>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body">
                        <small class="text-muted d-block pt-10">{{ __('Full Name') }} </small>
                        <h6>{{ $user->name ?? '' }}</h6>
                        <small class="text-muted d-block">{{ __('Email address') }} </small>
                        <h6><a href="mailto:{{ $user->email ?? '' }}">{{ $user->email ?? '' }}</a></h6>
                        <small class="text-muted d-block pt-10">{{ __('Phone') }}</small>
                        <h6><a href="tel:{{ $user->phone ?? '' }}">{{ $user->phone ?? '' }}</a></h6>
                        <small class="text-muted d-block pt-10">{{ __('Joined At') }}</small>
                        <h6>{{ getFormattedDate($user->created_at) ?? '' }}</h6>
                        {{-- <small class="text-muted d-block pt-10">{{ __('Added By') }}</small>
                        <h6>{{ NameById($user->id) ?? '' }}</h6> --}}
                        @if($user->referal_code)
                            <small class="text-muted d-block pt-10">{{ __('Refferal Code') }}</small>
                            <h6>{{ $user->referal_code }}</h6>
                        @endif
                        @if($user->userInviter)
                            <small class="text-muted d-block pt-10">{{ __('Reffered By') }}</small>
                            <h6>{{ @$user->userInviter->inviter->name ?? '' }}</h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="row pp-main mb-4">
                    @foreach ($statistics_2 as $item_2)
                        <div class="col-xl-4 col-md-4">
                            <a href="{{$item_2['a']}}" class="card card-body mb-0">
                                <div class="pp-cont">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            {!! $item_2['icon'] !!}
                                        </div>
                                        <div class="col text-right">
                                            <h2 class="mb-0 text-{{ $item_2['text-color'] }}">{{ $item_2['count'] }}</h2>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-15">
                                        <div class="col-auto">
                                            <p class="mb-0">{{ $item_2['name'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                {{-- tab start --}}
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item " >
                            <a class="nav-link active" id="pills-activity-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-activity" aria-selected="true">{{ __('Details')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="pills-service-tab" data-toggle="pill" href="#service" role="tab" aria-controls="pills-service" aria-selected="false">{{ __('Orders')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="pills-referral-tab" data-toggle="pill" href="#referral" role="tab" aria-controls="pills-referral" aria-selected="false">{{ __('Referrals')}}</a>
                        </li>
                        @if(UserRole($user->id) == 'Partner')
                            <li class="nav-item">
                                <a class="nav-link " id="pills-ekyc-tab" data-toggle="pill" href="#ekyc" role="tab" aria-controls="pills-ekyc" aria-selected="false">{{ __('eKyc')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="pills-bank-account-tab" data-toggle="pill" href="#bank-account" role="tab" aria-controls="pills-bank-account" aria-selected="false">{{ __('Bank Account')}}</a>
                            </li>
                        @endif
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form action="{{ route('panel.update-user-profile', $user->id) }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">{{ __('User Name')}}<span class="text-red">*</span></label>
                                                <input type="text" placeholder="Assign To" class="form-control" name="name" id="name" value="{{ $user->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">{{ __('Email')}}<span class="text-red">*</span></label>
                                                <input type="email" placeholder="test@test.com" class="form-control" name="email" id="email" value="{{ $user->email }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="phone">{{ __('Contact No')}}</label>
                                                <input type="number" placeholder="123 456 7890" id="phone" name="phone" class="form-control"
                                                       value="{{ $user->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dob">{{ __('DOB')}}</label>
                                                <input class="form-control" type="date" name="dob" placeholder="Select your date" value="{{ $user->dob }}" />
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{ __('Status')}} </label>
                                                <select required name="status" class="form-control select2"  >
                                                    <option value="" readonly>{{ __('Select Status')}}</option>
                                                    @foreach (getStatus() as $index => $item)
                                                        <option value="{{ $item['id'] }}" {{ $user->status == $item['id'] ? 'selected' :'' }}>{{ $item['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="country">{{ __('Country')}}</label>
                                                <select name="country" id="country" class="form-control select2">
                                                    <option value="" readonly>{{ __('Select Country')}}</option>
                                                    @foreach (\App\Models\Country::all() as  $country)
                                                        <option value="{{ $country->id }}" @if($user->country != null) {{ $country->id == $user->country ? 'selected' : '' }} @elseif($country->name == 'India') selected @endif>{{ $country->name }}</option>
                                                    @endforeach
                                                </select>

                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="state">{{ __('State')}}</label>
                                                <select name="state" id="" class="form-control select2">
                                                    <option value="" readonly>Select State</option>
                                                    @foreach (App\Models\State::where('country_id',101)->get() as $state)
                                                        <option value="{{ $state->id }}" @if ($user->state == $state->id) selected @endif>{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="city">{{ __('City')}}</label>
                                                <select name="city" id="city" class="form-control select2">
                                                    @if($user->city != null)
                                                        <option required value="{{ $user->city }}" selected>{{ fetchFirst('App\Models\City', $user->city, 'name') }}</option>
                                                    @endif
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="pincode">{{ __('Pincode')}}</label>
                                                <input id="pincode" type="number" class="form-control" name="pincode" placeholder="Enter Pincode" value="{{ $user->pincode ?? old('pincode') }}" >
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Gender</label>
                                                <div class="form-radio">
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="gender"  value="Male" {{ $user->gender == 'Male' ? 'checked' : '' }}>
                                                            <i class="helper"></i>{{ __('Male')}}
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="gender" value="Female" {{ $user->gender == 'Female' ? 'checked' : '' }}>
                                                            <i class="helper"></i>{{ __('Female')}}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" style="margin-top: 20px;">
                                                <div class="form-check mx-sm-2 p-0">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="is_verified" class="custom-control-input" value="1" {{ $user->is_verified == 1 ? 'checked' : '' }}>
                                                        <span class="custom-control-label">&nbsp; Verified</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        @if(UserRole($user->id) == 'Partner')
                                            <div class="col-md-4 commissionInput">
                                                <div class="form-group">
                                                    <label for="">Commission (in%)</label>
                                                    <input min="0" value="{{$user->commission}}" max="100" type="number" name="commission" class="form-control">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-4">
                                            <div class="form-group" style="margin-top: 20px;">
                                                <div class="form-check mx-sm-2 p-0">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" value="{{ now() }}" @if($user->email_verified_at != null)  checked @endif name="email_verified_at">
                                                        <span class="custom-control-label">&nbsp; Email verified</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">{{ __('Address')}}</label>
                                                <textarea name="address" name="address" rows="5" class="form-control">{{ $user->address }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success"  >Update Profile</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="service" role="tabpanel" aria-labelledby="pills-service-tab">
                            <div id="ajax-container-Service">
                                @include('user.include.service')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="referral" role="tabpanel" aria-labelledby="pills-referral-tab">
                            <div id="ajax-container-Referral">
                                @include('user.include.referral')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ekyc" role="tabpanel" aria-labelledby="pills-ekyc-tab">
                            <div class="card-body">
                                {{-- Status --}}
                                @if(isset($user_kyc) && $user_kyc->status == App\User::KYC_APPROVED)
                                    <div class="fw-700 alert alert-info">
                                        This request has been verified!
                                    </div>
                                @elseif(isset($user_kyc) && $user_kyc->status == App\User::KYC_REJECTED)
                                    <div class="fw-700 alert alert-danger">
                                        eKyc Verification has been rejected! due to:
                                        {{json_decode($user_kyc->details, true)['admin_remark'] ?? ''}}
                                    </div>
                                @elseif(isset($user_kyc) && $user_kyc->status == App\User::KYC_PENDING)
                                    <div class="fw-700 alert alert-warning">
                                        This Verification request is pending approval!
                                    </div>
                                @else     
                                @endif
                               
                        
                                <form action="{{ route('panel.update-ekyc-status') }}" method="POST" class="form-horizontal">
                                 @csrf
                                    <input id="status" type="hidden" name="status" value="">
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <div class="row">
                                        <div class="col-md-6 col-6"> <label>{{ __('Document')}}</label>
                                            <br>
                                            <h6 class="strong text-muted">{{ $kyc_record ['document_type'] ?? '--' }}</h6>
                                        </div>
                                        <div class="col-md-6 col-6"> <label>{{ __('Unique Identifier')}}</label>
                                            <br>
                                            <h6 class="strong text-muted">{{ Str::limit($kyc_record['document_number'] ?? '--',25)}}</h6>
                                        </div>
                                        <div class="col-md-6 col-6"> <label>{{ __('Front Side')}}</label>
                                            <br>
                                                @if ($kyc_record != null && $kyc_record['document_front'] != null)
                                                    <a href="{{ asset('storage/backend/user/docs/'.$kyc_record['document_front']) }}" target="_blank" class="btn btn-outline-danger">View Attachment</a>
                                                @else 
                                                    <button disabled class="btn btn-secondary">Not Submitted</button>    
                                                @endif
                                        </div>
                                        <div class="col-md-6 col-6"> <label>{{ __('Back Side')}}</label>
                                            <br>
                                            @if ($kyc_record != null && $kyc_record['document_back'] != null)
                                                @if ($kyc_record != null && $kyc_record['document_back'] != null)
                                                    <a href="{{ asset('storage/backend/user/docs/'.$kyc_record['document_back']) }}" target="_blank" class="btn btn-outline-danger">View Attachment</a>
                                                @else 
                                                    <button disabled class="btn btn-secondary">Not Submitted</button>    
                                                @endif
                                            @else 
                                                <button disabled class="btn btn-secondary">Not Submitted</button>    
                                            @endif
                                        </div>
                        
                        
                                        <hr class="m-2">
                        
                                        @if(AuthRole() == 'Admin')
                                            @if(isset($user_kyc) && $user_kyc->status == 1)
                                                <div class="col-md-12 col-12 mt-5"> 
                                                    <label>{{ __('Note')}}</label>
                                                    <textarea class="form-control" name="remark" type="text" >{{ $ekyc['admin_remark'] ?? '' }}</textarea>
                                                    <button type="submit" class="btn btn-danger mt-2 btn-lg reject">Reject</button>
                                                </div>
                                            @elseif(isset($user_kyc) && $user_kyc->status == \App\User::KYC_PENDING)
                                                <div class="col-md-12 col-12 mt-5"> <label>{{ __('Rejection Reason (If Any)')}}</label>
                                                    <textarea class="form-control" name="remark" type="text" >{{ $kyc_record['admin_remark'] ?? '' }}</textarea>
                                                    <button  type="submit" class="btn btn-danger mt-2 btn-lg reject">Reject</button>
                                                    <button type="submit" class="btn btn-success accept ml-5 accept mt-2 btn-lg">Accept</button>
                                                </div>
                                            @endif
                                        @endif    
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="bank-account" role="tabpanel" aria-labelledby="pills-bank-account-tab">
                            <div class="card-body">
                                @if($bank_detail)
                                    <div class="alert alert-info">
                                        Deleting a bank account that affects Razorpay Contact Account to Partner requires re-entry of details
                                    </div>

                                    <table id="table" class="table">
                                        <thead>
                                            <tr>
                                                <th>Beneficiary Name</th>
                                                <th>IFSC Code</th>                     
                                                <th>Account Number</th>
                                                <th>Contact Info Id</th>
                                                <th>Fund Account Id</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-bottom">
                                                <td>{{$bank_detail->name}}</td>                        
                                                <td>{{$bank_detail->ifscCode}}</td>
                                                <td>{{$bank_detail->accountNumber}}</td>
                                                <td>{{$bank_detail->contactInfoId}}</td>
                                                <td>{{$bank_detail->fundAccountId}}</td>
                                                <td class="no-export">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                                            <li class="dropdown-item p-0">
                                                                <a href="{{route('panel.delete.partner.account-detail',$bank_detail->id)}}" title="Delete Detail"  class="btn btn-sm delete-item">Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div> 
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <div>
                                        <p class="text-muted text-center">Not any account details added yet!</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                {{-- tab end --}}
                {{-- Modals Start--}}

                <div class="modal fade" id="updateProfileImageModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="updateProfileImageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="{{ route('panel.update-profile-img', $user->id) }}" method="POST" enctype="multipart/form-data">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateProfileImageModalLabel">Update profile image</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    @csrf
                                    <img src="{{ ($user && $user->avatar) ? asset('storage/backend/users/'.$user->avatar) : asset('backend/default/default-avatar.png') }}"
                                            class="img-fluid w-50 mx-auto d-block" alt="" id="profile-image">
                                    <div class="form-group mt-5">
                                        <label for="avatar" class="form-label">Select profile image</label> <br>
                                        <input type="file" name="avatar" id="avatar" accept="image/jpg,image/png,image/jpeg">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- Modals End--}}

            </div>

        </div>
    </div>

    @push('script')

        <script src="{{ asset('backend/plugins/moment/moment.js') }}"></script>
        <script src="{{ asset('backend/plugins/fullcalendar/dist/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script src="{{ asset('backend/plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('backend/plugins/datedropper/datedropper.min.js') }}"></script>
        <script src="{{ asset('backend/js/form-picker.js') }}"></script>
        <script src="{{ asset('backend/js/index-page.js')}}"></script>
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

        <script>
            $(document).ready(function(){
                $('.editDetailBtn').on('click',function(){
                    var data = $(this).data('rec');
                    $('#bankDetailId').val(data.id);
                    $('#userId').val(data.user_id);
                    $('.editIfscCode').val(data.ifscCode);
                    $('.editName').val(data.name);
                    $('.editAccountNumber').val(data.accountNumber);
                });
                $('.accept').on('click',function(){
                    $('#status').val(1)
                });
                $('.reject').on('click',function(){
                    $('#status').val(2)
                });
            });
            function html_table_to_excel(type,tableid) {
                var table_core = $('#'+tableid).clone();
                var clonedTable = $('#'+tableid).clone();
                clonedTable.find('[class*="no-export"]').remove();
                clonedTable.find('[class*="d-none"]').remove();
                $('#'+tableid).html(clonedTable.html());
                var data = document.getElementById(tableid);

                var file = XLSX.utils.table_to_book(data, {
                    sheet: "sheet1"
                });
                XLSX.write(file, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                });
                XLSX.writeFile(file, tableid+'.'+ type);
                $('#'+tableid).html(table_core.html());

            }
            $('.nav-link').click(function(){
                if(checkUrlParameter('showtype')){
                    url = updateURLParam('showtype', $(this).data('type'));
                }else{
                    url =  updateURLParam('showtype', $(this).data('type'));
                }
                // alert(url);
                getData(url);

            })
            $(document).on('click', '#export_button', function() {
                html_table_to_excel('xlsx',$(this).data('table'));
            })
        </script>

    @endpush



@endsection
