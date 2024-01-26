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
        ['name'=>'Explore Leads', 'url'=> "javascript:void(0);", 'class' => 'active']
    ];
    
    @endphp
    <!-- push external head elements to head -->
    @push('head')
    <style>
        div.side-slide{
            overflow-y: auto;
        }
        div.side-slide {
            background-color: #fff;
            top: 66px;
            right: -100%; 
            height: 90%;
            position: fixed;
            width: 380px;
            z-index: 999;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }
    </style>
    @endpush
    {{-- @dd($requirements) --}}
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>Explore Leads</h5>
                            <span>List of Explore Lead</span>
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
                <div class="col-3 card" style="max-height: 550px;position: sticky; top: 70px;">
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
                            <div class="form-group mt-3">
                                <label for="budget">Budget</label></label>
                                <select name="budget_id" id="budget_id" class="form-control select2">
                                    <option value="" readonly>Any Budget</option>
                                        @foreach($budget_categories as $option)
                                            <option value="{{ $option->id }}">{{ $option->name}}</option> 
                                        @endforeach
                                </select>
                            </div> 
                            <div class="form-group mt-3">
                                <label for="from">From</label>
                                <input type="date" class="form-control" name="from" value="{{request()->get('from')}}">
                            </div> 
                            <div class="form-group mt-3">
                                <label for="to">To</label>
                                <input type="date" class="form-control" name="to" value="{{request()->get('to')}}">
                            </div> 
                            <div>
                                <button type="submit" class="btn d-block btn-sm mr-2 w-100 btn-primary" title="Filter">Apply Filter</button>
                                <a href="{{ route('panel.partner.leads.explore') }}" class="btn d-block btn-sm mr-2 w-100 mt-1 btn-outline-danger" title="Filter">Reset</a>
                            </div>
                        </form>

                        <hr>

                        
                    </div>
                </div>
                <div class="col-9">
                    <div id="ajax-container">
                        @include('partner.requirements.load')
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('partner.requirements.includes.sideshow')
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('backend/js/index-page.js') }}"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script>
            @php 
                if (request()->has('code') && request()->get('code') != null) {
                    $invite = App\Models\Requirement::where('code',request()->get('code'))->first();
                } 
            @endphp
            @if (isset($invite) && request()->has('code') && request()->get('code') != null)
                $(document).ready(function(){
                    $('.side-slide').animate({right: 'button' == 'close' ? "-100%" : "0px"}, 200);
                    getRequirementData("{{ $invite->id }}");
                });
            @endif
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
        });
        function getRequirementData(requirement_id){
            $('.lead-details').hide();
            $('.lead-loader').show();
            var key = "{{ env('API_RAZOR_KEY') }}";
            $.ajax({
                url: "{{route('panel.partner.leads.get.data')}}",
                method: 'GET',
                data: {
                    requirement_id: requirement_id
                },
                success: function(res) {
                    $('.requirementTitle').html(res.requirement.title);
                    $('#requirement_id').val(res.requirement.id);
                    $('.requirementPrice').html(res.price);
                    $('.requirementBudget').html(res.budget);
                    $('.requirementCreatedAt').html(res.created_at);
                    $('.requirementStatus').html(status);
                    $('.requirementStatusName').html(res.status_badge);
                    $('.requirementCategory').html(res.category);   
                    $('.requirementSubCategory').html(res.sub_category);
                    $('.customerEmail').html(res.customer_email);
                    $('.customerPhone').html(res.customer_phone);
                    $('.customerName').html(res.customer_name);
                    if(res.actual_price != 0){
                        $('.buyBtn').html('<button type="submit" class="btn btn-outline-primary btn-block">Buy Now</button>');
                    }else{
                        $('.buyBtn').html('');
                    }
                    if(res.requirement.location != null)  {
                        $('.requirementLocation').html('<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path fill="currentColor" d="M12 11.5A2.5 2.5 0 0 1 9.5 9A2.5 2.5 0 0 1 12 6.5A2.5 2.5 0 0 1 14.5 9a2.5 2.5 0 0 1-2.5 2.5M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7Z"/></svg>: '
                    + res.requirement.location);  
                    }else{
                        $('.requirementLocation').html('<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path fill="currentColor" d="M12 11.5A2.5 2.5 0 0 1 9.5 9A2.5 2.5 0 0 1 12 6.5A2.5 2.5 0 0 1 14.5 9a2.5 2.5 0 0 1-2.5 2.5M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7Z"/></svg>: '
                    + "--");
                    }

                    
                    $('.lead-details').show();
                    $('.lead-loader').hide();
                }
            })
        }
        $(document).on('click', '.off-canvas', function(e) {
            e.stopPropagation();
            var requirement_id = $(this).data('requirement_id');
            var type = $(this).data('type');
            $('.side-slide').animate({right: type == 'close' ? "-100%" : "0px"}, 200);
            getRequirementData($(this).data('requirement_id'))
        });
        $(document).on('.close.off-canvas',function(){
          var type =  $(this).data('type');
          $('.side-slide').animate({right: type == 'close' ? "-100%" : "0px"}, 200);
        });

        </script>
    @endpush
@endsection
