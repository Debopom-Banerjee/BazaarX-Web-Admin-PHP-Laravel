@extends('backend.layouts.main') 
@section('title', 'Medical Insurance Logic')
@section('content')
@php
/**
 * Medical Insurance Logic 
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
    ['name'=>'Add Medical Insurance Logic', 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>Add Medical Insurance Logic</h5>
                            <span>Create a record for Medical Insurance Logic</span>
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
                        <h3>Create Medical Insurance Logic</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('panel.medical_insurance_logics.store') }}" method="post" enctype="multipart/form-data" id="MedicalInsuranceLogicForm">
                            @csrf
                            <div class="row">
                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('family_income') ? 'has-error' : ''}}">
                                        <label for="family_income" class="control-label">Family Income<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="family_income" type="text" id="family_income" value="{{old('family_income')}}" placeholder="Enter Family Income" >
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('insurance_amount') ? 'has-error' : ''}}">
                                        <label for="insurance_amount" class="control-label">Insurance Amount<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="insurance_amount" type="text" id="insurance_amount" value="{{old('insurance_amount')}}" placeholder="Enter Insurance Amount" >
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('of_family_members') ? 'has-error' : ''}}">
                                        <label for="of_family_members" class="control-label">Of Family Members<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="of_family_members" type="text" id="of_family_members" value="{{old('of_family_members')}}" placeholder="Enter Of Family Members" >
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('coverage_required_for_family') ? 'has-error' : ''}}">
                                        <label for="coverage_required_for_family" class="control-label">Coverage Required For Family<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="coverage_required_for_family" type="text" id="coverage_required_for_family" value="{{old('coverage_required_for_family')}}" placeholder="Enter Coverage Required For Family" >
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('approx_premium') ? 'has-error' : ''}}">
                                        <label for="approx_premium" class="control-label">Approx Premium<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="approx_premium" type="text" id="approx_premium" value="{{old('approx_premium')}}" placeholder="Enter Approx Premium" >
                                    </div>
                                </div>
                                                            
                                <div class="col-md-12 ml-auto">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create</button>
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
        $('#MedicalInsuranceLogicForm').validate();
                                                                                                            
    </script>
    @endpush
@endsection
