@extends('backend.layouts.main') 
@section('title', 'AffiliateItem')
@section('content')
@php
/**
 * Requirement 
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
        ['name'=>'AffiliateItem', 'url'=> "javascript:void(0);", 'class' => 'active']
    ]
    @endphp
    <!-- push external head elements to head -->
    @push('head')
    @endpush

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>Affiliate Item</h5>
                            <span>List of Affiliate Items</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include("backend.include.breadcrumb")
                </div>
            </div>
        </div>
        
        <form action="{{ route('panel.affiliate-items.index') }}" method="GET" id="TableForm">
            <div class="row">
                <!-- start message area-->
                <!-- end message area-->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center">
                            {{-- <span class="fw-700" style="font-size:15px;">AffiliateItem</span> --}}
                            {{-- <div class="d-flex justicy-content-right">
                                

                                <div class="form-group mr-2">
                                    <span>Category:</span>
                                    <label for="category_id">
                                        <select required name="category_id" id="category_id" class="form-control select2">
                                            <option value="" readonly>Select Category </option>
                                            @foreach($categories  as $category)
                                                <option value="{{ $category->id }}" {{  old('category_id') == $category->id ? 'Selected' : '' }}>{{  $category->name ?? ''}}</option> 
                                            @endforeach
                                        </select>
                                    </label>
                                </div> 
                                    <div class="form-group mr-2">
                                        <span>Sub Category:</span>
                                        <label for="sub_category_id">
                                            <select required name="sub_category_id" id="sub_category_id" class="form-control select2">
                                                <option value="" readonly>Select Sub Category </option>
                                            </select>
                                        </label>
                                    </div>
                                <div class="form-group mb-0 mr-2">
                                    <span>From:</span>
                                <label for=""><input type="date" name="from" class="form-control" value="{{request()->get('from')}}"></label>
                                </div>
                                <div class="form-group mb-0 mr-2"> 
                                    <span>To:</span>
                                        <label for=""><input type="date" name="to" class="form-control" value="{{request()->get('to')}}"></label> 
                                </div>
                                <button type="submit" class="btn btn-icon btn-sm mr-2 btn-outline-warning" title="Filter"><i class="fa fa-filter" aria-hidden="true"></i></button>
                                <a href="javascript:void(0);" id="reset" data-url="{{ route('panel.AffiliateItem.index') }}" class="btn btn-icon btn-sm btn-outline-danger mr-2" title="Reset"><i class="fa fa-redo" aria-hidden="true"></i></a>
                                <a href="{{ route('panel.AffiliateItem.create') }}" class="btn btn-icon btn-sm btn-outline-primary" title="Add New Requirement"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </div> --}}
                        </div>  
                        <div id="ajax-container">
                            @include('panel.affiliate-item.load')
                        </div>
                    </div>
                </div>
            </div>
        <form>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('backend/js/index-page.js') }}"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script>
             

        

        $(document).on('click','#export_button',function(){
            html_table_to_excel('xlsx');
        })
       

        $('#reset').click(function(){
            var url = $(this).data('url');
            getData(url);
            window.history.pushState("", "", url);
            $('#TableForm').trigger("reset");
            //   $('#fieldId').select2('val',"");               // if you use any select2 in filtering uncomment this code
           // $('#fieldId').trigger('change');                  // if you use any select2 in filtering uncomment this code
        });
        $(document).ready(function(){
           $('#category_id').val('{{request()->get('category_id')}}').change();
        });
       
        </script>
    @endpush
@endsection
