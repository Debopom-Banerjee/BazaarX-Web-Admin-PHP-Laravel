@extends('backend.layouts.main') 
@section('title', 'Assumption Logic')
@section('content')
@php
/**
* Assumption Logic 
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
    ['name'=>'Edit Assumption Logic', 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>Edit Assumption Logic</h5>
                            <span>Update a record for Assumption Logic</span>
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
                        <h3>Update Assumption Logic</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('panel.assumption_logics.update',$assumption_logic->id) }}" method="post" enctype="multipart/form-data" id="AssumptionLogicForm">
                            @csrf
                            <div class="row">
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('scenerio') ? 'has-error' : ''}}">
                                        <label for="scenerio" class="control-label">Scenerio<span class="text-danger">*</span> </label>
                                        <input required   class="form-control" name="scenerio" type="text" id="scenerio" value="{{$assumption_logic->scenerio }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('expectancy') ? 'has-error' : ''}}">
                                        <label for="expectancy" class="control-label">Expectancy<span class="text-danger">*</span> </label>
                                        <input required   class="form-control" name="expectancy" type="text" id="expectancy" value="{{$assumption_logic->expectancy }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('low_limit') ? 'has-error' : ''}}">
                                        <label for="low_limit" class="control-label">Low Limit</label>
                                        <input class="form-control" name="low_limit" type="text" id="low_limit" value="{{$assumption_logic->low_limit }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('high_limit') ? 'has-error' : ''}}">
                                        <label for="high_limit" class="control-label">High Limit</label>
                                        <input  class="form-control" name="high_limit" type="text" id="high_limit" value="{{$assumption_logic->high_limit }}">
                                    </div>
                                </div>
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
                                        <label for="year" class="control-label">Year</label>
                                        <input class="form-control" name="year" type="text" id="year" value="{{$assumption_logic->year }}">
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
        $('#AssumptionLogicForm').validate();
                                                                                                            
    </script>
    @endpush
@endsection
