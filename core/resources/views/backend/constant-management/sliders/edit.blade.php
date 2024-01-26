@extends('backend.layouts.main') 
@section('title', 'Slider')
@section('content')
@php
$breadcrumb_arr = [
    ['name'=>'Edit Slider', 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
    <!-- push external head elements to head -->
      <!-- push external head elements to head -->
      @push('head')
      <link rel="stylesheet" href="{{ asset('backend/plugins/mohithg-switchery/dist/switchery.min.css') }}">
  @endpush

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>Edit Slider</h5>
                            <span>Update a record for {{ fetchFirst('App\Models\SliderType',$slider->slider_type_id,'title','') }}</span>
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
                        <h3>Update Slider</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('backend.constant-management.sliders.update',$slider->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="slider_type_id" value="{{ $slider->slider_type_id }}">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                        <label for="title" class="control-label">Title<span class="text-danger">*</span> </label>
                                        <input required   class="form-control" name="title" type="text" id="title" value="{{$slider->title }}">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                                        <label for="link" class="control-label">Link</label>
                                        <input class="form-control" name="link" type="text" id="link" value="{{$slider->link}}" placeholder="Enter Link">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group {{ $errors->has('app_link') ? 'has-error' : ''}}">
                                        <label for="app_link" class="control-label">App Link </label>
                                        <input class="form-control" name="app_link" type="text" id="app_link" value="{{$slider->app_link}}" placeholder="Enter Link">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="description" class="control-label">Description</label>
                                        <textarea  class="form-control" rows="5" name="description" id="description" placeholder="Enter Description">{{$slider->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">                
                                    <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                                        <label for="image" class="control-label">Image</label>
                                        <input class="form-control" name="image_file" type="file" id="image">
                                    </div>
                                    <div class="mb-2">
                                        <img src="{{asset('storage/backend/constant-management/sliders/'.$slider->image)}}" style="width:100px;">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                                        <label for="status" class="control-label">Publish</label> <br>
                                        <input  @if($slider->status) checked @endif name="status" type="checkbox" class="js-single switch-input" id="status" value="1">
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
    <script src="{{ asset('backend/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('backend/js/form-advanced.js') }}"></script>
    @endpush
@endsection
