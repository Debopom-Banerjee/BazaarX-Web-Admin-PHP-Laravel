@extends('backend.layouts.main') 
@section('title', 'Requirements')
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
        ['name'=>'My Lead', 'url'=> "javascript:void(0);", 'class' => 'active']
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
                            <h5>My Leads</h5>
                            <span>List of My Lead</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include("backend.include.breadcrumb")
                </div>
            </div>
        </div>
        <form action="" method="GET" id="TableForm">
            <div class="row">
                <div class="col-3 card" style="max-height: 400px;position: sticky; top: 70px;">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fa fa-filter" aria-hidden="true"></i> Filter
                        </h6>
                    </div>
                    <div class="card-body" >
                    <form action="" method="GET" id="TableForm">
                            <div class="form-group mb-0">
                                <label for="category_id">Category <span class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-control select2">
                                    <option value="0" readonly>All Categories</option>
                                    @foreach ($categories as $category)
                                    <?php $cat_id = $_GET['category_id'] ?? 0; ?>
                                        <option value="{{$category['id']}}" name="{{ $category['name']}}" {{ $cat_id == $category['id'] ? 'selected':'' }}>
                                        {{$category['name']}}
                                        </option>
                                    @endforeach
                                </select>
                            </div> 
                            
                            <div class="form-group mt-3">
                                <label for="sub_category_id">All Sub Categories <span class="text-danger">*</span></label>
                                <select name="sub_category_id" id="sub_category_id" class="form-control select2">
                                    <option value="0" readonly>Select Sub Category</option>
                                </select>
                            </div> 
                            <div class="form-group mb-4 mt-3">
                                <label for="budget">Budget</label></label>
                                <select name="budget" id="budget" class="form-control select2">
                                    <option value="" readonly>Any Budget</option>
                                        @foreach($budget_categories as $option)
                                            <option value="{{ $option->id }}">{{ $option->name}}</option> 
                                        @endforeach
                                </select>
                            </div> 
                            <div>
                                <button type="submit" class="btn d-block btn-sm mr-2 w-100 mt-2 btn-outline-primary" title="Filter">Apply Filter</button>
                                <a href="{{ route('panel.partner.leads.index') }}" class="btn d-block btn-sm mr-2 w-100 mt-1 btn-outline-danger" title="Reset">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-9">
                    <div id="ajax-container">
                        @include('partner.requirements.my-lead.load')
                    </div>
                </div>
            </div>
        <form>
    </div>
    {{-- @include('partner.requirements.sideshow') --}}
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('backend/js/index-page.js') }}"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script>
           $('#category_id').on('change', function() {
            var category = $(this).val();
            $.ajax({
                url: "{{ route('panel.requirements.get-subcategory') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: category
                },
                dataType: "html",
                method: "POST",
                success: function(data) {
                    $('#sub_category_id').html(data);
                    $('#sub_category_id').select2("refresh");
                }
            });
        });   
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
            XLSX.writeFile(file, 'RequirementFile.' + type);
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
