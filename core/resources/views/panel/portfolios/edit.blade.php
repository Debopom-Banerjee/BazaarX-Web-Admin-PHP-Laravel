@extends('backend.layouts.main') 
@section('title', 'Portfolio')
@section('content')
@php
/**
* Portfolio 
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
    ['name'=>'Edit Portfolio', 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>Edit Portfolio</h5>
                            <span>Update a record for Portfolio</span>
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
                        <h3>Update Portfolio</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('panel.portfolios.update',$portfolio->id) }}" method="post" enctype="multipart/form-data" id="PortfolioForm">
                            @csrf
                            <div class="row">
                                                            
                                {{-- <div class="col-md-6 col-12"> 
                                    
                                    <div class="form-group">
                                        <label for="service_id">Service <span class="text-danger">*</span></label>
                                        <input required  class="form-control" name="service_id" type="text" id="service_id" value="{{$portfolio->service_id}}" placeholder="Enter Service" >
                                     
                                    </div>
                                </div> --}}
                                <input required  class="form-control" name="service_id" type="hidden" id="service_id" value="{{$portfolio->service_id}}" placeholder="Enter Service" >

                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                        <label for="title" class="control-label">Title<span class="text-danger">*</span> </label>
                                        <input required   class="form-control" name="title" type="text" id="title" value="{{$portfolio->title }}">
                                    </div>
                                </div>
                                                                                            
                               
                                                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('buy_link') ? 'has-error' : ''}}">
                                        <label for="buy_link" class="control-label">Buy Link</label>
                                        <input   class="form-control" name="buy_link" type="url" id="buy_link" value="{{$portfolio->buy_link }}">
                                    </div>
                                </div>

                                <div class="col-md-12 col-12"> 
                                    <div class="form-group">
                                        <label for="description" class="control-label">Description</label>
                                        <textarea  class="form-control" name="description" id="description" placeholder="Enter Description">{{$portfolio->description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12"> 
                                    <div class="form-group">
                                        <label for="is_publish" class="control-label">Is Publish </label><br>
                                        <input type="checkbox" name="is_publish" class="js-single switch-input" value="1" {{$portfolio->is_publish == 1 ? 'checked':''}} id="" data-switchery="true" style="display: none;" />
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
    <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
    <script>
        $('#PortfolioForm').validate();
        var options = {
            filebrowserImageBrowseUrl: "{{ url('/laravel-filemanager?type=Images') }}",
            filebrowserImageUploadUrl: "{{ url('/laravel-filemanager/upload?type=Images&_token='.csrf_token()) }}",
            filebrowserBrowseUrl: "{{ url('/laravel-filemanager?type=Files') }}",
            filebrowserUploadUrl: "{{ url('/laravel-filemanager/upload?type=Files&_token='.csrf_token()) }}"
        };
        $(window).on('load', function (){
            CKEDITOR.replace('description', options);
        });

    </script>
    @endpush
@endsection
