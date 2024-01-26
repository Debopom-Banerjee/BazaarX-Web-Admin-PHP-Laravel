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
    ['name'=>'Add Order', 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('backend/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    <style>
        .error{
            color:red;
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
                            <h5>Add Order</h5>
                            <span>Create a record for Order</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('backend.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mx-auto">
                <!-- start message area-->
               @include('backend.include.message')
                <!-- end message area-->
                <div class="card ">
                    <div class="card-header">
                        <h3>Create Order</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('panel.orders.store') }}" method="post" enctype="multipart/form-data" id="OrderForm">
                            @csrf
                            <div class="row">
                                
                                <div class="col-md-12 col-12"> 
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="user_id">Customer Number<span class="text-danger">*</span></label>
                                            <div class="user-data d-none">
                                                <div class="found-user text-success fw-700"></div>
                                            </div>
                                        </div>
                                        <input required type="number" class="form-control customer_phone" value="" name="phone" placeholder="Enter Client Number Here...">
                                    </div>
                                </div>  
                                

                                <div class="col-md-12 col-12"> 
                                    <div class="form-group">
                                        <label for="service_id">Service<span class="text-danger">*</span></label>
                                        <select required name="service_id" id="service_id" class="form-control select2">
                                            <option value="" readonly>Select Service </option>
                                            @foreach(App\Models\Service::where('is_publish',1)->get()  as $service)
                                                <option value="{{ $service->id }}">{{  $service->title ?? ''}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>                      
                                <div class="col-md-12 col-12"> 
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="">Price<span class="text-danger">*</span></label>
                                            <div class="priceRemark fw-700 text-info">

                                            </div>
                                        </div>
                                        <input required type="number" id="price" class="form-control" name="price" >
                                    </div>
                                </div>                      
                                <div class="col-md-12 ml-auto">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block createBtn">Create Custom Order & Send Payment Instructions</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
        $(document).ready(function(){
            $('.customer_phone').on('keyup change',function() {
                var user_phone = $(this).val();
                if(user_phone.length > 9){
                    $.ajax({
                        url: "{{route('panel.orders.get.user-record')}}",
                        method: 'GET',
                        data: {
                            phone: user_phone
                        },
                        success: function(res) {
                            if(res.found == 1){
                                var msg = "<span> #CID"+res.user.id+" | "+res.user.name+"</span>"
                                $('.found-user').html(msg);
                            }else{
                                var msg = "<span class='fw-700'>No Record Found with this Number</span>";
                                $('.found-user').html(msg);
                                $('.createBtn').prop('disabled', true);
                            }
                            $('.user-data').removeClass('d-none');
                        }
                    })
                }
            });
            $('#service_id').on('change',function() {
                var id = $(this).val();
                $.ajax({
                    url: "{{route('panel.orders.get.service-price')}}",
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(res) {
                        if(res.service.is_dynamic_rate == 0){
                            $('#price').prop('disabled',true);
                            $('.priceRemark').html('Price is fixed by Gofinx.');
                        }else{
                            $('.priceRemark').html('Price is dynamic.');
                            $('#price').prop('disabled',false);
                        }
                        $('#price').val(res.service.price);
                    }
                })
            });
        });
    </script>
    @endpush
@endsection
