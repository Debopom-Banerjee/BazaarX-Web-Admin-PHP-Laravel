@extends('backend.layouts.main') 
@section('title', 'Maintanance')
<nav class="navbar navbar-expand-lg navbar-light" style="height: 85px;box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <div class="logo-img">
                <img height="40" src="{{ getBackendLogo(getSetting('app_white_logo'))}}" class="header-brand-img" title="DZE"> 
            </div>
        </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
       
      </div>
    </div>
  </nav>

@php
$breadcrumb_arr = [
    ['name'=>'', 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
    <!-- push external head elements to head -->
    @push('head')
    
    @endpush

    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card mt-5">
                    <div class="card-body">
                        <h4>Maintanance Mode</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt voluptatum aperiam veniam exercitationem tempore architecto hic accusamus iure vitae dolor, ratione velit deserunt amet nihil rem! Repellendus enim sint natus.</p>
                        <div class="text-center mx-auto">
                            <a href="" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
		
    @endpush


