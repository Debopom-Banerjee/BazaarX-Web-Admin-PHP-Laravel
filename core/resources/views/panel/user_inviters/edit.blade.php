@extends('backend.layouts.main') 
@section('title', 'User Inviter')
@section('content')
@php
/**
* User Inviter 
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
    ['name'=>'Edit User Inviter', 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>Edit User Inviter</h5>
                            <span>Update a record for User Inviter</span>
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
                        <h3>Update User Inviter</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('panel.user_inviters.update',$user_inviter->id) }}" method="post" enctype="multipart/form-data" id="User_inviterForm">
                            @csrf
                            <div class="row">
                                                                                            
                                {{-- <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                                        <label for="user_id" class="control-label">User Id<span class="text-danger">*</span> </label>
                                        <input required   class="form-control" name="user_id" type="number" id="user_id" value="{{$user_inviter->user_id }}">
                                    </div>
                                </div> --}}

                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                                        <label for="user_id" class="control-label">User<span class="text-danger">*</span> </label>
                                        <select name="user_id" id="user_id" class="form-control select2">
                                            <option value="" readonly>Select User</option>
                                            @foreach (UserList() as $item)
                                                <option value="{{$item->id}}" 
                                                    @if($item->id == $user_inviter->user_id)
                                                        selected
                                                    @endif
                                                >{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                                                                                                            
                                {{-- <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('inviter_id') ? 'has-error' : ''}}">
                                        <label for="inviter_id" class="control-label">Inviter Id<span class="text-danger">*</span> </label>
                                        <input required   class="form-control" name="inviter_id" type="number" id="inviter_id" value="{{$user_inviter->inviter_id }}">
                                    </div>
                                </div> --}}

                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('inviter_id') ? 'has-error' : ''}}">
                                        <label for="inviter_id" class="control-label">Inviter<span class="text-danger">*</span> </label>
                                        <select name="inviter_id" id="inviter_id" class="form-control select2">
                                            <option value="" readonly>Select Inviter</option>
                                            @foreach (UserList() as $item)
                                                <option value="{{$item->id}}"
                                                    @if($item->id == $user_inviter->user_id)
                                                        selected
                                                    @endif
                                                >{{$item->name}}</option>
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
        $('#User_inviterForm').validate();
                                                
    </script>
    @endpush
@endsection
