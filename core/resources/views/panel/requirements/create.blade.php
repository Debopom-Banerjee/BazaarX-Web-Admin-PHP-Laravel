@extends('backend.layouts.main') 
@section('title', 'Requirement')
@section('content')
@php
/**
 * Requirement 
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
    ['name'=>'Add Requirement', 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>Add Requirement</h5>
                            <span>Create a record for Requirement</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('backend.include.breadcrumb')
                </div>
            </div>
        </div>
        <!-- start message area-->
        @include('backend.include.message')
        <!-- end message area-->
            <form action="{{ route('panel.requirements.store') }}" method="post" enctype="multipart/form-data" id="RequirementForm" class="row">
                @csrf
                
                    <input type="hidden" name="created_by" value="{{ auth()->id()}}">
                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                <div class="col-md-7">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h3>Basic Details</h3>
                        </div>
                        <div class="card-body" style="padding: 10px 20px;">
                           
                            <div class="row">
                                                            
                                <div class="col-md-12 col-12"> 
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                        <label for="title" class="control-label">Title<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="title" type="text" id="title" value="{{old('title')}}" placeholder="Enter Title" >
                                    </div>
                                </div>
                                <div class="col-md-12 col-12"> 
                                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                        <label for="description" class="control-label">Description </label>
                                        <textarea rows="3" class="form-control" name="description" id="description" placeholder="Enter Description">{{ old('description')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="category_id">Category <span class="text-danger">*</span></label>
                                        <select required name="category_id" id="category_id" class="form-control select2">
                                            <option value="" readonly>Select Category </option>
                                            @foreach($categories  as $category)
                                                <option value="{{ $category->id }}" {{  old('category_id') == $category->id ? 'Selected' : '' }}>{{  $category->name ?? ''}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="sub_category_id">Sub Category <span class="text-danger">*</span></label>
                                        <select required name="sub_category_id" id="sub_category_id" class="form-control select2">
                                            <option value="" readonly>Select Sub Category </option>
                                        </select>
                                    </div>
                                </div>
                                                                                         
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                                        <label for="price" class="control-label">Price<span class="text-danger">*</span> </label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">₹</div>
                                            </div>
                                            <input required  class="form-control" name="price" type="number" id="price" value="{{old('price')}}" placeholder="Enter Price" oninput="getValue()">
                                        </div>   
                                        
                                    </div>
                                </div>  
                                {{-- @dd($budget_categories)                                                            --}}
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="budget">Budget</label>
                                        <select required name="budget" id="budget" class="form-control select2">
                                            <option value="" readonly>Select Budget</option>
                                                @foreach($budget_categories as $option)
                                                    <option value="{{  $option->id }}" {{  old('budget') == $option->id ? 'Selected' : '' }}>{{ $option->name}}</option> 
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="border p-2">
                                            <strong>Dynamic Price Calculation:</strong>

                                            <ul class="mb-0">
                                                <li>
                                                    First Bid: <span id="bid-1" class="fw-700 text-primary">0</span>
                                                </li>
                                                <li>
                                                    Second Bid: <span id="bid-2" class="fw-700 text-primary">0</span>
                                                </li>
                                                <li>
                                                    Third Bid: <span id="bid-3" class="fw-700 text-primary">0</span>
                                                </li>
                                                <li>
                                                    After Bids: <span id="bid-4" class="fw-700 text-primary">0</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                                      
                              
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Other Details</h3>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-6 col-6"> 
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select required name="status" id="status" class="form-control select2">
                                        {{-- <option value="" readonly>Select Status</option> --}}
                                        @foreach(getRequirementStatus()  as  $option)
                                        <option value="{{ $option['id'] }}" {{  old('status') == $option['name'] ? 'Selected' : '' }}> {{  $option['name'] ?? ''}}</option> 
                                    @endforeach
                                    </select>
                                </div>
                            </div>                                                         
                            <div class="col-md-6 col-6"> 
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select required name="type" id="type" class="form-control select2">
                                        {{-- <option value="" readonly>Select Type</option> --}}
                            
                                            @foreach(getRequirementType() as $option)
                                                <option value="{{  $option['id'] }}" {{  old('type') == $option['name'] ? 'Selected' : '' }}>{{ $option['name']}} ({{ $option['description']}})</option> 
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between" style="padding: 0.5rem 1.25rem;">
                            <h3>Customer Info</h3>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-12 col-12"> 
                                <div class="form-group {{ $errors->has('Name') ? 'has-error' : ''}}">
                                    <label for="name" class="control-label">Full Name<span class="text-danger">*</span> </label>
                                    <input required  class="form-control" name="name" type="text" id="name" value="{{old('name')}}" placeholder="Enter Full Name" >
                                </div>
                            </div>
                            <div class="col-md-12 col-12"> 
                                <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                    <label for="phone" class="control-label">Mobile Number<span class="text-danger">*</span> </label>
                                    <input required  class="form-control" name="phone" type="number" id="phone" value="{{old('phone')}}" placeholder="Enter Mobile No." >
                                </div>
                            </div>
                            <div class="col-md-12 col-12"> 
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                    <label for="email" class="control-label">Email<span class="text-danger">*</span> </label>
                                    <input required  class="form-control" name="email" type="email" id="email" value="{{old('email')}}" placeholder="Enter Email" >
                                </div>
                            </div>
                            <div class="col-md-12 col-12"> 
                                <div class="form-group">
                                    <label for="location" class="control-label">Address </label>
                                    <textarea rows="7" class="form-control" name="location" id="location" placeholder="Enter Address">{{ old('location')}}</textarea>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </form>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{asset('backend/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script src="{{asset('backend/js/form-advanced.js') }}"></script>
    <script>
        $('#RequirementForm').validate();
        $('#category_id').on('change', function() {
            var category = $(this).val();
            $.ajax({
                url: "{{ route('panel.requirements.get-subcategory') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: category
                },
                dataType: "html",
                method: "POST",
                success: function(data) {
                    $('#sub_category_id').html(data);
                    $('#sub_category_id').select2("refresh");
                }
            });
        });  
        
        $('#price').on('keyup',function(){
            var price = $(this).val();
            getLeadAmount(price)
        });
        function getLeadAmount(price){
            $('#bid-1').html("₹"+price);
            $('#bid-2').html(("₹"+(price*80)/100));
            $('#bid-3').html(("₹"+(price*60)/100));
            $('#bid-4').html(("₹"+(price*40)/100));
        }
                                                                                                                                                                                       
    </script>
    @endpush
@endsection
