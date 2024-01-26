@extends('backend.layouts.main') 
@section('title', 'Investment Option')
@section('content')
@php
/**
* Investment Option 
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
    ['name'=>'Edit Investment Option', 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>Edit Investment Option</h5>
                            <span>Update a record for Investment Option</span>
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
                        <h3>Update Investment Option</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('panel.investment_options.update',$investment_option->id) }}" method="post" enctype="multipart/form-data" id="InvestmentOptionForm">
                            @csrf
                            <div class="row">
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('mutual_fund') ? 'has-error' : ''}}">
                                        <label for="mutual_fund" class="control-label">Mutual Fund<span class="text-danger">*</span> </label>
                                        <input required   class="form-control" name="mutual_fund" type="text" id="mutual_fund" value="{{$investment_option->mutual_fund }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('allocation') ? 'has-error' : ''}}">
                                        <label for="allocation" class="control-label">Allocation<span class="text-danger">*</span> </label>
                                        <input required   class="form-control" name="allocation" type="text" id="allocation" value="{{$investment_option->allocation }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('scrip_name') ? 'has-error' : ''}}">
                                        <label for="scrip_name" class="control-label">Scrip Name<span class="text-danger">*</span> </label>
                                        <input required   class="form-control" name="scrip_name" type="text" id="scrip_name" value="{{$investment_option->scrip_name }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('tenure') ? 'has-error' : ''}}">
                                        <label for="tenure" class="control-label">Tenure<span class="text-danger">*</span> </label>
                                        <input required   class="form-control" name="tenure" type="text" id="tenure" value="{{$investment_option->tenure }}">
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select required name="type" id="type" class="form-control select2">
                                            <option value="" readonly>Select Type</option>
                                                                                        @php
                                                    $arr = "Alternative, Equity";
                                            @endphp
                                                @foreach(explode(',',$arr) as $option)
                                                    <option value=" {{  $option }}" {{   $investment_option->type  ==  $option  ? 'selected' : ''}}>{{ $option}}</option> 
                                                @endforeach
                                                                                    </select>
                                    </div>
                                </div>
                                                            
                                <div class="col-md-12 mx-auto">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
        $('#InvestmentOptionForm').validate();
                                                                                                            
    </script>
    @endpush
@endsection
