@extends('backend.layouts.main') 
@section('title', 'Testimonials')
@section('content')
@php
/**
 * Testimonials
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
    ['name'=>'Add Client Video Testimonials', 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>Add Client Video Testimonials</h5>
                            <span>Create a record for Client Video Testimonials</span>
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
                        <h3>Create Client Video Testimonials</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('panel.testimonial.store') }}" method="post" enctype="multipart/form-data" id="UserAddresForm">
                            @csrf
                            <div class="row">
                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                        <label for="title" class="control-label">Title<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="title" type="text" id="title" value="{{old('title')}}" placeholder="Enter Title" >
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="details" class="control-label">Details <span class="text-danger">*</span> </label>
                                        <textarea  required   class="form-control" name="description" id="details" placeholder="Enter Details">{{ old('details')}}</textarea>
                                    </div>
                                </div>
                            </div>                                              
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="banner_file" class="control-label ml-3">{{ __('Banner')}}<span class="text-danger">*</span></label>                                            
                                          <input type="file" name="banner_file" class="form-control" required>
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
                                        <input class="form-control" name="img_alt" type="text" id="img_alt" value="" placeholder="Enter Meta Title" >
                                    </div>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group ">
                                        <label for="permission" class="control-label">Type</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="video" name="type" value="video" checked>
                                            <label class="form-check-label" for="video">Video</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="news" name="type" value="news">
                                            <label class="form-check-label" for="news">News</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="partner" name="type" value="partner">
                                            <label class="form-check-label" for="partner">Partner Logo</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="testimonials" name="type" value="testimonials">
                                            <label class="form-check-label" for="testimonials">Testimonials</label>
                                        </div>
                                        
                                    </div>
                                    
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
        $('#UserAddresForm').validate();
                                                                    
    </script>
    @endpush
@endsection
