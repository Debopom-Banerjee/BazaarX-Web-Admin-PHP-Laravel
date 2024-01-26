@extends('backend.layouts.main') 
@section('title', 'Services')
@section('content')
@php
/**
 * Service 
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
        ['name'=>'Services', 'url'=> "javascript:void(0);", 'class' => 'active']
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
                            <h5>Services</h5>
                            <span>List of Services</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include("backend.include.breadcrumb")
                </div>
            </div>
        </div>
        
        <form action="{{ route('panel.services.index') }}" id="serviceCategoryForm" method="GET" id="TableForm">
            
            <div class="row">
                <!-- start message area-->
                <!-- end message area-->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Services</h3>
                            <div class="d-flex justicy-content-right">
                                <div class="form-group mb-0 mr-2"> 
                                    <select name="category_id" id="serviceCategoryFormSubmitBtn" class="form-control select2">
                                        <option value="0" readonly>Select Category</option>
                                        @foreach (App\Models\Category::where('category_type_id',15)->get() as $item)
                                            <?php    $cat_id = $_GET['category_id'] ?? 0; ?>
                                            <option value="{{$item->id}}" name="{{$item->name}}" {{ $cat_id == $item->id ? 'selected':'' }}>
                                                {{$item->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>    
                                {{-- <button type="submit" class="btn btn-icon btn-sm mr-2 btn-outline-warning" title="Filter"><i class="fa fa-filter" aria-hidden="true"></i></button> --}}
                                <a href="javascript:void(0);" id="reset" data-url="{{ route('panel.services.index') }}" class="btn btn-icon btn-sm btn-outline-danger mr-2" title="Reset"><i class="fa fa-redo" aria-hidden="true"></i></a>
                                <a href="{{ route('panel.services.create') }}" class="btn btn-icon btn-sm btn-outline-primary" title="Add New Service"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div id="ajax-container">
                            @include('panel.services.load')
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
         $(document).ready(function(){
            $('#serviceCategoryFormSubmitBtn').on('change',function(){
                $('#serviceCategoryForm').submit()
                console.log('s')
              
            })
        })  
        

        function html_table_to_excel(type)
        {
            var table_core = $("#table").clone();
            var clonedTable = $("#table").clone();
            clonedTable.find('[class*="no-export"]').remove();
            clonedTable.find('[class*="d-none"]').remove();
            $("#table").html(clonedTable.html());
            var data = document.getElementById('table');

            var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
            XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
            XLSX.writeFile(file, 'ServiceFile.' + type);
            $("#table").html(table_core.html());
            
        }

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

       
        </script>
    @endpush
@endsection
