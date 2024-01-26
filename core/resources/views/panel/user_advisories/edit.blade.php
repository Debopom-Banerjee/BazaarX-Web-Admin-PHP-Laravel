@extends('backend.layouts.main') 
@section('title', 'User Advisory')
@section('content')
@php
/**
* User Advisory 
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
    ['name'=>'Edit User Advisory', 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>Edit User Advisory</h5>
                            <span>Update a record for User Advisory</span>
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
                        <h3>Update User Advisory</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('panel.user_advisories.update',$user_advisory->id) }}" method="post" enctype="multipart/form-data" id="UserAdvisoryForm">
                            @csrf
                            <div class="row">
                                                            
                                <div class="col-md-6 col-12"> 
                                    
                                    <div class="form-group">
                                        <label for="user_id">User <span class="text-danger">*</span></label>
                                        <select required name="user_id" id="user_id" class="form-control select2">
                                            <option value="" readonly>Select User </option>
                                            @foreach(App\User::all()  as $option)
                                                <option value="{{ $option->id }}" {{ $user_advisory->user_id  ==  $option->id ? 'selected' : ''}}>{{  $option->name ?? ''}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('user_detail') ? 'has-error' : ''}}">
                                        <label for="user_detail" class="control-label">User Detail</label>
                                        <input   class="form-control" name="user_detail" type="text" id="user_detail" value="{{$user_advisory->user_detail }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('assests') ? 'has-error' : ''}}">
                                        <label for="assests" class="control-label">Assests</label>
                                        <input   class="form-control" name="assests" type="text" id="assests" value="{{$user_advisory->assests }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('liabilities') ? 'has-error' : ''}}">
                                        <label for="liabilities" class="control-label">Liabilities</label>
                                        <input   class="form-control" name="liabilities" type="text" id="liabilities" value="{{$user_advisory->liabilities }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('goals') ? 'has-error' : ''}}">
                                        <label for="goals" class="control-label">Goals</label>
                                        <input   class="form-control" name="goals" type="text" id="goals" value="{{$user_advisory->goals }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('budget') ? 'has-error' : ''}}">
                                        <label for="budget" class="control-label">Budget</label>
                                        <input   class="form-control" name="budget" type="text" id="budget" value="{{$user_advisory->budget }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('risk_assessment') ? 'has-error' : ''}}">
                                        <label for="risk_assessment" class="control-label">Risk Assessment</label>
                                        <input   class="form-control" name="risk_assessment" type="text" id="risk_assessment" value="{{$user_advisory->risk_assessment }}">
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
        $('#UserAdvisoryForm').validate();
                                                                                                                                                    
    </script>
    @endpush
@endsection
