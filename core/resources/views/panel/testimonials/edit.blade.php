@extends('backend.layouts.main') 
@section('title', 'Testimonials')
@section('content')
@php
/**
* User Addre 
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
    ['name'=>'Edit Testimonials', 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>Edit Testimonials</h5>
                            <span>Update a record for Testimonials</span>
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
                        <h3>UpdateTestimonials</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('panel.testimonial.update',$testimonial->id) }}" method="post" enctype="multipart/form-data" id="UserAddresForm">
                            @csrf
                            <div class="row">
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                                        <label for="user_id" class="control-label">Title<span class="text-danger">*</span> </label>
                                        <input required   class="form-control" name="title" type="text" id="title" value="{{ $testimonial->title }}">
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="details" class="control-label">Details<span class="text-danger">*</span> </label>
                                        <textarea  required   class="form-control" name="description" id="description" placeholder="Enter Description">{{ $testimonial->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="banner_file" class="control-label ml-3">{{ __('Banner')}}<span class="text-danger">*</span></label>                                            
                                                  <input type="file" name="banner_file" class="form-control" required>
                                                  <img id="banner_file" src="{{ asset($testimonial->video_img) }}" class="mt-2" style="border-radius: 10px;width:100px;height:80px;"/>
                                                    {{-- <div class="input-group col-xs-8 ml-3">
                                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Banner">
                                                        <span class="input-group-append">
                                                        <button  class="file-upload-browse btn btn-success" type="button">{{ __('Upload')}}</button>
                                                        </span>
                                                    </div> --}}
                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('img_alt') ? 'has-error' : ''}}">
                                            <label for="img_alt" class="control-label">{{ 'Meta Title' }}</label>
                                            <input class="form-control" name="img_alt" type="text" id="img_alt" value="{{ $testimonial->img_alt }}" placeholder="Enter Meta Title" >
                                            </div>
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group ">
                                            <label for="permission" class="control-label">Type</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="video" name="type" value="video" {{$testimonial->type == 'video' ? 'checked':'checked' }}>
                                                <label class="form-check-label" for="video">Video</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="news" name="type" value="news" {{$testimonial->type == 'news' ? 'checked':'' }}>
                                                <label class="form-check-label" for="news">News</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="partner" name="type" value="partner" {{$testimonial->type == 'partner' ? 'checked':'' }}>
                                                <label class="form-check-label" for="partner">Partner Logo</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="testimonials" name="type" value="testimonials" {{$testimonial->type == 'testimonials' ? 'checked':'' }}>
                                                <label class="form-check-label" for="testimonials">Testimonials</label>
                                            </div>
                                            
                                        </div>
                                        
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
        $('#UserAddresForm').validate();
                                                                    
    </script>
    @endpush
@endsection
