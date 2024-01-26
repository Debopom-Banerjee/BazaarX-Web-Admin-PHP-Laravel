@extends('backend.layouts.main') 
@section('title', 'Code')
@section('content')
@php
/**
* Code 
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
    ['name'=>'Edit Code', 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>Edit Code</h5>
                            <span>Update a record for Code</span>
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
                        <h3>Update Code</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('panel.codes.update',$code->id) }}" method="post" enctype="multipart/form-data" id="CodeForm">
                            @csrf
                            <div class="row">
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
                                        <label for="code" class="control-label">Code</label>
                                        <input   class="form-control" name="code" type="text" id="code" value="{{$code->code }}">
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12">
                                    <div class="form-group {{ $errors->has('expires_at') ? 'has-error' : ''}}">
                                        <label for="expires_at" class="control-label">Expires At</label>
                                        <input   class="form-control" name="expires_at" type="datetime-local" id="expires_at" value="{{\Carbon\Carbon::parse($code->expires_at)->format('Y-m-d\TH:i') }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                                        <label for="type" class="control-label">Type</label>
                                        {{--<input   class="form-control" name="type" type="number" id="type" value="{{$code->type }}"> --}}
                                        <select name="type"  id="orderStatus" class="form-control select2 select2-hidden-accessible"style="width: 100%;" aria-hidden="true">
                                            <option value="0" {{$code->type == 0 ? 'selected':''}}>Percentage</option> 
                                            <option value="1" {{$code->type == 1 ? 'selected':''}}>Flat</option> 
                                        </select>   
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12">
                                    <div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
                                        <label for="value" class="control-label">Value</label>
                                        <input   class="form-control" name="value" type="number" step="any" id="value" value="{{$code->value }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('max_uses') ? 'has-error' : ''}}">
                                        <label for="max_uses" class="control-label">Max Use</label>
                                        <input   class="form-control" name="max_uses" type="number" id="max_uses" value="{{$code->max_uses }}">
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
        $('#CodeForm').validate();
                                                                                                            
    </script>
    @endpush
@endsection
