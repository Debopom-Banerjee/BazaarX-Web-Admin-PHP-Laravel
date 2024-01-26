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
                    <div class="card ">
                        <div class="card-header">
                            <h3>Create Requirement</h3>
                        </div>
                        <div class="card-body">
                           
                            <div class="row">
                                                            
                                <div class="col-md-12 col-12"> 
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                        <label for="title" class="control-label">Title<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="title" type="text" id="title" value="{{old('title')}}" placeholder="Enter Title" >
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
                                            @foreach(App\Models\Category::all()  as $option)
                                                <option value="{{ $option->id }}" {{  old('sub_category_id') == $option->id ? 'Selected' : '' }}>{{  $option->name ?? ''}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    
                                    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                                        <label for="price" class="control-label">Price<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="price" type="number" id="price" value="{{old('price')}}" placeholder="Enter Price" >
                                    </div>
                                </div>                                                             
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
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select required name="status" id="status" class="form-control select2">
                                            <option value="" readonly>Select Status</option>
                                            @foreach(getRequirementStatus()  as  $option)
                                            <option value="{{ $option['id'] }}" {{  old('status') == $option['name'] ? 'Selected' : '' }}>{{  $option['name'] ?? ''}}</option> 
                                        @endforeach
                                        </select>
                                    </div>
                                </div>                                                         
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select required name="type" id="type" class="form-control select2">
                                            <option value="" readonly>Select Type</option>
                                
                                                @foreach(getRequirementType() as $option)
                                                    <option value="{{  $option['id'] }}" {{  old('type') == $option['name'] ? 'Selected' : '' }}>{{ $option['name']}}</option> 
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12"> 
                                    <div class="form-group">
                                        <label for="location" class="control-label">Location </label>
                                        <textarea  class="form-control" name="location" id="location" placeholder="Enter Location">{{ old('location')}}</textarea>
                                    </div>
                                </div>                         
                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card ">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Customer Info</h3>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 col-12"> 
                                <div class="form-group {{ $errors->has('Name') ? 'has-error' : ''}}">
                                    <label for="name" class="control-label">Name<span class="text-danger">*</span> </label>
                                    <input required  class="form-control" name="name" type="text" id="name" value="{{old('name')}}" placeholder="Enter Name" >
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
                                    <input required  class="form-control" name="email" type="email" id="email" value="{{old('email')}}" placeholder="Enter Mobile No." >
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
                                                                                                                                                                                            
    </script>
    @endpush
@endsection
